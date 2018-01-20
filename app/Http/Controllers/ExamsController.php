<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Exam;
use App\Faculty;
use App\Notification;
use App\Subject;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function index(Subject $subject)
    {
        $exams = $subject->exams;
        $subjects = Subject::where('degree_id', '=', $subject->degree->id)->get();
        $faculties = Faculty::all();
        $degrees = Degree::all();
        return view('home', compact('exams', 'subjects', 'subject', 'faculties', 'degrees')); //i vendos ne vektor te gjitha,tek faqja home i akseson te gjitha tek home blade

    }

    public function show(Exam $exam)
    {
        $subjects = $exam->subject->degree->subjects;
        $solutions = $exam->solutions;
        return view('exam', compact('exam', 'solutions', 'subjects'));
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $exam = new Exam;
        $exam->user_id = auth()->user()->id;
        $exam->subject_id = $request->subject;
        $exam->save();

        $examImageName = $exam->id . '.' . $request->image->getClientOriginalExtension();

        $request->image->move(public_path('images/exams'), $examImageName);

        $notification = new Notification;
        $notification->receiver_id = $exam->subject->degree->moderator()->id;
        $notification->data = auth()->user()->name . " ngarkoi një provim në " . $exam->subject->name;
        $notification->redirect = "/exams/" . $exam->id;
        $notification->save();
        return redirect("/subjects/{$exam->subject_id}")->with('success', 'Provimi u ngarkua me sukses.');

    }

    public function destroy(Exam $exam)
    {
        Exam::find($exam->id)->delete();

        if (file_exists(public_path() . '/images/exams/' . $exam->id . '.jpg')) {
            unlink(public_path() . '/images/exams/' . $exam->id . '.jpg');
        } else {
            return redirect("/subjects/" . $exam->subject->id)->with('error', 'Provimi nuk ekziston.');
        }

        return redirect("/subjects/" . $exam->subject->id)->with('success', 'Provimi u fshi me sukses.');
    }
}
