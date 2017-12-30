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

Route::get('/', function () {
    $notifications = DB::table('notifications')->get();
    return view('home',compact('notifications'));
})->name('home');

Route::get('/test', function () {
    $faculties = \App\Faculty::first();
    return $faculties->degrees->first()->subjects->first()->exams;
    //return view('test', compact('faculties'));
});

Route::get('login', 'Auth\AuthController@redirectToProvider');
Route::get('login/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('logout', 'Auth\AuthController@logout');
Route::post('exams/{exam}/post', 'ExamController@postExam')->name('exams');
Route::get('exams/{exam}/edit', 'ExamController@editExam');
Route::get('exams/{exam}/delete', 'ExamController@deleteExam');
