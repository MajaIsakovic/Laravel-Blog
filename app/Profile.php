<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $fillable = ['user_id', 'avatar', 'about', 'facebook', 'youtube' ];


    //2. ovo se nastavlja na one-to-one relationship
    public function user(){
        return $this->belongsTo('App\User');
    }


}
