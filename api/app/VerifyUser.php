<?php
/**
 * Created by PhpStorm.
 * User: enochval
 * Date: 2/26/19
 * Time: 1:26 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $fillable = ['user_id', 'token'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getVerifiedToken($token)
    {
        return static::where('token', $token)->first();
    }
}