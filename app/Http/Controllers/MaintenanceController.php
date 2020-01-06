<?php

namespace App\Http\Controllers;

use App\Counselor;
use App\College;
use App\Course;
use App\User;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Config;
use Illuminate\Support\Facades\Validator;

class MaintenanceController extends Controller
{
    public function indexView()
    {
        return redirect()->route('maintenance.colleges');
    }

    public function collegesView()
    {
        $colleges = College::withCount('courses')->get();

        return view('admin.maintenance.colleges')->with('colleges', $colleges);
    }

    public function coursesView($id)
    {
        $college = College::findOrFail($id);
        $courses = Course::withCount('students')->where('college_id', $id)->get();

        return view('admin.maintenance.courses')->with('courses', $courses)->with('college', $college);
    }

    public function accountsView()
    {
        $counsels = User::has('counsel')->with('counsel.college')->get();
        $counselsDeactivated = User::onlyTrashed()->has('counsel')->with('counsel.college')->get();
        $colleges = College::all();
        // return [
        //     'counsels' => $counsels,
        //     'counselsDeactivated' => $counselsDeactivated,
        // ];
        return view('admin.maintenance.accounts')
                ->with('counsels', $counsels)
                ->with('counselsDeactivated', $counselsDeactivated)
                ->with('colleges', $colleges);
    }

    public function addCollege(Request $request)
    {
        $request->validate([
            'college_name' => 'required|string|unique:colleges,name',
        ]);

        College::create([
            'name' => $request->college_name,
        ]);
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => 'College added (' . $request->college_name . ')',
            'rating' => 1
        ]);

        return redirect()->route('maintenance.colleges');
    }

    public function addCourse(Request $request)
    {
        $request->validate([
            'college_id' => 'required|integer|exists:colleges,id',
            'course_name' => 'required|string|unique:courses,name',
        ]);

        Course::create([
            'college_id' => $request->college_id,
            'name' => $request->course_name,
        ]);
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => 'Course added: (' . $request->course_name . ')',
            'rating' => 1
        ]);
        
        return redirect()->back();
    }

    public function updateCollege(Request $request)
    {
        $request->validate([
            'college_id' => 'required|exists:colleges,id',
            'college_name' => 'required|string',
        ]);

        $college = College::findOrFail($request->college_id);
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => "College updated (from $college->name to $request->college_name)",
            'rating' => 1
        ]);

        $college->update([
            'name' => $request->college_name
        ]);

        return redirect()->route('maintenance.colleges');
    }

    public function updateCourse(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'course_name' => 'required|string',
        ]);

        $course = Course::find($request->course_id);
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => "Course updated (from $course->name to $request->course_name)",
            'rating' => 1
        ]);

        $course->update([
            'name' => $request->course_name
        ]);

        return redirect()->back();
    }

    public function deactivateAccount(Request $request)
    {
        $user = User::findOrFail($request->usr_id);
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => "Deleted a user (#id: $user->id, email: $user->email)",
            'rating' => 1
        ]);
        $user->delete();
        return redirect()->back();
    }

    public function reactivateAccount(Request $request)
    {
        $user = User::withTrashed()->where('id', $request->usr_id)->firstOrFail();
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => "Restored a user (#id: $user->id, email: $user->email)",
            'rating' => 1
        ]);
        $user->restore();
        return redirect()->back();
    }

    public function deleteCollege(Request $request)
    {
        //TODO: Soft deletion
        $college = College::findOrFail($request->college_id);
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => "Deleted a college (#id: $college->id, name: $college->name)",
            'rating' => 1
        ]);
        $college->delete();
        return redirect()->back();
    }

    public function deleteCourse(Request $request)
    {
        //TODO: Soft deletion
        $course = Course::findOrFail($request->crs_id);
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => "Deleted a course (#id: $course->id, email: $course->name)",
            'rating' => 1
        ]);
        $course->delete();
        return redirect()->back();
    }

    public function addAccount(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            // 'college_id', 'required|integer|exists:colleges,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 1,
            'email_verified_at' => \Carbon\Carbon::now(),
        ]);
        Counselor::create([
            'user_id' => $user->id,
            'college_id' => $request->college_id,
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'middleName' => $request->middleName ?? null,
            'extName' => $request->extName,
            'dateWorking' => $request->dateWorking ?? \Carbon\Carbon::now()->toDateString(),
        ]);

        Log::create([
            'user_id' => auth()->user()->id,
            'message' => "Added a new account (#id: $user->id, email: $user->email)",
            'rating' => 1
        ]);

        return redirect()->route('maintenance.accounts');
    }

    public function showSystemLogs(Request $request)
    {
        // $logs = Log::with(['user.counsel', 'user.student'])->get();
        $logs = Log::orderBy('id', 'desc')->simplePaginate(10);
        // return $logs;

        return view('admin.maintenance.logs')
                    ->with('logs', $logs);
    }

    public function getConfigs()
    {
        $email_verify = Config::where('config_key', 'email_verify')->first();
        return view('admin.maintenance.config')
            ->with('email_verify', $email_verify);
    }

    public function updateConfig(Request $request)
    {
        Config::find('email_verify')->update([
            'value' => $request->email_verify
        ]);
        return redirect()->back();
    }
}
