<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Student;
use App\Config;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //TODO: Validation for students
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'course' => ['required', 'integer', 'exists:courses,id'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //Sets role to admin if no other account existed.
        if(User::all()->count() == 0)
            $role = 0;
        //Sets role to student if other account existed.
        else
            $role = 2;

        //Creates user account.
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $role,
        ]);

        if(Config::find('email_verify')->value == 0){
            $user->email_verified_at = \Carbon\Carbon::now();
            $user->save();
        }

        //Creates student account if role is set to student.
        if($role == 2){
            Student::create([
                'user_id' => $user->id,
                'student_no' => $data['student_no'] ?? null,
                'firstName' => $data['firstName'],
                'middleName' => $data['middleName'] ?? null,
                'lastName' => $data['lastName'],
                'extName' => $data['extName'],
                'course_id' => $data['course'],
                'gender' => 'Male',
            ]);

            //Student's family record info
            //Creates a blank data for student personal information.

            //Student family records
            DB::table('student_family_record')->insert([
                'user_id' => $user->id,

                //Father info
                'fatherName' => null,
                'fatherBirthPlace' => null,
                'fatherAge' => null,
                'fatherTelNo' => null,
                'fatherReligion' => null,
                'fatherNationality' => null,
                'fatherOccupation' => null,
                'fatherFirmEmployer' => null,
                'fatherSchoolAttended' => null,
                'fatherHobbiesInterests' => null,
                'fatherHighestDegreeGrade' => null,

                //Mother info
                'motherName' => null,
                'motherBirthPlace' => null,
                'motherAge' => null,
                'motherTelNo' => null,
                'motherReligion' => null,
                'motherNationality' => null,
                'motherOccupation' => null,
                'motherFirmEmployer' => null,
                'motherSchoolAttended' => null,
                'motherHobbiesInterests' => null,
                'motherHighestDegreeGrade' => null,

                //Spouse info
                'spouseName' => null,
                'spouseBirthPlace' => null,
                'spouseAge' => null,
                'spouseTelNo' => null,
                'spouseReligion' => null,
                'spouseNationality' => null,
                'spouseOccupation' => null,
                'spouseFirmEmployer' => null,
                'spouseSchoolAttended' => null,
                'spouseHobbiesInterests' => null,
                'spouseHighestDegreeGrade' => null,

                'traitsLikeToHave' => null,
                'whoToDiscussProblem' => null,
                'numberMembersFamily' => 0,
                'numberChildren' => 0,
                'numberRelatives' => 0,
                'numberHouseHelpers' => 0,

                //Guardian, if not living with parents
                'guardianName' => null,
                'guardianRelation' => null,

                'languagesSpokenAtHome' => null,
            ]);

            DB::table('student_schools_attended')->insert([
                'user_id' => $user->id,
                'schoolName' => null,
                'schoolDateAttendance' => null,
                'schoolGradeYearLevel' => null,
                'schoolHonorsReceived' => null,
            ]);

            DB::table('student_educational_background')->insert([
                'user_id' => $user->id,
            ]);

            DB::table('student_health_living')->insert([
                'user_id' => $user->id,
            ]);

            DB::table('student_leisure')->insert([
                'user_id' => $user->id,
            ]);

            DB::table('student_personality')->insert([
                'user_id' => $user->id,
            ]);

            DB::table('student_misc')->insert([
                'user_id' => $user->id,
            ]);
        }

        //Returns user model to the application, if successful.
        return $user;
    }
}
