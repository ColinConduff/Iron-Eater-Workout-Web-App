<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'heightInches'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function workouts()
    {
        return $this->hasMany('App\Workout');
    }

    public function exercises()
    {
        return $this->hasMany('App\Exercise');
    }

    public function sessions()
    {
        return $this->hasMany('App\Session');
    }

    public function plans()
    {
        return $this->hasMany('App\Plan');
    }

    public function bodyweights()
    {
        return $this->hasMany('App\Bodyweight');
    }
}
