<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Student profile
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned();
            $table->boolean('isOldStudent')->default(true);
            $table->string('student_no')->unique()->nullable();
            $table->softDeletes();

            //PDF status
            $table->tinyInteger('infoVerification')->unsigned()->default(0);

            //Personal information
            $table->string('lastName')->nullable();
            $table->string('firstName')->nullable();
            $table->string('middleName')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('cityAddress')->nullable();
            $table->string('provincialAddress')->nullable();
            $table->integer('course_id')->unsigned()->nullable();
            $table->string('courseMajor')->nullable();
            $table->string('placeOfBirth')->nullable();
            $table->tinyInteger('civilStatus')->default(1);
            $table->string('languages')->nullable();
            $table->string('tellCellNo')->nullable();
            $table->string('ethnicity')->nullable();

            $table->timestamps();
        });

        //Student's family record info
        Schema::create('student_family_record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned();

            //Father info
            $table->string('fatherName')->nullable();
            $table->string('fatherBirthPlace')->nullable();
            $table->string('fatherAge')->nullable();
            $table->string('fatherTelNo')->nullable();
            $table->string('fatherAddress')->nullable();
            $table->string('fatherReligion')->nullable();
            $table->string('fatherNationality')->nullable();
            $table->string('fatherOccupation')->nullable();
            $table->string('fatherFirmEmployer')->nullable();
            $table->string('fatherSchoolAttended')->nullable();
            $table->string('fatherHobbiesInterests')->nullable();
            $table->string('fatherHighestDegreeGrade')->nullable();

            //Mother info
            $table->string('motherName')->nullable();
            $table->string('motherBirthPlace')->nullable();
            $table->string('motherAge')->nullable();
            $table->string('motherAddress')->nullable();
            $table->string('motherTelNo')->nullable();
            $table->string('motherReligion')->nullable();
            $table->string('motherNationality')->nullable();
            $table->string('motherOccupation')->nullable();
            $table->string('motherFirmEmployer')->nullable();
            $table->string('motherSchoolAttended')->nullable();
            $table->string('motherHobbiesInterests')->nullable();
            $table->string('motherHighestDegreeGrade')->nullable();

            //Spouse info
            $table->string('spouseName')->nullable();
            $table->string('spouseBirthPlace')->nullable();
            $table->string('spouseAge')->nullable();
            $table->string('spouseAddress')->nullable();
            $table->string('spouseTelNo')->nullable();
            $table->string('spouseReligion')->nullable();
            $table->string('spouseNationality')->nullable();
            $table->string('spouseOccupation')->nullable();
            $table->string('spouseFirmEmployer')->nullable();
            $table->string('spouseSchoolAttended')->nullable();
            $table->string('spouseHobbiesInterests')->nullable();
            $table->string('spouseHighestDegreeGrade')->nullable();

            $table->string('traitsLikeToHave')->nullable();
            $table->string('whoToDiscussProblem')->nullable();
            $table->boolean('parentsLivingTogether')->default(1);
            $table->integer('numberMembersFamily')->unsigned()->default(0);
            $table->integer('numberChildren')->unsigned()->default(0);
            $table->integer('numberRelatives')->unsigned()->default(0);
            $table->integer('numberHouseHelpers')->unsigned()->default(0);

            //Guardian, if not living with parents
            $table->string('guardianName')->nullable();
            $table->string('guardianRelation')->nullable();

            $table->string('languagesSpokenAtHome')->nullable();
        });

        Schema::create('student_family_children', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('childrenName')->nullable();
            $table->string('childrenGender')->nullable();
            $table->integer('childrenAge')->unsigned()->nullable()->default(0);
            $table->tinyInteger('childrenCivilStatus')->nullable()->default(1);
            $table->string('childrenSchoolOccupation')->nullable();
            $table->string('childrenGradeYearCompanyFirm')->nullable();
        });

        Schema::create('student_schools_attended', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('schoolName')->nullable();
            $table->string('schoolDateAttendance')->nullable();
            $table->string('schoolGradeYearLevel')->nullable();
            $table->string('schoolHonorsReceived')->nullable();
        });

        Schema::create('student_subjects', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('grade')->nullable();
            $table->boolean('isSubjectLiked')->default(1);
        });

        Schema::create('student_educational_background', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned();
            $table->string('highSchoolAverage')->nullable();
            $table->string('highSchoolHonorsReceived')->nullable();
            $table->string('previousCourse')->nullable();
            $table->string('previousCourseShiftReason')->nullable();
            $table->string('presentEducVocaPlans')->nullable();

            //What made you choose this school?
            $table->boolean('chooseSchool_familySuggestion')->default(0);
            $table->boolean('chooseSchool_familyTradition')->default(0);
            $table->boolean('chooseSchool_personalChoice')->default(0);
            $table->boolean('chooseSchool_friendChoice')->default(0);
            $table->boolean('chooseSchool_teacherChoice')->default(0);
            $table->boolean('chooseSchool_followingIAdmired')->default(0);
            $table->string('chooseSchool_otherReasonChoseSchool')->nullable();

            $table->string('coursePreferredToTakeInstead')->nullable();

            $table->boolean('howComeSchool_personalChoice')->default(0);
            $table->boolean('howComeSchool_parentChoice')->default(0);
            $table->boolean('howComeSchool_friendRecommendation')->default(0);
            $table->string('howComeSchool_othersSpecified')->nullable();

            $table->integer('course_knowledge_taking_up')->nullable();
            $table->string('course_knowledge_whereGetInfo')->nullable();

            //Source of financial
            $table->boolean('financialAid_family')->default(0);
            $table->boolean('financialAid_savings')->default(0);
            $table->boolean('financialAid_partTime')->default(0);
            $table->boolean('financialAid_governmentAid')->default(0);
            $table->boolean('financialAid_scholar')->default(0);
            $table->string('financialAid_othersSpecified')->nullable();

            //Self eval
            $table->boolean('selfEval_barely')->default(0);
            $table->boolean('selfEval_failedMost')->default(0);
            $table->boolean('selfEval_hardTimePassing')->default(0);
            $table->boolean('selfEval_difficultySomeSubjects')->default(0);
            $table->boolean('selfEval_fearFailSem')->default(0);
            $table->boolean('selfEval_confidentFinishCourse')->default(0);
            $table->boolean('selfEval_stillAdjusting')->default(0);
            $table->string('selfEval_remarks')->nullable();
        });

        Schema::create('student_health_living', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned();
            
            $table->string('physical_height')->decimal(3, 2)->nullable();
            $table->string('physical_weight')->decimal(3, 2)->nullable();
            $table->string('physical_complexion')->nullable();
            $table->string('physical_mole')->nullable();
            $table->string('physical_Others')->nullable();
            $table->boolean('physical_wearGlasses')->nullable();

            //Physical programs participated
            $table->boolean('physicalPrograms_aerobic')->nullable();
            $table->boolean('physicalPrograms_weightLiftBodyBuild')->nullable();
            $table->boolean('physicalPrograms_stretchSwim')->nullable();
            $table->boolean('physicalPrograms_dancingGymnastics')->nullable();
            $table->boolean('physicalPrograms_gamesSports')->nullable();
            $table->string('physicalPrograms_others')->nullable();


            //Physical ailment
            $table->boolean('sufferingPhysicalAilment_allergy')->nullable();
            $table->boolean('sufferingPhysicalAilment_asthma')->nullable();
            $table->boolean('sufferingPhysicalAilment_migraneDizziness')->nullable();
            $table->boolean('sufferingPhysicalAilment_stomachache')->nullable();
            $table->string('sufferingPhysicalAilment_others')->nullable();
            $table->string('physicianHandling')->nullable();

            //Living
            $table->integer('whereYouLived')->nullable();
            $table->integer('howManyPresentPlace')->nullable();
            $table->integer('howManyShareRoom')->nullable();
        });

        Schema::create('student_leisure', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned();

            $table->string('membershipOnCampus')->nullable();
            $table->string('membershipOffCampus')->nullable();
            $table->string('leisureOrg')->nullable();
            $table->string('leisureHobbiesInterests')->nullable();
            $table->string('leisureAwardsReceived')->nullable();
        });

        Schema::create('student_personality', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned();

            $table->boolean('personality_friendly')->default(0);
            $table->boolean('personality_reserved')->default(0);
            $table->boolean('personality_stubborn')->default(0);
            $table->boolean('personality_capable')->default(0);
            $table->boolean('personality_tolerant')->default(0);
            $table->boolean('personality_calm')->default(0);
            $table->boolean('personality_anxious')->default(0);
            $table->boolean('personality_depressed')->default(0);
            $table->boolean('personality_nervous')->default(0);
            $table->boolean('personality_easily_exhausted')->default(0);
            $table->boolean('personality_quiet')->default(0);
            $table->boolean('personality_unhappy')->default(0);
            $table->boolean('personality_pessimistic')->default(0);
            $table->boolean('personality_shy')->default(0);
            $table->boolean('personality_selfConfident')->default(0);
            $table->boolean('personality_jealous')->default(0);
            $table->boolean('personality_talented')->default(0);
            $table->boolean('personality_quickTempered')->default(0);
            $table->boolean('personality_cynical')->default(0);
            $table->boolean('personality_tactful')->default(0);
            $table->boolean('personality_conscientious')->default(0);
            $table->boolean('personality_talkative')->default(0);
            $table->boolean('personality_cheerful')->default(0);
            $table->boolean('personality_lazy')->default(0);
            $table->boolean('personality_submissive')->default(0);
            $table->boolean('personality_excited')->default(0);
            $table->boolean('personality_irritable')->default(0);
            $table->boolean('personality_poorHealth')->default(0);
            $table->boolean('personality_frequentDaydreaming')->default(0);
            $table->boolean('personality_sarcastic')->default(0);
            $table->boolean('personality_lovable')->default(0);
            $table->boolean('personality_aloof')->default(0);
            $table->string('personalityOthers')->nullable();
        });

        Schema::create('student_misc', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unique()->unsigned();

            $table->string('significantEventsInLife')->nullable();
            $table->string('humiliationSenseOfFailure')->nullable();
            $table->boolean('previousCounseling')->default(0);
            $table->string('whenPreviousCounseling')->nullable();
            $table->string('whoPreviousCounseling')->nullable();
            $table->string('problemInLife')->nullable();
        });

        Schema::create('student_connection_uni', function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned();

            $table->string('personConnectedName')->nullable();
            $table->string('personConnectedOccupation')->nullable();
            $table->string('personConnectedAddress')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students')->nullable();
    }
}
