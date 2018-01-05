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

use App\Degree;
use App\Faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $faculties = Faculty::all();
    $notifications = DB::table('notifications')->get();
    return view('home', compact('faculties', 'notifications'));
})->name('home');

Route::get('/faculties/{faculty}', function (Faculty $faculty) {
    $degrees = $faculty->degrees;
    return view('home', compact('degrees'));
});

Route::get('/degrees/{degree}', function (Degree $degree) {
    $subjects = $degree->subjects;
    return view('home', compact('subjects'));
});

Route::get('/subjects/{subject}', 'ExamsController@index');
Route::get('/exams/{exam}', 'ExamsController@show');
Route::post('exams', 'ExamsController@upload');
Route::delete('exams/{id}', 'ExamsController@destroy');


Route::get('login', 'Auth\AuthController@redirectToProvider');
Route::get('login/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('logout', 'Auth\AuthController@logout');
Route::post('exams/{exam}/post', 'ExamController@postExam')->name('exams');
Route::get('exams/{exam}/edit', 'ExamController@editExam');
Route::get('exams/{exam}/delete', 'ExamController@deleteExam');
