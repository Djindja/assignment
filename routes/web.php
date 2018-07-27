<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get("/logout", 'HomeController@doLogout');

Auth::routes();

Route::get('/', function () {
    return view('index');
});

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(["prefix" => "trip"], function () {
    Route::get("/", "TripController@index");
    Route::get("/create", "TripController@create");
    Route::post("/create", "TripController@postCreate");
    Route::get("/edit/{id}", "TripController@edit");
    Route::get("/{id}", "TripController@edit");
    Route::get("/delete/{id}", "TripController@delete");
});