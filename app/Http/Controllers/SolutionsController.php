<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Solution;
use Illuminate\Http\Request;

class SolutionsController extends Controller {
    public function __construct() {
        $this->middleware('auth')->except('show');
    }

    public function create(Exam $exam) {
        $subjects = $exam->subject->degree->subjects;
        return view('solution', compact("exam", 'subjects'));
    }

    public function store() {
        $this->validate(request(), [
            'exam' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'body' => 'required'
        ], [
            'exam.required' => 'Duhet provimi ku duhet të ngarkohet zgjidhja',
            'exam.integer' => 'Provimi duhet te kalojë si një numër',
            'image.required' => 'Duhet të ngarkoni një imazh',
            'image.image' => 'Duhet të ngarkoni një imazh',
            'image.mimes' => 'Imazhi duhet të jetë jpeg, png ose jpg',
            'image.max' => 'Imazhi nuk duhet të jetë më i madh se 2 Mb',
            'body.required' => 'Duhet të shkruani një tekst'
        ]);

        $solution = new Solution;
        $solution->exam_id = request()->exam;//per databazen,request vlera qe ka dhene perdoruesi
        $solution->user_id = auth()->user()->id;
        $solution->title = request()->title;//per databazen
        $solution->body = request()->body;

        //    $zgjidhjetekst = request()->textsolution;
        //   $image = request()->image;
        // $solution->image = request()->image;
        $solution->save();
        $solutionImageName = $solution->id . '.' . request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images/solutions'), $solutionImageName);

        return redirect("/exams/$solution->exam_id")->with('msg', 'Zgjidhja u shtua me sukses.');
    }

    public function delete(Solution $solution) {
        // Nese eshte zgjidhje qe ka ngarkuar perdoruesi vete, ose nese nuk eshte perdorues i thjeshte
        if (Auth::user()->id == $solution->user->id || Auth::user()->role != 1) {
            Solution::find($solution->id)->delete();

            if (file_exists(public_path() . '/images/solutions/' . $solution->id . '.jpg')) {
                unlink(public_path() . '/images/solutions/' . $solution->id . '.jpg');
            } else {
                return redirect("/exams/" . $solution->exam->id)->with('msg', 'Zgjidhja nuk ekziston.');
            }

            return redirect("/exams/" . $solution->exam->id)->with('msg', 'Zgjidhja u fshi me sukses.');
        }

        return redirect()->home()->with(['msg' => 'Ju nuk keni të drejtë të fshini këtë zgjidhje.']);
    }
}
