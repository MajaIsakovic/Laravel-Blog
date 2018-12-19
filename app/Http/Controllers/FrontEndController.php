<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\Category;
use App\Post;
use App\Tag;

class FrontEndController extends Controller
{
    //
    public function index(){

        return view('index')
                    ->with('title', Setting::first())
                    // take() je metod koji uzima broj odredjen
                    //to je query builder metod i zato nam treba get() da vezemo uz njega
                    ->with('categories', Category::take(6)->get())
                    // orderBy() je isto querybuilder metod
                    ->with('first_post', Post::orderBy('created_at', 'desc')->first())
                    //  query builder metode: skip(1)->take(2)->get()
                    ->with('second_post', Post::orderBy('created_at', 'desc')->skip(1)->take(1)->get()->first())
                    ->with('third_post', Post::orderBy('created_at', 'desc')->skip(2)->take(1)->get()->first())
                    ->with('java', Category::find(11))
                    ->with('maria_db', Category::find(15))
                    ->with('laravel', Category::find(13))
                    ->with('settings', Setting::first());
    }

    public function singlePost($slug){

        $post = Post::where('slug', $slug)->first();

        // Paginacija
        $next_id = Post::where('id', '>', $post->id)->min('id');
        $prev_id = Post::where('id', '<', $post->id)->max('id');

        return view('single')->with('post', $post)
                                ->with('title', $post->title)
                                ->with('settings', Setting::first())
                                ->with('categories', Category::take(5)->get())
                                ->with('next', Post::find($next_id))
                                ->with('prev', Post::find($prev_id))
                                ->with('tags', Tag::all());
    }


    // Get all categories
    public function category($id){

        $category = Category::find($id);

        return view('category')->with('category', $category)
                               ->with('title', $category->name)
                               ->with('settings', Setting::first())
                               ->with('categories', Category::take(6)->get())
                               ->with('tags', Tag::all());
    }

    // Get all tags
    public function tag($id){
        
        $tag = Tag::find($id);

        return view('tag')->with('tag', $tag)
                            ->with('title', $tag->tag)
                            ->with('settings', Setting::first())
                            ->with('categories', Category::take(5)->get())
                            ->with('tags', Tag::all());
                        
    }
}
