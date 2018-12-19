<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can  egister web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[
    
    'uses' => 'FrontEndController@index',
    'as' => 'index'
]); 


Auth::routes();

// Grupisanje ruta i
// Midlware - filtriranje 
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

    Route::get('/dashbord',[
        
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]); 

    // Get all Posts
    Route::get('/post',[
        
        'uses' => 'PostsController@index',
        'as' => 'posts'
    ]); 

    // Get all Trashed Posts
    Route::get('/post/trashed',[
        
        'uses' => 'PostsController@trashed',
        'as' => 'posts.trashed'
    ]); 

    // Restore Post
    Route::get('/post/restore/{id}',[
        
        'uses' => 'PostsController@restore',
        'as' => 'post.restore'
    ]); 

    // Delete Post
    Route::get('/post/delete/{id}',[
        
        'uses' => 'PostsController@destroy',
        'as' => 'post.delete'
    ]); 

    // Kill Post
    Route::get('/post/kill/{id}',[
        
        'uses' => 'PostsController@kill',
        'as' => 'post.kill'
    ]); 

    // Create Post
    Route::get('/post/create', [
        
        'uses' => 'PostsController@create',
        'as' => 'post.create'
    ]);
        
    // Store Post
    Route::post('/post/store', [
        
        'uses' => 'PostsController@store',
        'as' => 'post.store'
    ]);

    // Edit post 1step
    Route::get('/post/edit/{id}', [
        
        'uses' => 'PostsController@edit',
        'as' => 'post.edit'
    ]);

    // Edit post 2step
    Route::post('/post/store/{id}', [
        
        'uses' => 'PostsController@update',
        'as' => 'post.update'
    ]);

    Route::get('/category/create', [
        
        'uses' => 'CategorysController@create',
        'as' => 'category.create'
    ]);

    Route::post('/category/store', [
        
        'uses' => 'CategorysController@store',
        'as' => 'category.store'
    ]);

    Route::get('/categories', [
        
        'uses' => 'CategorysController@index',
        'as' => 'categories'
    ]);

    Route::get('/category/edit/{id}', [
        
        'uses' => 'CategorysController@edit',
        'as' => 'category.edit'
    ]);

    Route::post('/category/update/{id}', [
        
        'uses' => 'CategorysController@update',
        'as' => 'category.update'
    ]);

    Route::get('/category/delete/{id}', [
        
        'uses' => 'CategorysController@destroy',
        'as' => 'category.delete'
    ]);

    // Tags
    Route::get('/tags', [
        
        'uses' => 'TagsController@index',
        'as' => 'tags'
    ]);

    // Create Tags
    Route::get('/tag/create', [
        
        'uses' => 'TagsController@create',
        'as' => 'tag.create'
    ]);

    // Store Tags
    Route::post('/tag/store', [
        
        'uses' => 'TagsController@store',
        'as' => 'tag.store'
    ]);

    // Delete Tags
    Route::get('/tag/delete/{id}', [
        
        'uses' => 'TagsController@destroy',
        'as' => 'tag.delete'
    ]);

    // Edit Tags step1:
    Route::get('/tag/edit/{id}', [
        
        'uses' => 'TagsController@edit',
        'as' => 'tag.edit'
    ]);

    // Edit Tags step2:
    Route::post('/tag/update/{id}', [
        
        'uses' => 'TagsController@update',
        'as' => 'tag.update'
    ]);

    //////////////////////////////////////////////////////////////////////////////////////////////////////
    // USERS
    Route::get('/users', [
        
        'uses' => 'UsersController@index',
        'as' => 'users'
    ]);

    // Create User step1
    Route::get('/user/create', [
        
        'uses' => 'UsersController@create',
        'as' => 'user.create'
    ]);
    
    // Create User step2
    Route::post('/user/store', [
        
        'uses' => 'UsersController@store',
        'as' => 'user.store'
    ]);

    Route::get('/user/admin/{id}', [
        
        'uses' => 'UsersController@admin',
        'as' => 'user.admin'
    ]);

    Route::get('/user/not-admin/{id}', [
        
        'uses' => 'UsersController@not_admin',
        'as' => 'user.not.admin'
    ]);


    Route::get('/user/profile', [
        
        'uses' => 'ProfilesController@index',
        'as' => 'user.profile'
    ]);

    // ne treba nam id ovde jer koristimo Auth user klassu
    Route::post('/user/profile/update', [
        
        'uses' => 'ProfilesController@update',
        'as' => 'user.profile.update'
    ]);

    // Delete user
    Route::get('/user/delete/{id}', [
        
        'uses' => 'UsersController@destroy',
        'as' => 'user.delete'
    ]);

    /////////////////////////////////////////////////////////////////////////////////////////////////
    //SETTINGS
    Route::get('/settings', [
        
        'uses' => 'SettingsController@index',
        'as' => 'settings'
    ]);

    Route::post('/settings/update', [
        
        'uses' => 'SettingsController@update',
        'as' => 'settings.update'
    ]);

});

// ///////////////////////////////////////////////////////////////////////////////////////////////
// SINGLE POST
Route::get('/post/{slug}', [
    
    'uses' => 'FrontEndController@singlePost',
    'as' => 'post.single'
]);

// CATEGORY SINGLE
Route::get('/category/{slug}', [
    
    'uses' => 'FrontEndController@category',
    'as' => 'category.single'
]);


// TAG SINGLE
Route::get('/tag/{id}', [
    
    'uses' => 'FrontEndController@tag',
    'as' => 'tag.single'
]);

// /////////////////////////////////////////////////////////////////////////////////////////////
// SEARCH results 
Route::get('/results', function(){
                // query bulder izraz + get() ..the results
    $posts = App\Post::where('title', 'like', '%' . request('query') . '%')->get();

    return view('results')->with('posts', $posts)
                          ->with('title', 'Search results: ' . request('query'))
                          ->with('settings', App\Setting::first())
                          ->with('categories', App\Category::take(5)->get())
                          ->with('query', request('query'))
                          ->with('tags', App\Tag::all()); 
});