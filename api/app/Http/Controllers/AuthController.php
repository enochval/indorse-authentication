<?php
/**
 * Created by PhpStorm.
 * User: enochval
 * Date: 2/26/19
 * Time: 2:24 PM
 */

namespace App\Http\Controllers;

use App\User;
use App\VerifyUser;
use App\Mail\VerifyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {

    }

    public function register(Request $request)
    {
        $rules = [
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8'
        ];

        $data = $request->all();

        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return $this->error($validate->getMessageBag()->all(), 422);
        }

        $user = User::store($data);

        if ($user) {
            if ($user->createVerifyToken()) {
                try {
                    Mail::to($user->email)->send(new VerifyMail($user));
                    return $this->success('Registration Successful');
                } catch (\Exception $exception) {
                    $user->delete();
                    return $this->error("Unable to send mail, Please ensure that your mail server is configured", 400);
                }
            } else {
                return $this->error();
            }
        }
        return $this->error();
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::getVerifiedToken($token);
        if($verifyUser) {
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verify = $verifyUser->user()->update(['verified' => true]);
                if ($verify) {
                    return $this->success('Verification Successful, You can now Login');
                }else {
                    return $this->error();
                }
            }else{
                return $this->success("Your e-mail is already verified. You can now login.");
            }
        }
        return $this->error('Sorry your email cannot be identified.');
    }

    public function resendVerification(Request $request)
    {
        $rules = ['email' => 'required|email'];
        $data = $request->all();
        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return $this->error($validate->getMessageBag()->all(), 422);
        }

        $user = User::getUserByEmail($data['email']);

        if ($user) {
            try {
                Mail::to($user->email)->send(new VerifyMail($user));
                return $this->success('Verification Successful Sent');
            } catch (\Exception $exception) {
                return $this->error($exception->getMessage(), 400);
            }
        }
        return $this->error();
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string'
        ];

        $data = $request->all();
        $validate = Validator::make($data, $rules);

        if ($validate->fails()) {
            return $this->error($validate->getMessageBag()->all(), 422);
        }

        $user = User::getUserByEmail(array_get($data, 'email'));

        if ($user) {
            if (!$user->verified) {
                return $this->error('You need to confirm your account. please check your email.');
            }
            if(Hash::check(array_get($data, 'password'), $user->password)) {
                if (is_null($user->api_token)) {
                    $user->generateApiToken();
                }
                return $this->withData($user);
            }
            return $this->error("Password Incorrect");
        }

        return $this->error('Invalid E-amil, Please check your credentials and try again', 404);
    }

    public function logout(Request $request)
    {
        $user = User::getUserByToken($request->header('Authorization'));
        if ($user) {
            $user->clearToken();
            return $this->success("User successfully logged out");
        }
        return $this->error("This user is not logged in");
    }
}