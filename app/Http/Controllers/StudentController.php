<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Alert;
use App\Student;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function getStudentProfile($id)
    {
        $student = Student::where('user_id', $id)->first();

        if(is_null($student))
            abort(404);

        //Personal info
        $student_family_info = DB::table('student_family_record')->where('user_id', $id)->first();
        $student_family_children = DB::table('student_family_children')->where('user_id', $id)->get();
        $student_schools_attended = DB::table('student_schools_attended')->where('user_id', $id)->get();
        $student_subjects = DB::table('student_subjects')->where('user_id', $id)->get();
        $student_educational_background = DB::table('student_educational_background')->where('user_id', $id)->first();
        $student_health_living = DB::table('student_health_living')->where('user_id', $id)->first();
        $student_leisure = DB::table('student_leisure')->where('user_id', $id)->first();
        $student_personality = DB::table('student_personality')->where('user_id', $id)->first();
        $student_misc = DB::table('student_misc')->where('user_id', $id)->first();
        $student_connection_uni = DB::table('student_connection_uni')->where('user_id', $id)->get();

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

        $student_info = collect($student_info);

        // return $student_info;

        return view('admin.student_profile')->with('student_info', $student_info)->with('colleges', \App\College::with('courses')->get());;
    }

    public function updateStudentProfile(Request $request)
    {
        $student = Student::where('user_id', auth()->user()->id)->first();
        
        $profile = DB::table('students')
                    ->join('student_family_record', 'students.user_id', '=', 'student_family_record.user_id')
                    ->join('student_educational_background', 'students.user_id', '=', 'student_educational_background.user_id')
                    ->join('student_health_living', 'students.user_id', '=', 'student_health_living.user_id')
                    ->join('student_leisure', 'students.user_id', '=', 'student_leisure.user_id')
                    ->join('student_personality', 'students.user_id', '=', 'student_personality.user_id')
                    ->join('student_misc', 'students.user_id', '=', 'student_misc.user_id')
                    ->where('students.user_id', auth()->user()->id)
                    ->update($request->only([
                        'isOldStudent',
                        'student_no',
                        'lastName',
                        'firstName',
                        'middleName',
                        'dateOfBirth',
                        'gender',
                        'religion',
                        'cityAddress',
                        'provincialAddress',
                        'course_id',
                        'placeOfBirth',
                        'civilStatus',
                        'languages',
                        'tellCellNo',
                        'ethnicity',
                        'fatherName',
                        'fatherBirthPlace',
                        'fatherAge',
                        'fatherAddress',
                        'fatherTelNo',
                        'fatherReligion',
                        'fatherNationality',
                        'fatherOccupation',
                        'fatherFirmEmployer',
                        'fatherSchoolAttended',
                        'fatherHobbiesInterests',
                        'fatherHighestDegreeGrade',
                        'motherName',
                        'motherBirthPlace',
                        'motherAge',
                        'motherAddress',
                        'motherTelNo',
                        'motherReligion',
                        'motherNationality',
                        'motherOccupation',
                        'motherFirmEmployer',
                        'motherSchoolAttended',
                        'motherHobbiesInterests',
                        'motherHighestDegreeGrade',
                        'spouseName',
                        'spouseBirthPlace',
                        'spouseAge',
                        'spouseAddress',
                        'spouseTelNo',
                        'spouseReligion',
                        'spouseNationality',
                        'spouseOccupation',
                        'spouseFirmEmployer',
                        'spouseSchoolAttended',
                        'spouseHobbiesInterests',
                        'spouseHighestDegreeGrade',
                        'traitsLikeToHave',
                        'whoToDiscussProblem',
                        'parentsLivingTogether',
                        'numberMembersFamily',
                        'numberChildren',
                        'numberRelatives',
                        'numberHouseHelpers',
                        'guardianName',
                        'guardianRelation',
                        'languagesSpokenAtHome',
                        'highSchoolAverage',
                        'highSchoolHonorsReceived',
                        'course_id',
                        'courseMajor',
                        'previousCourse',
                        'previousCourseShiftReason',
                        'presentEducVocaPlans',
                        'chooseSchool_familySuggestion',
                        'chooseSchool_familyTradition',
                        'chooseSchool_personalChoice',
                        'chooseSchool_friendChoice',
                        'chooseSchool_teacherChoice',
                        'chooseSchool_followingIAdmired',
                        'chooseSchool_otherReasonChoseSchool',
                        'coursePreferredToTakeInstead',
                        'howComeSchool_personalChoice',
                        'howComeSchool_parentChoice',
                        'howComeSchool_friendRecommendation',
                        'howComeSchool_othersSpecified',
                        'course_knowledge_taking_up',
                        'course_knowledge_whereGetInfo',
                        'financialAid_family',
                        'financialAid_savings',
                        'financialAid_partTime',
                        'financialAid_governmentAid',
                        'financialAid_scholar',
                        'financialAid_othersSpecified',
                        'selfEval_barely',
                        'selfEval_failedMost',
                        'selfEval_hardTimePassing',
                        'selfEval_dificultySomeSubjects',
                        'selfEval_fearFailSem',
                        'selfEval_confidentFinishCourse',
                        'selfEval_stillAdjusting',
                        'selfEval_remarks',
                        // 'physical_height',
                        // 'physical_weight',
                        'physical_complexion',
                        'physical_mole',
                        'physical_Others',
                        'physical_wearGlasses',
                        'physicalPrograms_aerobic',
                        'physicalPrograms_weightLiftBodyBuild',
                        'physicalPrograms_stretchSwim',
                        'physicalPrograms_dancingGymnastics',
                        'physicalPrograms_gamesSports',
                        'physicalPrograms_others',
                        'sufferingPhysicalAilment_allergy',
                        'sufferingPhysicalAilment_asthma',
                        'sufferingPhysicalAilment_migraneDizziness',
                        'sufferingPhysicalAilment_stomachache',
                        'sufferingPhysicalAilment_others',
                        'physicianHandling',
                        'whereYouLived',
                        'howManyPresentPlace',
                        'howManyShareRoom',
                        'membershipOnCampus',
                        'membershipOffCampus',
                        'leisureOrg',
                        'leisureHobbiesInterests',
                        'leisureAwardsReceived',
                        'personality_friendly',
                        'personality_reserved',
                        'personality_stubborn',
                        'personality_capable',
                        'personality_tolerant',
                        'personality_calm',
                        'personality_anxious',
                        'personality_depressed',
                        'personality_nervous',
                        'personality_easily_exhausted',
                        'personality_quiet',
                        'personality_unhappy',
                        'personality_pessimistic',
                        'personality_shy',
                        'personality_selfConfident',
                        'personality_jealous',
                        'personality_talented',
                        'personality_quickTempered',
                        'personality_cynical',
                        'personality_tactful',
                        'personality_conscientious',
                        'personality_talkative',
                        'personality_cheerful',
                        'personality_lazy',
                        'personality_submissive',
                        'personality_excited',
                        'personality_irritable',
                        'personality_poorHealth',
                        'personality_frequentDaydreaming',
                        'personality_sarcastic',
                        'personality_lovable',
                        'personality_aloof',
                        'personalityOthers',
                        'significantEventsInLife',
                        'humiliationSenseOfFailure',
                        'previousCounseling',
                        'whenPreviousCounseling',
                        'whoPreviousCounseling',
                        'problemInLife',
                    ]));
        
        if($request->height_measurement == "ft_in"){
            $inch_to_feet = $request->input('physical_height_in') / 12;
            $feet_to_meter = ($request->input('physical_height_ft') + $inch_to_feet) * 0.3048;

            DB::table('student_health_living')
                ->where('student_health_living.user_id', auth()->user()->id)
                ->update([
                    'physical_height' => $feet_to_meter
                ]);
        }
        else{
            DB::table('student_health_living')
                ->where('student_health_living.user_id', auth()->user()->id)
                ->update([
                    'physical_height' => $request->input('physical_height_m')
                ]);
        }

        if($request->weight_measurement == "lb"){
            $kg = $request->input('physical_weight_lb') * 0.45359237;

            DB::table('student_health_living')
                ->where('student_health_living.user_id', auth()->user()->id)
                ->update([
                    'physical_weight' => $kg
                ]);
        }
        else{
            DB::table('student_health_living')
                ->where('student_health_living.user_id', auth()->user()->id)
                ->update([
                    'physical_weight' => $request->input('physical_weight_kg')
                ]);
        }
        

        DB::table('student_family_children')->where('user_id', auth()->user()->id)->delete();
            for($x = 0; $x < count($request->childrenName); $x++){
                if(!is_null($request->childrenName[$x])){
                    DB::table('student_family_children')->insert([
                        'user_id' => auth()->user()->id,
                        'childrenName' => $request->childrenName[$x],
                        'childrenGender' => $request->childrenGender[$x],
                        'childrenAge' => $request->childrenAge[$x],
                        'childrenCivilStatus' => $request->childrenCivilStatus[$x],
                        'childrenSchoolOccupation' => $request->childrenSchoolOccupation[$x],
                        'childrenGradeYearCompanyFirm' => $request->childrenGradeYearCompanyFirm[$x],
                    ]);
                }
            }
        

        DB::table('student_schools_attended')->where('user_id', auth()->user()->id)->delete();
            for($x = 0; $x < count($request->schoolName); $x++){
                if(!is_null($request->schoolName[$x])){
                    DB::table('student_schools_attended')->insert([
                        'user_id' => auth()->user()->id,
                        'schoolName' => $request->schoolName[$x],
                        'schoolDateAttendance' => $request->schoolDateAttendance[$x],
                        'schoolGradeYearLevel' => $request->schoolGradeYearLevel[$x],
                        'schoolHonorsReceived' => $request->schoolHonorsReceived[$x],
                    ]);
                }
            }
        DB::table('student_subjects')->where('user_id', auth()->user()->id)->delete();
        for($x = 0; $x < count($request->subjectDisliked); $x++){
            if(!is_null($request->subjectDisliked[$x])){
                DB::table('student_subjects')->insert([
                    'user_id' => auth()->user()->id,
                    'name' => $request->subjectDisliked[$x],
                    'grade' => $request->subjectDislikedGrade[$x],
                    'isSubjectLiked' => false,
                ]);
            }
        }
        for($x = 0; $x < count($request->subjectLiked); $x++){
            if(!is_null($request->subjectLiked[$x])){
                DB::table('student_subjects')->insert([
                    'user_id' => auth()->user()->id,
                    'name' => $request->subjectLiked[$x],
                    'grade' => $request->subjectLikedGrade[$x],
                    'isSubjectLiked' => true,
                ]);
            }
        }

        DB::table('student_connection_uni')->where('user_id', auth()->user()->id)->delete();  
        for($x = 0; $x < count($request->personConnectedName); $x++){
            if(!is_null($request->personConnectedName[$x])){
                DB::table('student_connection_uni')->insert([
                    'user_id' => auth()->user()->id,
                    'personConnectedName' => $request->personConnectedName[$x],
                    'personConnectedOccupation' => $request->personConnectedOccupation[$x],
                    'personConnectedAddress' => $request->personConnectedAddress[$x],
                ]);
            }
        }
        $student->update(['infoVerification' => 0]);
        Alert::where('user_id', auth()->user()->id)->delete();
        
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => 'Student submitted updated form.',
            'rating' => 2,
        ]);
        
        // return $profile;
        return redirect('/dashboard');
    }

    public function searchStudent(Request $request)
    {
        // return $request;
        $students = Student::with('course')
            ->join('student_educational_background', 'students.user_id', 'student_educational_background.user_id');

        if($request->has('name') && !is_null($request->name)){
            $students = $students
                            ->where('lastName', 'like', '%' . $request->name . '%')
                            ->orWhere('firstName', 'like', '%' . $request->name . '%')
                            ->orWhere('middleName', 'like', '%' . $request->name . '%');
        }

        if($request->has('address') && !is_null($request->address))
        {
            $students = $students
                            ->where('cityAddress', 'like', '%' . $request->address . '%')
                            ->orWhere('provincialAddress', 'like', '%' . $request->address . '%');
        }

        if($request->has('course') && $request->course != "-1"){
            $students = $students->where('course_id', $request->course);
        }

        if($request->has('genderSearch'))
        {
            if($request->genderSearch != 'Any')
                $students = $students->where('gender', $request->genderSearch);
        }

        if($request->has('pdfVerification'))
        {
            switch($request->pdfVerification)
            {
                case 1:
                    //Verified only
                    $students->where('infoVerification', 1);
                    break;
                case 0:
                    //Not verified only
                    $students->where('infoVerification', 0)->orWhere('infoVerification', 2);                    
                    break;
            }
        }

        if($request->has('religion') && $request->religion != "-1")
        {
            $students->where('religion', $request->religion);
        }

        if($request->has('financialAid_family')){
            $students = $students->where('financialAid_family', 1);
        }
        if($request->has('financialAid_savings')){
            $students = $students->where('financialAid_savings', 1);
        }
        if($request->has('financialAid_partTime')){
            $students = $students->where('financialAid_partTime', 1);
        }
        if($request->has('financialAid_governmentAid')){
            $students = $students->where('financialAid_governmentAid', 1);
        }
        if($request->has('financialAid_scholar')){
            $students = $students->where('financialAid_scholar', 1);
        }
        if($request->has('financialAid_others')){
            $students = $students->whereNotNull('financialAid_othersSpecified');
        }
        
        $students = $students->get();

        if(auth()->user()->role != 1)
        {
            if($request->has('college') && $request->college != "-1"){
                $students = $students->where('college', $request->college);
            }

            return view('admin.dashboard')->with('students', $students)->with('colleges', \App\College::all())->with('request', $request);

        }
        else
        {
            $students = $students->where('college', auth()->user()->counsel->college_id);
            return view('counsel.dashboard')->with('students', $students)->with('colleges', \App\College::all())->with('request', $request);

        }

    }

    public function verifyInformation(Request $request)
    {
        $student = Student::where('user_id', $request->user_id)->firstOrFail();
        $message = null;

        switch($request->verifyForm)
        {
            case 1:
                $student->update(['infoVerification' => 1]);
                $message = "Student information has been verified and approved";
                break;
            default:
                $student->update(['infoVerification' => 2]);
                $message = "Student information has marked for revision";

                if(auth()->user()->role == 0){
                    $name = 'Administrator';
                }else if(auth()->user()->role == 1){
                    $name = auth()->user()->counsel->full_name;
                }else{
                    exit;
                }
                
                User::find($request->user_id)->alerts()->create([
                    'message' => $request->message,
                    'counsel' => $name,
                ]);
                break;
                
        }
        Log::create([
            'user_id' => auth()->user()->id,
            'message' => $message . " (#id: $student->user->id, name: $student->full_name)",
            'rating' => 2
        ]);

        return redirect()->back();
    }
}
