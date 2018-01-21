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
use App\Exam;
use App\Faculty;
use App\Notification;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $faculties = Faculty::all();
    $notifications = DB::table('notifications')->get();
    return view('home', compact('faculties', 'notifications'));
})->name('home');

Route::get('/faculties/{faculty}', function (Faculty $faculty) {
    $degrees = $faculty->degrees;
    $faculties = Faculty::all();
    $currentFaculty = $faculty;
    return view('home', compact('degrees', 'currentFaculty', 'faculties'));
});

Route::get('/degrees/{degree}', function (Degree $degree) {
    $subjects = $degree->subjects;
    $degrees = $degree->faculty->degrees;
    $faculties = Faculty::all();
    $currentFaculty = $degree->faculty;
    $currentDegree = $degree;
    return view('home', compact('subjects', 'currentDegree', 'currentFaculty', 'degrees', 'faculties'));
});

Route::get('/subjects/{subject}', 'ExamsController@index');
Route::get('/exams/{exam}', 'ExamsController@show');
Route::post('/exams', 'ExamsController@upload');
Route::get('/exams/delete/{exam}', 'ExamsController@destroy');
Route::get('/exams/review/{exam}', function () {
    //send a proper notification to the proper moderator, and redirect back with a message
    dd('Unfinished...');
});
Route::get('/exams/download/{exam}', function (Exam $exam) {
    return response()->download(
        public_path() . '/images/exams/' . $exam->id . '.jpg',
        $exam->id . '.jpg');
});

Route::get('/solutions/{exam}/create', 'SolutionsController@create');
Route::post('/solutions/store', 'SolutionsController@store');

Route::get('/login', 'Auth\AuthController@redirectToProvider');
Route::get('/login/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('/logout', 'Auth\AuthController@logout');

Route::get('/users/deactivate/{user}', 'Auth\AuthController@deactivate');

Route::get('/admin', function () {
    if (Auth::user() && Auth::user()->role == 3) {
        $moderators = User::where('role', '=', '2')->get();
        return view('admin', compact('moderators'));
    }

    return view('home');
});

Route::get('/admin/users', function () {
    if (Auth::user() && Auth::user()->role == 3) {
        $users = User::where('role', '=', '1')->get();
        return view('admin', compact('users'));
    }

    return view('home');
});

Route::get('/admin/exams', function () {
    if (Auth::user() && Auth::user()->role == 3) {
        $exams = Exam::all();
        return view('admin', compact('exams'));
    }

    return view('home');
});

Route::get('/moderator', function () {
    if (Auth::user() && Auth::user()->role == 2) {
        $notifications = Auth::user()->notifications;
        $faculties = Faculty::all();
        return view('moderator', compact('notifications', 'faculties'));
    }
    return view('home');
});

Route::get('/ajax_degrees/{faculty}', function (Faculty $faculty) {
    return $faculty->degrees;
});

Route::get('/ajax_subjects/{degree}', function (Degree $degree) {
    return $degree->subjects;
});