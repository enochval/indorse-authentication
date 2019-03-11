<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'api_token', 'verified'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'updated_at',
        'created_at'
    ];

    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class);
    }

    public static function store($data = [])
    {
        return static::create([
            'full_name' => array_get($data, 'full_name'),
            'email' => array_get($data, 'email'),
            'password' => app('hash')->make(array_get($data, 'password'))
        ]);
    }

    public function createVerifyToken()
    {
        return $this->verifyUser()->create([
            'token' => str_random(40)
        ]);
    }

    public static function getUserByEmail($email)
    {
        return static::where('email', $email)->first();
    }

    public static function getUserByToken($token)
    {
        return static::where('api_token', $token)->first();
    }

    public function generateApiToken()
    {
        return $this->update(['api_token' => str_random(50)]);
    }

    public function clearToken()
    {
        return $this->update(['api_token' => null]);
    }
}
