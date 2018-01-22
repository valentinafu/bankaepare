<?php

use App\Degree;
use App\Exam;
use App\Faculty;
use App\Notification;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $faculties = Faculty::all();
    $degrees = $faculties[0]->degrees;
    $subjects = $degrees[0]->subjects;
    $notifications = DB::table('notifications')->get();

    $showFaculties = true;

    return view('home', compact('faculties', 'notifications', 'degrees', 'subjects', 'showFaculties'));
})->name('home');

Route::get('/faculties/{faculty}', function (Faculty $faculty) {
    $degrees = $faculty->degrees;
    $faculties = Faculty::all();
    $currentFaculty = $faculty;

    $showDegrees = true;

    return view('home', compact('degrees', 'currentFaculty', 'faculties', 'showDegrees'));
});

Route::get('/degrees/{degree}', function (Degree $degree) {
    $subjects = $degree->subjects;
    $degrees = $degree->faculty->degrees;
    $faculties = Faculty::all();
    $currentFaculty = $degree->faculty;
    $currentDegree = $degree;

    $showSubjects = true;

    return view('home', compact('subjects', 'currentDegree', 'currentFaculty', 'degrees', 'faculties', 'showSubjects'));
});

Route::get('/subjects/{subject}', 'ExamsController@index');
Route::get('/exams/{exam}', 'ExamsController@show');
Route::post('/exams', 'ExamsController@upload');
Route::get('/exams/delete/{exam}', 'ExamsController@destroy');
Route::get('/exams/review/{exam}', function (Exam $exam) {
    if (Auth::user()) {
        $notification = new Notification;
        $notification->receiver_id = $exam->subject->degree->moderator()->id;
        $notification->data = auth()->user()->name . " kërkoi rishikim të një provimi në " . $exam->subject->name;
        $notification->redirect = "/exams/" . $exam->id;
        $notification->save();
        return redirect()->back()->with(['msg' => "Moderatori i degës u njoftua për kërkesën tuaj."]);
    }

    return redirect()->home();
});

Route::get('/exams/download/{exam}', function (Exam $exam) {
    return response()->download(
        public_path() . '/images/exams/' . $exam->id . '.jpg',
        $exam->id . '.jpg');
});

Route::get('/solutions/{exam}/create', 'SolutionsController@create');
Route::get('/solutions/delete/{solution}', 'SolutionsController@delete');
Route::post('/solutions/store', 'SolutionsController@store');

Route::get('/login', 'Auth\AuthController@redirectToProvider')->name('login');
Route::get('/login/callback', 'Auth\AuthController@handleProviderCallback');
Route::post('/logout', 'Auth\AuthController@logout');

Route::get('/users/activate/{user}', function (User $user) {
    if (Auth::user() && Auth::user()->role == 3) {
        if (!$user->active)
            $user->active = true;
        else
            $user->active = false;
        $user->save();
        return redirect()->back();
    }

    return redirect()->home();
});

Route::get('/users/toggleMod/{user}', function (User $user) {
    if (Auth::user() && Auth::user()->role == 3) {
        if ($user->role == 2)
            $user->role = 1;
        else
            $user->role = 2;
        $user->save();
        return redirect()->back();
    }

    return redirect()->home();
});

Route::get('/admin', function () {
    if (Auth::user() && Auth::user()->role == 3) {
        $moderators = User::where('role', '=', '2')->get();
        $faculties = Faculty::all();
        return view('admin', compact('moderators', 'faculties'));
    }

    return redirect()->home();
});

Route::get('/admin/users', function () {
    if (Auth::user() && Auth::user()->role == 3) {
        $users = User::where('role', '1')->get();
        $faculties = Faculty::all();
        return view('admin', compact('users', 'faculties'));
    }

    return redirect()->home();
});

Route::get('/admin/exams', function () {
    if (Auth::user() && Auth::user()->role == 3) {
        $exams = Exam::all();
        $faculties = Faculty::all();
        return view('admin', compact('exams', 'faculties'));
    }

    return redirect()->home();
});

Route::get('/moderator', function () {
    if (Auth::user() && Auth::user()->role == 2) {
        $notifications = Auth::user()->notifications;
        $faculties = Faculty::all();
        return view('moderator', compact('notifications', 'faculties'));
    }

    return redirect()->home();
});

Route::get('/moderator/exams', function () {
    if (Auth::user() && Auth::user()->role == 2) {
        $exams = Exam::all();
        $faculties = Faculty::all();
        return view('moderator', compact('exams', 'faculties'));
    }

    return redirect()->home();
});

Route::get('/ajax_degrees/{faculty}', function (Faculty $faculty) {
    return $faculty->degrees;
});

Route::get('/ajax_subjects/{degree}', function (Degree $degree) {
    return $degree->subjects;
});