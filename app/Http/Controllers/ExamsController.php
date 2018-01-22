<?php

namespace App\Http\Controllers;

use App\Degree;
use App\Exam;
use App\Faculty;
use App\Notification;
use App\Solution;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{

    public function __construct() {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(Subject $subject)
    {
        $exams = $subject->exams; // Te gjitha provimet e lendes
        $subjects = Subject::where('degree_id', '=', $subject->degree->id)->get(); // Te gjitha lendet paralele me lenden e zgjedhur, qe i perkasin te njejtes dege
        $degrees = $subject->degree->faculty->degrees; // Te gjitha deget e fakultetit ku jepet lenda
        $faculties = Faculty::all(); // Te gjithe fakultetet qe duhen per te mbushur formen

        $currentFaculty = $subject->degree->faculty;
        $currentDegree = $subject->degree;
        $currentSubject = $subject;

        return view('home', compact('exams', 'subjects', 'currentSubject', 'currentDegree', 'currentFaculty', 'faculties', 'degrees')); //i vendos ne vektor te gjitha,tek faqja home i akseson te gjitha tek home blade
        // Psh 'exams' i akseson si $exams, 'subjects' si $subjects e me radhe
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
        ], [
            'subject.required' => 'Zgjidhni një lëndë',
            'subject.integer' => 'Lënda duhet të jetë numër',
            'image.required' => 'Duhet të ngarkoni një imazh',
            'image.image' => 'Duhet të ngarkoni një imazh',
            'image.mimes' => 'Imazhi duhet të jetë jpeg, png ose jpg',
            'image.max' => 'Imazhi nuk duhet të jetë më i madh se 2 Mb',
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

    public function destroy(Exam $exam) {
        // Nese eshte provim qe ka ngarkuar perdoruesi vete, ose nese nuk eshte perdorues i thjeshte
        if (Auth::user()->id == $exam->user->id || Auth::user()->role != 1) {

            $solutions = $exam->solutions;
            Exam::find($exam->id)->delete();

            if (file_exists(public_path() . '/images/exams/' . $exam->id . '.jpg')) {
                unlink(public_path() . '/images/exams/' . $exam->id . '.jpg');
            } else {
                return redirect("/subjects/" . $exam->subject->id)->with('error', 'Provimi nuk ekziston.');
            }

            // Delete the solutions of the exam too
            foreach ($solutions as $solution) {
                Solution::find($solution->id)->delete();

                if (file_exists(public_path() . '/images/solutions/' . $solution->id . '.jpg')) {
                    unlink(public_path() . '/images/solutions/' . $solution->id . '.jpg');
                }
            }

            return redirect("/subjects/" . $exam->subject->id)->with('success', 'Provimi u fshi me sukses.');
        }

        return redirect()->home()->with(['msg' => 'Ju nuk keni të drejtë të fshini këtë provim.']);
    }
}
