<?php

use App\User;
use App\Course;
use App\College;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Default admin account.
        User::create([
            'email' => 'guidancewmsu@gmail.com',
            'password' => Hash::make('GuidanceWMSU'),
            'email_verified_at' => '2019-01-01 00:00:00',
            'role' => 0,
        ]);

        College::create(['name' => 'College of Agriculture']);
        Course::create([
            'college_id' => 1, 
            'name' => 'Bachelor of Science in Agribusiness'
        ]);
        Course::create([
            'college_id' => 1, 
            'name' => 'Bachelor of Science in Agricultural Engineering'
        ]);
        Course::create([
            'college_id' => 1, 
            'name' => 'Bachelor of Science in Agriculture'
        ]);

        College::create(['name' => 'College of Architecture']);
        Course::create([
            'college_id' => 2,
            'name' => 'Bachelor of Science in Architecture'
        ]);

        College::create(['name' => 'College of Asian & Islamic Studies']);
        Course::create([
            'college_id' => 3,
            'name' => 'Bachelor of Arts in Asian Studies'
        ]);
        Course::create([
            'college_id' => 3,
            'name' => 'Bachelor of Science in Islamic Studies'
        ]);

        College::create(['name' => 'College of Criminal Justice Education']);
        Course::create([
            'college_id' => 4,
            'name' => 'Bachelor of Science in Criminology'
        ]);

        College::create(['name' => 'College of Teacher Education']);
        Course::create([
            'college_id' => 5,
            'name' => 'Bachelor of Elementary Education'
        ]);
        Course::create([
            'college_id' => 5,
            'name' => 'Bachelor of Secondary Education'
        ]);

        College::create(['name' => 'College of Engineering']);
        Course::create([
            'college_id' => 6,
            'name' => 'Bachelor of Science in Biosystem & Agricultural Engineering'
        ]);
        Course::create([
            'college_id' => 6,
            'name' => 'Bachelor of Science in Civil Engineering'
        ]);
        Course::create([
            'college_id' => 6,
            'name' => 'Bachelor of Science in Computer Engineering'
        ]);
        Course::create([
            'college_id' => 6,
            'name' => 'Bachelor of Science in Electrical Engineering'
        ]);
        Course::create([
            'college_id' => 6,
            'name' => 'Bachelor of Science in Environmental Engineering'
        ]);
        Course::create([
            'college_id' => 6,
            'name' => 'Bachelor of Science in Geodetic Engineering'
        ]);
        Course::create([
            'college_id' => 6,
            'name' => 'Bachelor of Science in Electronics Engineering'
        ]);
        Course::create([
            'college_id' => 6,
            'name' => 'Bachelor of Science in Industrial Management Engineering'
        ]);
        Course::create([
            'college_id' => 6,
            'name' => 'Bachelor of Science in Mechanical Engineering'
        ]);
        Course::create([
            'college_id' => 6,
            'name' => 'Bachelor of Science in Sanitary Engineering'
        ]);
        Course::create([
            'college_id' => 6,
            'name' => 'General Engineering',
        ]);

        College::create(['name' => 'College of Home Economics']);
        Course::create([
            'college_id' => 7,
            'name' => 'Bachelor of Science in Food Technology'
        ]);
        Course::create([
            'college_id' => 7,
            'name' => 'Bachelor of Science in Home Economics Education'
        ]);
        Course::create([
            'college_id' => 7,
            'name' => 'Bachelor of Science in Hotel & Restaurant Management'
        ]);
        Course::create([
            'college_id' => 7,
            'name' => 'Bachelor of Science in Nutrition & Dietetics'
        ]);

        College::create(['name' => 'College of Liberal Arts']);
        Course::create([
            'college_id' => 8,
            'name' => 'Bachelor of Arts in English'
        ]);
        Course::create([
            'college_id' => 8,
            'name' => 'Bachelor of Arts in Filipino'
        ]);
        Course::create([
            'college_id' => 8,
            'name' => 'Bachelor of Arts in History'
        ]);
        Course::create([
            'college_id' => 8,
            'name' => 'Bachelor of Arts in Mass Communication Major in Broadcasting'
        ]);
        Course::create([
            'college_id' => 8,
            'name' => 'Bachelor of Arts in Mass Communication Major in Journalism'
        ]);
        Course::create([
            'college_id' => 8,
            'name' => 'Bachelor of Arts in Political Science'
        ]);
        Course::create([
            'college_id' => 8,
            'name' => 'Bachelor of Science in Accountancy'
        ]);
        Course::create([
            'college_id' => 8,
            'name' => 'Bachelor of Science in Economics'
        ]);
        Course::create([
            'college_id' => 8,
            'name' => 'Bachelor of Science in Psychology'
        ]);

        College::create(['name' => 'College of Nursing']);
        Course::create([
            'college_id' => 9,
            'name' => 'Bachelor of Science in Nursing'
        ]);

        College::create(['name' => 'College of Physical Education, Recreation and Sports']);
        Course::create([
            'college_id' => 10,
            'name' => 'Bachelor of Physical Education'
        ]);

        College::create(['name' => 'College of Science and Mathematics']);
        Course::create([
            'college_id' => 11,
            'name' => 'Bachelor of Science in Biology'
        ]);
        Course::create([
            'college_id' => 11,
            'name' => 'Bachelor of Science in Chemistry'
        ]);
        Course::create([
            'college_id' => 11,
            'name' => 'Bachelor of Science in Mathematics'
        ]);
        Course::create([
            'college_id' => 11,
            'name' => 'Bachelor of Science in Physics'
        ]);
        Course::create([
            'college_id' => 11,
            'name' => 'Bachelor of Science in Statistics'
        ]);

        College::create(['name' => 'College of Social Work and Community Development']);
        Course::create([
            'college_id' => 12,
            'name' => 'Bachelor of Science in Community Development'
        ]);
        Course::create([
            'college_id' => 12,
            'name' => 'Bachelor of Science in Social Work'
        ]);

        College::create(['name' => 'College of Forestry and Environmental Studies']);
        Course::create([
            'college_id' => 13,
            'name' => 'Bachelor of Science in Agro-Forestry'
        ]);
        Course::create([
            'college_id' => 13,
            'name' => 'Bachelor of Science in Environmental Science'
        ]);
        Course::create([
            'college_id' => 13,
            'name' => 'Bachelor of Science in Forestry'
        ]);

        College::create(['name' => 'College of Law']);
        Course::create([
            'college_id' => 14,
            'name' => 'Bachelor of Law'
        ]);

        College::create(['name' => 'Institute of Computer Studies']);
        Course::create([
            'college_id' => 15,
            'name' => 'Bachelor of Science in Information Technology'
        ]);
        Course::create([
            'college_id' => 15,
            'name' => 'Bachelor of Science in Computer Science'
        ]);

        //Configuration
        DB::table('configs')->insert(
            ['config_key' => 'email_verify', 'value' => false]
        );
    }
}
