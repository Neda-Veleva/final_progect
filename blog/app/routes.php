<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', 'HomeController@showWelcome');

Route::post('/search', array('before'=>'csrf', 'uses'=>'HomeController@sidebarSearch'));

Route::get('/tag/{id}', 'HomeController@showTags');
Route::post('/tag/{id}', array('before'=>'csrf', 'uses'=>'HomeController@searchByTags'));
Route::get('/login','UserController@getLogin');
Route::post('/login', array('before'=>'csrf', 'uses'=>'UserController@postLogin')); 

Route::get('user/logout', 'UserController@logout');
Route::get('user/create', 'UserController@create');
Route::post('user/', array('before'=>'csrf', 'uses'=>'UserController@store'));

Route::group(array('before' => 'auth'), function(){
    
    Route::get('/post/', 'PostController@index');
    Route::get('/post/create', 'PostController@create');
    Route::get('/post/{id}/edit', 'PostController@edit');    
    Route::put('/post/{id}', 'PostController@update');
    Route::delete('/post/{id}', 'PostController@destroy');
    
});

Route::post('/post/', array('before'=>'csrf', 'uses'=>'PostController@store'));
Route::get('/post/{id}', 'PostController@show');

Route::post('/post/{id}/comment/', array('before'=>'csrf', 'uses'=>'CommentController@store'));


/* View Composer */
View::composer('sidebar', function ($view) {
    if(Auth::check()) {
    $user_id = Auth::user()->id;                
    } else {
        $user_id = 1;
    }
    
    $view->tags = Tag::all();
    
    $view->recentPosts = Post::page($user_id);
    
    $view->recentComments = Comment::orderBy('id', 'desc')->take(5)->get();
    
    $view->posts_by_year = Post::page($user_id)->groupBy(function($date){
        return Carbon::parse($date->created_at)->format('Y F');
    });
});


 
    