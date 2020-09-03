<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * ... that means you will be able to do, smth like:
     * ... $u = App\User::create(['name' => 'vikter', 'email' => 'vikter@inbox.lt']);
     * ... Kam to reik? RegsiterController naudoja būtent tokį mechanizmą naudoja
     */
    protected $fillable = [
        'name', 'nickname', 'email', 'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blogposts(){
        return $this->hasMany('App\BlogPost');
    }
}
