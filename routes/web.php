<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Class 'request' yang diberikan pleh Laravel
// use Illuminate\Http\Request;

//Route::get('contact', function(Request $request){

// return $request->fullUrl(); Mendapatkan Full Url dengan class 'Request' dari Laravel

// return $request->path(); Mendapatkan Path name Url

// return view('contact');
//});

// Route::get('/', function(){
//     return view('home');
// });

// Cara Pertama Get Full Url
Route::get('post', 'PostController@Index'); // Index Post


Route::get('post/create', 'PostController@create'); // Post Create Page

Route::post('post/store', 'PostController@store'); // Post Save New Post


Route::get('account/password', 'account\PasswordController@edit');
Route::patch('account/password/update', 'account\PasswordController@update');


Route::get('post/{post:slug}/edit', 'PostController@edit'); // Post Edit Page

Route::patch('post/{post:slug}/update', 'PostController@update'); // Post Save Edit Data Post


Route::delete('post/{post:slug}/delete', 'PostController@delete'); // Post Delete Data Post

Route::get('post/{post:slug}', 'PostController@show'); // Post Show Detail Data Post

Route::get('category/{category:slug}', 'CategoryController@show');

Route::get('tag/{tag:slug}', 'TagController@show');


Route::get('contact', function () {

    return view('contact'); // Contact Page Index
});

Route::get('about', function () {
    return view('about'); // About Page Index
});

Route::get('login', function () {
    return view('login'); // Login Index
});

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
