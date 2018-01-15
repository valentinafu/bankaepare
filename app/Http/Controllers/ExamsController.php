<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Subject;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function index(Subject $subject) {
        $exams = $subject->exams;
        $subjects = Subject::where('degree_id', '=', $subject->degree->id)->get();
        return view('home', compact('exams', 'subjects' ));
    }

    public function show(Exam $exam) {
        $solutions = $exam->solutions;
        return view('exam', compact('exam', 'solutions'));
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

        return redirect()->back()->with('success','Image Uploaded successfully.');

    }

    public function destroy(Exam $exam) {
        Exam::find($exam->id)->delete();

        if(is_file($exam->id . '.jpg')) {
            Storage::delete($exam->id . '.jpg');
        } else {
            return redirect("/subjects/" . $exam->subject->id)->with('error','Image does not exist.');
        }

        return redirect("/subjects/" . $exam->subject->id)->with('success','Image removed successfully.');
    }
}
