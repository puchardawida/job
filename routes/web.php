<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/event/form', 'EventAddController@showForm')->middleware('auth');
Route::get('/event/add', 'EventAddController@addEvent')->middleware('auth');
Route::get('/events', 'EventController@showEvents');
Route::get('/user/sign-in', 'UserController@signIn');
