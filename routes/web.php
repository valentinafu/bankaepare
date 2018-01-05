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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'ExamsController@index')->name('home');

Route::get('/test', function () {
    $faculties = \App\Faculty::first();
    return $faculties->degrees->first()->subjects->first()->exams;
    //return view('test', compact('faculties'));
});

Route::get('login', 'Auth\AuthController@redirectToProvider');
Route::get('login/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('logout', 'Auth\AuthController@logout');

Route::get('exams', 'ExamsController@index');
Route::post('exams', 'ExamsController@upload');
Route::delete('exams/{id}', 'ExamsController@destroy');