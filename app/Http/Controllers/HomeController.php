<?php

namespace App\Http\Controllers;

use App\User;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(auth()->user()->role == 0){//Is admin
            $students = Student::all();
            return view('admin.dashboard')->with('students', $students)->with('colleges', \App\College::all())->with('request', $request);
        }elseif(auth()->user()->role == 1){//Is counsel
            $students = Student::with('course.college')->get()->where('course.college_id', auth()->user()->counsel->college_id);
            return view('counsel.dashboard')->with('students', $students)->with('colleges', \App\College::all())->with('request', $request);
        }elseif(auth()->user()->role == 2){//Is student
            $student = Student::where('user_id', auth()->user()->id)->first();

            //Personal info
            $student_family_info = DB::table('student_family_record')->where('user_id', auth()->user()->id)->first();
            $student_family_children = DB::table('student_family_children')->where('user_id', auth()->user()->id)->get();
            $student_schools_attended = DB::table('student_schools_attended')->where('user_id', auth()->user()->id)->get();
            $student_subjects = DB::table('student_subjects')->where('user_id', auth()->user()->id)->get();
            $student_educational_background = DB::table('student_educational_background')->where('user_id', auth()->user()->id)->first();
            $student_health_living = DB::table('student_health_living')->where('user_id', auth()->user()->id)->first();
            $student_leisure = DB::table('student_leisure')->where('user_id', auth()->user()->id)->first();
            $student_personality = DB::table('student_personality')->where('user_id', auth()->user()->id)->first();
            $student_misc = DB::table('student_misc')->where('user_id', auth()->user()->id)->first();
            $student_connection_uni = DB::table('student_connection_uni')->where('user_id', auth()->user()->id)->get();

            //Compiles every info about the student in a variable.
            $student_info = [
                'student' => $student,
                'family_info' => $student_family_info,
                'family_children' => $student_family_children,
                'schools_attended' => $student_schools_attended,
                'subjects' => $student_subjects,
                'educational_background' => $student_educational_background,
                'health_living' => $student_health_living,
                'leisure' => $student_leisure,
                'personality' => $student_personality,
                'misc' => $student_misc,
                'connection_uni' => $student_connection_uni
            ];

            //Turns array into an Collection instance.
            $student_info = collect($student_info);
            
            return view('student.index')->with('student_info', $student_info)->with('colleges', \App\College::with('courses')->get());
        }
    }
}
