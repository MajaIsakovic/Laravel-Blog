<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tags'];

    // 1. many to may se uspostavlja veza
    // zatim u Post modelu se veza pravi: 2 ->
    public function posts(){
         
        return $this->belongsToMany('App\Post');
    }
}
