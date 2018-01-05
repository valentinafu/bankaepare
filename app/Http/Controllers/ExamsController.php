<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Degree;
use App\Faculty;
use App\Exam;
use Illuminate\Http\Request;

class ExamsController extends Controller
{

    public function index() {
        $exams = Exam::all();

        return view('home',compact('exams'));
    }

    public function upload(Request $request) {
        $this->validate($request, [
            'subject' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $exam = new Exam;
        $exam->user_id = auth()->user()->id;
        $exam->subject_id = $request->subject;
        $exam->save();

        $examImageName = $exam->id . '.' . $request->image->getClientOriginalExtension();

        $request->image->move(public_path('images/exams'), $examImageName);

        return redirect()->home()->with('success','Image Uploaded successfully.');

    }

    public function destroy($id) {
        Exam::find($id)->delete();

        //Delete the image from the images/exams folder
        return redirect()->home()->with('success','Image removed successfully.');
        }
    public function degrees(Faculty $faculty) {
        $degrees = $faculty->degrees;
        return view('home', compact('degrees'));
    }

    public function subjects(Degree $degree) {
        $subjects = $degree->subjects;
        return view('home', compact('subjects'));

    }
}
