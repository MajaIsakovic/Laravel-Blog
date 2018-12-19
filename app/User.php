<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //1. Making relationship with profiles table
    // hasOne() //one-to-one relationship
    // 2. nastavak veze se nalazi u Profile.php
    public function profile(){
        return $this->hasOne('App\Profile');
    }


    // User -Post relashionship (za naknadno dodato polje u tabeli)
    // Posle u Post.php isto moramo da napravimo vezu -->

    public function posts(){

        return $this->hasMany('App\Post');
    }
}
