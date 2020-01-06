<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Student;
use App\Counselor;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ICS Student account.
        User::create([
            'email' => 'sidney@gmail.com',
            'password' => Hash::make('password'),
            'role' => 2,
        ]);

        //ICS Student account.
        User::create([
            'email' => 'ics_counselor@wmsu.edu.ph',
            'password' => Hash::make('password'),
            'role' => 1,
        ]);

        Student::create([
            'user_id' => 2,
            'student_no' => '2015-03318',
            'lastName' => 'Sidney',
            'firstName' => 'Anthony Rigdon',
            'middleName' => '',
            'dateOfBirth' => '1999-01-01',
            'gender' => 'Male',
            'religion' => null,
            'cityAddress' => 'Zamboanga City',
            'provincialAddress' => 'Zamboanga del Sur',
            'course_id' => 48,
            'courseMajor' => 'Information Technology',
            'placeOfBirth' => 'Zamboanga City',
            'civilStatus' => 1,
            'languages' => 'English, Filipino, Chavacano, Bisaya, Tausug',
            'tellCellNo' => '09000000001',
            'ethnicity' => null,
        ]);

        DB::table('student_family_record')->insert(['user_id' => 2]);
        DB::table('student_family_children')->insert(['user_id' => 2]);
        DB::table('student_schools_attended')->insert(['user_id' => 2]);
        DB::table('student_subjects')->insert(['user_id' => 2]);
        DB::table('student_educational_background')->insert(['user_id' => 2]);
        DB::table('student_health_living')->insert(['user_id' => 2]);
        DB::table('student_leisure')->insert(['user_id' => 2]);
        DB::table('student_personality')->insert(['user_id' => 2]);
        DB::table('student_misc')->insert(['user_id' => 2]);
        DB::table('student_connection_uni')->insert(['user_id' => 2]);

        Counselor::create([
            'user_id' => 3,
            'college_id' => 15,
            'lastName' => 'Ln',
            'firstName' => 'Fn',
            'middleName' => null,
        ]);

        User::where('email_verified_at', null)->update(['email_verified_at' => \Carbon\Carbon::now()]);
    }
}
