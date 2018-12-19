<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    //MassAssignment
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'feature', 'category_id', 'slug', 'user_id'
    ];

    public function getFeaturedAtribute($feature){
        return asset($feature);
    }

    protected $dates =  ['deleted_at'];

    // vezivanje tablova po modelima
    public function category(){

        return $this->belongsTo('App\Category');

    }

    // -> 2 many to many nastavak
    // 3 -> zatim pravimo migraciju koja ce da napravi novi table u bazi kako bi povezao ova dva:
    // php artisan make:migration create_post_tag_table
    public function tags(){

        return $this->belongsToMany('App\Tag');
    }

    // --> veza Post-->User

    public function user(){
        return $this->belongsTo('App\User');
    }
}
