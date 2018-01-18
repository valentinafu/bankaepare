<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Solution;
use Illuminate\Http\Request;

class SolutionsController extends Controller //git add
{
    public function __construct() {
        $this->middleware('auth')->except('show');
    }

    public function create(Exam $exam) {
        return view('solution', compact("exam"));
    }

    public function store()
    {
        $this->validate(request(), [
            'exam' => 'required|integer',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048',
             'body'=>'required'

            // 'image' => 'required',
            //  'textsolution'=>'required'
            //duhet shtuar dhe teksti (ose njera ose tjetra)
        ]);

        $solution = new Solution;
        $solution->exam_id = request()->exam;//per databazen,request vlera qe ka dhene perdoruesi
        $solution->title = request()->title;//per databazen


        //    $zgjidhjetekst = request()->textsolution;
         //   $image = request()->image;
            // $solution->image = request()->image;
        $solution->body = 'body';
            $solution->save();
             //per databazen
     //   $image=request()->image;
      //  if($image) {
            $solutionImageName = $solution->id . '.' . request()->image->getClientOriginalExtension();

            request()->image->move(public_path('images/solutions'), $solutionImageName);

            return redirect("/exams/$solution->exam_id");
        }
}
