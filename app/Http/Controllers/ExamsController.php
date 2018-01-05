<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Faculty;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function degrees(Faculty $faculty) {
        $degrees = $faculty->degrees;
        return view('home', compact('degrees'));
    }

    public function subjects(Degree $degree) {
        $subjects = $degree->subjects;
        return view('home', compact('subjects'));
    }
}
