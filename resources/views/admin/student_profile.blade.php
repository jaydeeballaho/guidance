@extends('layouts.app')

@section('content')
    {{-- <style>
        .guidance-form > * {
            font-family: 'Times New Roman', Times, serif;
        }

    </style> --}}
    <div class="container mt-4 guidance-form" id="guidance_form">
        <style>
            *:disabled{
                background-color: #fff !important;
            }    
        </style>
        <form id="guidanceForm">
            <div class="row" id="page1">
                <div class="col-12" id="alert">
                    <div class="d-md-none alert alert-info fade show" role="alert">
                        <p>We recommend you to open this in your desktop for optimal experience.</p>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="row">
                        <div class="d-none d-md-block col-4">
                            <img src="{{ asset('img/wmsu.png')}}" alt="WMSU logo" height="100px" width="auto">
                        </div>
                        <div class="col-md-4 col-sm-12" style="display:flex;justify-content:center;align-items:center;flex-direction:column">
                            <p style="padding: 0;margin:0" class="font-weight-bolder">Western Mindanao State University</p>
                            <p style="padding: 0;margin:0" class="font-weight-bolder font-weight-italic">Guidance and Counseling Center</p>
                            <p style="padding: 0;margin:0" class="font-weight-italic">Zamboanga City</p>
                        </div>
                        <div class="d-none d-md-block col-4">
                            <img src="{{ asset('img/guidance.png')}}" alt="ICS logo" height="100px" width="auto">
                        </div>
                    </div>
                    <p class="text-center font-weight-bolder text-uppercase mt-4">Personal Data Form</p>
                </div>
                <div class="col-md-8 col-sm-12 mx-auto">
                    <p class="text-uppercase">To the students:</p>
                    <p class="text-justify" style="text-intent:30px">The purpose of this form is to bring together all essential information that may enable us to assist you in your specific need and difficulties.</p>
                    <p class="text-justify" style="text-intent:30px">All information in this form shall be kept confidential. Please fill in the blanks carefully and sincerely.</p>
                </div>

                <!-- New or Old Student -->
                <div class="col-12 text-center mb-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="student_status" id="student_statusNew" value="0" {{ !($student_info['student']->isOldStudent) ? 'checked' : '' }}>
                        <label class="form-check-label" for="student_statusNew">
                            New Student
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="student_status" id="student_statusOld" value="1" {{ ($student_info['student']->isOldStudent) ? 'checked' : '' }}>
                        <label class="form-check-label" for="student_statusOld">
                            Old Student
                        </label>
                    </div>
                </div>

                <!-- Personal information -->
                <div class="col-12">
                    <h5 class="text-center text-uppercase font-weight-bolder">Personal Information</h5>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Name</label>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Surname" name="lastName" value="{{ $student_info['student']->lastName }}">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="First" name="firstName" value="{{ $student_info['student']->firstName }}">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Middle" name="middleName" value="{{ $student_info['student']->middleName }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Date of Birth</label>
                        <input type="date" class="form-control" placeholder="Date of Birth" name="dateOfBirth" value="{{ $student_info['student']->dateOfBirth }}">
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <input type="text" class="form-control" value="{{ $student_info['student']->gender }}">
                    </div>
                    <div class="form-group">
                        <label for="">Religion</label>
                        <input type="text" class="form-control" name="religion" value="{{ $student_info['student']->religion }}">
                    </div>
                    <div class="form-group">
                        <label for="">City Address</label>
                        <input type="text" class="form-control" name="cityAddress" value="{{ $student_info['student']->cityAddress }}">
                    </div>
                    <div class="form-group">
                        <label for="">Prov. Address</label>
                        <input type="text" class="form-control" name="provincialAddress" value="{{ $student_info['student']->provincialAddress }}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Course & Year</label>
                        {{-- <input type="text" class="form-control" name="courseYear" value="{{ $student_info['student']->courseYear }}"> --}}
                        <select name="course_id" id="course_id" class="form-control">
                            <option value="0">Select course</option>
                            @foreach($colleges as $college)
                                <optgroup label="{{$college->name}}">
                                    @foreach($college->courses as $course)
                                        <option value="{{$course->id}}" {{ ($course->id == $student_info['student']->course_id) ? 'selected="selected"' : '' }}>{{$course->name}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Place of Birth</label>
                        <input type="text" class="form-control" name="placeOfBirth" value="{{ $student_info['student']->placeOfBirth }}">
                    </div>
                    <div class="form-group">
                        <label for="">Civil Status</label>
                        <select name="civilStatus" id="" class="form-control">
                            <option value="1"  {{ ($student_info['student']->civilStatus == 1) ? 'selected="selected"' : '' }}>Single</option>
                            <option value="2"  {{ ($student_info['student']->civilStatus == 2) ? 'selected="selected"' : '' }}>Married</option>
                            <option value="0"  {{ ($student_info['student']->civilStatus == 0) ? 'selected="selected"' : '' }}>Separated</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Language</label>
                        <input type="text" class="form-control" name="languages" value="{{ $student_info['student']->languages }}">
                    </div>
                    <div class="form-group">
                        <label for="">Tel. / Cellphone No.</label>
                        <input type="text" class="form-control" name="telCellNo" value="{{ $student_info['student']->telCellNo }}">
                    </div>
                    <div class="form-group">
                        <label for="">Ethnicity</label>
                        <input type="text" class="form-control" name="ethnicity" value="{{ $student_info['student']->ethnicity }}">
                    </div>
                </div>

                <!-- Family Record -->
                <div class="col-12">
                    <h5 class="text-center text-uppercase font-weight-bolder">Family Record</h5>
                    <div class="row text-center">
                        <div class="d-none d-md-block col-4"><h6>Father</h6></div>
                        <div class="d-none d-md-block col-4"><h6>Mother</h6></div>
                        <div class="d-none d-md-block col-4"><h6>Spouse (if married)</h6></div>
                    </div>
                </div>

                <!-- Father -->
                <div class="col-md-4 col-sm-12">
                    <div class="d-md-none d-lg-none form-group">
                        <h3>Father's Record</h3>
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="fatherName" value="{{ $student_info['family_info']->fatherName }}">
                    </div>
                    <div class="form-group">
                        <label for="">Place of birth & Age</label>
                        <div class="form-row">
                            <div class="col-9">
                                <input type="text" class="form-control" name="fatherBirthPlace" value="{{ $student_info['family_info']->fatherBirthPlace }}">
                            </div>
                            <div class="col-3">
                                <input type="number" min="12" class="form-control" name="fatherAge" value="{{ $student_info['family_info']->fatherAge }}" value="{{ $student_info['family_info']->numberMembersFamily }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Address & Tel. No</label>
                        <div class="form-row">
                            <div class="col-12">
                                <textarea name="fatherAddress" id="" cols="30" rows="3" class="form-control">{{ $student_info['family_info']->fatherAddress }}</textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <input type="text" class="form-control" name="fatherTelNo" value="{{ $student_info['family_info']->fatherTelNo }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Religion</label>
                        <input type="text" class="form-control" name="fatherReligion" value="{{ $student_info['family_info']->fatherReligion }}">
                    </div>
                    <div class="form-group">
                        <label for="">Nationality</label>
                        <input type="text" class="form-control" name="fatherNationality" value="{{ $student_info['family_info']->fatherNationality }}">
                    </div>
                    <div class="form-group">
                        <label for="">Occupation</label>
                        <input type="text" class="form-control" name="fatherOccupation" value="{{ $student_info['family_info']->fatherOccupation }}">
                    </div>
                    <div class="form-group">
                        <label for="">Name of Firm/Employer</label>
                        <input type="text" class="form-control" name="fatherFirmEmployer" value="{{ $student_info['family_info']->fatherFirmEmployer }}">
                    </div>
                    <div class="form-group">
                        <label for="">Highest Degree/Grade</label>
                        <input type="text" class="form-control" name="fatherHighestDegreeGrade" value="{{ $student_info['family_info']->fatherHighestDegreeGrade }}">
                    </div>
                    <div class="form-group">
                        <label for="">Schools Attended</label>
                        <textarea name="fatherSchoolAttended" id="" cols="30" rows="4" class="form-control">{{ $student_info['family_info']->fatherSchoolAttended }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Hobbies & Interests</label>
                        <textarea name="fatherHobbiesInterests" id="" cols="30" rows="4" class="form-control">{{ $student_info['family_info']->fatherHobbiesInterests }}</textarea>
                    </div>
                </div>
                
                <!-- Mother -->
                <div class="col-md-4 col-sm-12">
                    <div class="d-md-none d-lg-none form-group">
                        <h3>Mother's Record</h3>
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="motherName" value="{{ $student_info['family_info']->motherName }}">
                    </div>
                    <div class="form-group">
                        <label for="">Place of birth & Age</label>
                        <div class="form-row">
                            <div class="col-9">
                                <input type="text" class="form-control" name="motherBirthPlace" value="{{ $student_info['family_info']->motherBirthPlace }}">
                            </div>
                            <div class="col-3">
                                <input type="number" min="12" class="form-control" name="motherAge" value="{{ $student_info['family_info']->motherAge }}" value="{{ $student_info['family_info']->numberMembersFamily }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Address & Tel. No</label>
                        <div class="form-row">
                            <div class="col-12">
                                <textarea name="motherAddress" id="" cols="30" rows="3" class="form-control">{{ $student_info['family_info']->motherAddress }}</textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <input type="text" class="form-control" name="motherTelNo" value="{{ $student_info['family_info']->motherTelNo }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Religion</label>
                        <input type="text" class="form-control" name="motherReligion" value="{{ $student_info['family_info']->motherReligion }}">
                    </div>
                    <div class="form-group">
                        <label for="">Nationality</label>
                        <input type="text" class="form-control" name="motherNationality" value="{{ $student_info['family_info']->motherNationality }}">
                    </div>
                    <div class="form-group">
                        <label for="">Occupation</label>
                        <input type="text" class="form-control" name="motherOccupation" value="{{ $student_info['family_info']->motherOccupation }}">
                    </div>
                    <div class="form-group">
                        <label for="">Name of Firm/Employer</label>
                        <input type="text" class="form-control" name="motherFirmEmployer" value="{{ $student_info['family_info']->motherFirmEmployer }}">
                    </div>
                    <div class="form-group">
                        <label for="">Highest Degree/Grade</label>
                        <input type="text" class="form-control" name="motherHighestDegreeGrade" value="{{ $student_info['family_info']->motherHighestDegreeGrade }}">
                    </div>
                    <div class="form-group">
                        <label for="">Schools Attended</label>
                        <textarea name="motherSchoolAttended" id="" cols="30" rows="4" class="form-control">{{ $student_info['family_info']->motherSchoolAttended }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Hobbies & Interests</label>
                        <textarea name="motherHobbiesInterests" id="" cols="30" rows="4" class="form-control">{{ $student_info['family_info']->motherHobbiesInterests }}</textarea>
                    </div>
                </div>

                <!-- Spouse -->
                <div class="col-md-4 col-sm-12">
                    <div class="d-md-none d-lg-none form-group">
                        <h3>Spouse's Record</h3>
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="spouseName" value="{{ $student_info['family_info']->spouseName }}">
                    </div>
                    <div class="form-group">
                        <label for="">Place of birth & Age</label>
                        <div class="form-row">
                            <div class="col-9">
                                <input type="text" class="form-control" name="spouseBirthPlace" value="{{ $student_info['family_info']->spouseBirthPlace }}">
                            </div>
                            <div class="col-3">
                                <input type="number" min="12" class="form-control" name="spouseAge" value="{{ $student_info['family_info']->spouseAge }}" value="{{ $student_info['family_info']->numberMembersFamily }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Address & Tel. No</label>
                        <div class="form-row">
                            <div class="col-12">
                                <textarea name="spouseAddress" id="" cols="30" rows="3" class="form-control">{{ $student_info['family_info']->spouseAddress }}</textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <input type="text" class="form-control" name="spouseTelNo" value="{{ $student_info['family_info']->spouseTelNo }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Religion</label>
                        <input type="text" class="form-control" name="spouseReligion" value="{{ $student_info['family_info']->spouseReligion }}">
                    </div>
                    <div class="form-group">
                        <label for="">Nationality</label>
                        <input type="text" class="form-control" name="spouseNationality" value="{{ $student_info['family_info']->spouseNationality }}">
                    </div>
                    <div class="form-group">
                        <label for="">Occupation</label>
                        <input type="text" class="form-control" name="spouseOccupation" value="{{ $student_info['family_info']->spouseOccupation }}">
                    </div>
                    <div class="form-group">
                        <label for="">Name of Firm/Employer</label>
                        <input type="text" class="form-control" name="spouseFirmEmployer" value="{{ $student_info['family_info']->spouseFirmEmployer }}">
                    </div>
                    <div class="form-group">
                        <label for="">Highest Degree/Grade</label>
                        <input type="text" class="form-control" name="spouseHighestDegreeGrade" value="{{ $student_info['family_info']->spouseHighestDegreeGrade }}">
                    </div>
                    <div class="form-group">
                        <label for="">Schools Attended</label>
                        <textarea name="spouseSchoolAttended" id="" cols="30" rows="4" class="form-control">{{ $student_info['family_info']->spouseSchoolAttended }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Hobbies & Interests</label>
                        <textarea name="spouseHobbiesInterests" id="" cols="30" rows="4" class="form-control">{{ $student_info['family_info']->spouseHobbiesInterests }}</textarea>
                    </div>
                </div>

                <!-- Other family informations -->
                <div class="col-12">
                    <div class="form-group">
                        <label for="">
                            Which of his/her traits would you like to have?
                        </label>
                        <input type="text" class="form-control" name="traitsLikeToHave" value="{{ $student_info['family_info']->traitsLikeToHave }}">
                    </div>
                    <div class="form-group">
                        <label for="">
                            With whom would you rather discuss your problem?
                        </label>
                        <input type="text" class="form-control" name="whoToDiscussProblem" value="{{ $student_info['family_info']->whoToDiscussProblem }}">
                    </div>

                    <div class="form-group">
                        <label for="">
                            Marital status of Parents: Select those which are applicable.
                        </label>
                        <div class="text-center form-inline">
                            <div class="form-check mx-auto">
                                <label class="form-check-label">
                                    <input type="radio" name="parentsLivingTogether" value="1" id="" class="form-check-input" {{ ($student_info['family_info']->parentsLivingTogether) ? 'checked' : ''}}>
                                    Parents living together
                                </label>
                            </div>
                            <div class="form-check mx-auto">
                                <label class="form-check-label">
                                    <input type="radio" name="parentsLivingTogether" value="0" id="" class="form-check-input" {{ !($student_info['family_info']->parentsLivingTogether) ? 'checked' : ''}}>
                                    Parents separated
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>No. of person living at home:</label>
                        <div class="form-row">
                            <div class="col-3">
                                <label class="text-center">Members of family
                                    <input type="number" min="0" name="numberMembersFamily" class="form-control" value="{{ $student_info['family_info']->numberMembersFamily }}">
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="text-center">Children
                                    <input type="number" min="0" name="numberChildren" class="form-control" value="{{ $student_info['family_info']->numberChildren }}">
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="text-center">Relatives
                                    <input type="number" min="0" name="numberRelatives" class="form-control" value="{{ $student_info['family_info']->numberRelatives }}">
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="text-center">House helpers
                                    <input type="number" min="0" name="numberHouseHelpers" class="form-control" value="{{ $student_info['family_info']->numberHouseHelpers }}">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-7">
                                <label>Guardian, if not living with parents</label>
                                <input type="text" name="guardianName" id="" class="form-control" value="{{ $student_info['family_info']->guardianName }}">
                            </div>
                            <div class="col-5">
                                <label for="">Relation</label>
                                <input type="text" name="guardianRelation" class="form-control" value="{{ $student_info['family_info']->guardianRelation }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Language or Dialects spoken at home</label>
                        <input type="text" class="form-control" name="languagesSpokenAtHome" value="{{ $student_info['family_info']->languagesSpokenAtHome }}">
                    </div>
                </div>

                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#page1">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#page1">1</a></li>
                            <li class="page-item"><a class="page-link" href="#page2" onclick="showPage(2)">2</a></li>
                            <li class="page-item"><a class="page-link" href="#page3" onclick="showPage(3)">3</a></li>
                            <li class="page-item"><a class="page-link" href="#page4" onclick="showPage(4)">4</a></li>
                            <li class="page-item"><a class="page-link" href="#page2" onclick="showPage(2)">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="row d-none" id="page2">
                <!-- List all the children in your family -->
                <div class="col-12">
                    <p>
                        List all the children in your family. (If married, list your own children.)
                    </p>
                    <div class="form-row" id="listChildrenFamily">
                        <div class="col-12">
                            <div class="form-row text-center">
                                <div class="d-none d-md-block col-md-3 form-group">
                                    <label>Name</label>
                                </div>
                                <div class="d-none d-md-block col-md-1 form-group">
                                    <label>Gender</label>
                                </div>
                                <div class="d-none d-md-block col-md-1 form-group">
                                    <label>Age</label>
                                </div>
                                <div class="d-none d-md-block col-md-1 form-group">
                                    <label>Civil Status</label>
                                </div>
                                <div class="d-none d-md-block col-md-3 form-group">
                                    <label>School/Occupation</label>
                                </div>
                                <div class="d-none d-md-block col-md-3  form-group">
                                    <label>Grade or Year or Company or Firm</label>
                                </div>
                            </div>
                        </div>
                        @if($student_info['family_children']->count() == 0)
                            <div class="col-12" id="individualChild">
                                <div class="form-row">
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Name</label>
                                        <input type="text" name="childrenName[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-1 col-sm-4 form-group">
                                        <label for="" class="d-block d-md-none">Gender</label>
                                        <select name="childrenGender[]" id="" class="form-control form-control-sm">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Lesbian">Lesbian</option>
                                            <option value="Gay">Gay</option>
                                            <option value="Bisexual">Bisexual</option>
                                            <option value="Transgender">Transgender</option>
                                            <option value="Other">Others</option>
                                            <option value="N/A">Prefer not to say</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 col-sm-4 form-group">
                                        <label for="" class="d-block d-md-none">Age</label>
                                        <input type="number" name="childrenAge[]" class="form-control form-control-sm" min="0" value="0">
                                    </div>
                                    <div class="col-md-1 col-sm-4 form-group">
                                        <label for="" class="d-block d-md-none">Civil Status</label>
                                        <select name="childrenCivilStatus[]" id="" class="form-control form-control-sm">
                                            <option value="1">Single</option>
                                            <option value="2">Married</option>
                                            <option value="0">Separated</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">School/Occupation</label>
                                        <input type="text" name="childrenSchoolOccupation[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Grade or Year or Company or Firm</label>
                                        <input type="text" name="childrenGradeYearCompanyFirm[]" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>


                        @endif
                        @foreach($student_info['family_children'] as $children)
                            <div class="col-12" id="individualChild">
                                <div class="form-row">
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Name</label>
                                        <input type="text" name="childrenName[]" class="form-control form-control-sm" value="{{ $children->childrenName }}">
                                    </div>
                                    <div class="col-md-1 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Gender</label>
                                        <select name="childrenGender[]" id="" class="form-control form-control-sm">
                                            <option value="Male" {{ ($children->childrenGender == 'Male') ? 'selected="selected"' : '' }}>Male</option>
                                            <option value="Female" {{ ($children->childrenGender == 'Female') ? 'selected="selected"' : '' }}>Female</option>
                                            <option value="Lesbian" {{ ($children->childrenGender == 'Lesbian') ? 'selected="selected"' : '' }}>Lesbian</option>
                                            <option value="Gay" {{ ($children->childrenGender == 'Gay') ? 'selected="selected"' : '' }}>Gay</option>
                                            <option value="Bisexual" {{ ($children->childrenGender == 'Bisexual') ? 'selected="selected"' : '' }}>Bisexual</option>
                                            <option value="Transgender" {{ ($children->childrenGender == 'Transgender') ? 'selected="selected"' : '' }}>Transgender</option>
                                            <option value="Other" {{ ($children->childrenGender == 'Other') ? 'selected="selected"' : '' }}>Others</option>
                                            <option value="N/A" {{ ($children->childrenGender == 'N/A') ? 'selected="selected"' : '' }}>Prefer not to say</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1 col-sm-12 form-group">
                                            <label for="" class="d-block d-md-none">Age</label>
                                        <input type="number" name="childrenAge[]" class="form-control form-control-sm" min="0" value="{{ $children->childrenAge }}">
                                    </div>
                                    <div class="col-md-1 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Civil Status</label>
                                        <select name="childrenCivilStatus[]" id="" class="form-control form-control-sm">
                                            <option value="1" {{ ($children->childrenCivilStatus == 1) ? 'selected="selected"' : '' }}>Single</option>
                                            <option value="2" {{ ($children->childrenCivilStatus == 2) ? 'selected="selected"' : '' }}>Married</option>
                                            <option value="0" {{ ($children->childrenCivilStatus == 0) ? 'selected="selected"' : '' }}>Separated</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">School/Occupation</label>
                                        <input type="text" name="childrenSchoolOccupation[]" class="form-control form-control-sm" value="{{ $children->childrenSchoolOccupation }}">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Grade or Year or Company or Firm</label>
                                        <input type="text" name="childrenGradeYearCompanyFirm[]" class="form-control form-control-sm" value="{{ $children->childrenGradeYearCompanyFirm }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="addChildEntry">Add another field</button>
                    </div>
                </div>

                <!-- Educational Background -->
                <div class="col-12">
                    <h5 class="text-center text-uppercase font-weight-bolder">Educational Background</h5>
                </div>
                <div class="col-12">
                    <!-- School attended -->
                    <div class="form-row" id="schoolsAttended">
                        <div class="col-12">
                            <p>
                                Name the schools you have ever attended. (Including grade school, high school, and other colleges)
                            </p>
                        </div>
                        <div class="col-12 text-center">
                            <div class="form-row">
                                <div class="d-none d-md-block col-md-3">
                                    <label for="">School</label>
                                </div>
                                <div class="d-none d-md-block col-md-3">
                                    <label for="">Date of Attendance</label>
                                </div>
                                <div class="d-none d-md-block col-md-3">
                                    <label for="">Grade/Year Level</label>
                                </div>
                                <div class="d-none d-md-block col-md-3">
                                    <label for="">Honors/Awards Received</label>
                                </div>
                            </div>
                        </div>
                        @if($student_info['schools_attended']->count() == 0)
                            <div class="col-12" id="schoolEntry">
                                <div class="form-row">
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">School</label>
                                        <input type="text" name="schoolName[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Date of Attendance</label>
                                        <input type="text" name="schoolDateAttendance[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Grade/Year Level</label>
                                        <input type="text" name="schoolGradeYearLevel[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Honors/Awards Received</label>
                                        <input type="text" name="schoolHonorsReceived[]" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        @endif
                        @foreach($student_info['schools_attended'] as $sch)
                            <div class="col-12" id="schoolEntry">
                                <div class="form-row">
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">School</label>
                                        <input type="text" name="schoolName[]" class="form-control form-control-sm" value="{{ $sch->schoolName }}">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Date of Attendance</label>
                                        <input type="text" name="schoolDateAttendance[]" class="form-control form-control-sm" value="{{ $sch->schoolDateAttendance }}">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Grade/Year Level</label>
                                        <input type="text" name="schoolGradeYearLevel[]" class="form-control form-control-sm" value="{{ $sch->schoolGradeYearLevel }}">
                                    </div>
                                    <div class="col-md-3 col-sm-12 form-group">
                                        <label for="" class="d-block d-md-none">Honors/Awards Received</label>
                                        <input type="text" name="schoolHonorsReceived[]" class="form-control form-control-sm" value="{{ $sch->schoolHonorsReceived }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="addSchoolEntry">Add another field</button>
                    </div>
                    
                    <!-- Subjects liked/disliked -->
                    <div class="form-row">
                        <div class="col-md-6 col-sm-12 form-row" id="subjectsLiked">
                            <div class="col-12 text-center">
                                <label for="">H.S. Subjects Liked & Grade</label>
                            </div>
                            @if($student_info['subjects']->where('isSubjectLiked', true)->count() == 0)
                                <div class="col-12 form-row mt-2" id="singleSubjectLiked">
                                    <div class="col-8">
                                        <input type="text" name="subjectLiked[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" name="subjectLikedGrade[]" id="" class="form-control form-control-sm" value="0">
                                    </div>
                                </div>
                            @endif
                            @foreach($student_info['subjects']->where('isSubjectLiked', true) as $sub)
                                <div class="col-12 form-row mt-2" id="singleSubjectLiked">
                                    <div class="col-8">
                                        <input type="text" name="subjectLiked[]" class="form-control form-control-sm" value="{{ $sub->name }}">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" name="subjectLikedGrade[]" id="" class="form-control form-control-sm" value="{{ $sub->grade }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-6 col-sm-12 form-row" id="subjectsDisliked">
                            <div class="col-12 text-center">
                                <label for="">Subjects Disliked & Grade</label>
                            </div>
                            @if($student_info['subjects']->where('isSubjectLiked', false)->count() == 0)
                                <div class="col-12 form-row mt-2" id="singleSubjectDisliked">
                                    <div class="col-8">
                                        <input type="text" name="subjectDisliked[]" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" name="subjectDislikedGrade[]" id="" class="form-control form-control-sm" value="0">
                                    </div>
                                </div>
                            @endif
                            @foreach($student_info['subjects']->where('isSubjectLiked', false) as $sub)
                                <div class="col-12 form-row mt-2" id="singleSubjectDisliked">
                                    <div class="col-8">
                                        <input type="text" name="subjectDisliked[]" class="form-control form-control-sm" value="{{ $sub->name }}">
                                    </div>
                                    <div class="col-4">
                                        <input type="number" name="subjectDislikedGrade[]" id="" class="form-control form-control-sm" value="{{ $sub->grade }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-outline-primary btn-sm" id="addSubjectLiked">Add subject liked</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" id="addSubjectDisliked">Add subject disliked</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Other educational info -->
                <div class="col-12 mt-4">
                    <!-- High school info -->
                    <div class="form-row">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label for="">Approximate high school average</label>
                                <input type="text" name="highSchoolAverage" class="form-control" pattern="^\d*(\.\d{0,2})?$" value="{{ $student_info['educational_background']->highSchoolAverage }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="">Honors received in High School</label>
                                <input type="text" name="highSchoolHonorsReceived" class="form-control" value="{{ $student_info['educational_background']->highSchoolHonorsReceived }}">
                            </div>
                        </div>
                    </div>
                    <!-- Previous course -->
                    <div class="form-row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Other course previously enrolled in</label>
                                <input type="text" name="previousCourse" class="form-control" value="{{ $student_info['educational_background']->previousCourse }}">
                            </div>
                            <div class="form-group">
                                <label for="">Reason for shifting/transferring</label>
                                <textarea name="previousCourseShiftReason" id=""  cols="30" rows="3" class="form-control">{{ $student_info['educational_background']->previousCourseShiftReason }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Present Educational and Vocational Plans</label>
                                <textarea name="presentEducVocaPlans" id="" cols="30" rows="3" class="form-control">{{ $student_info['educational_background']->presentEducVocaPlans }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Current school -->
                    <div class="form-row">
                        <div class="col-12">
                            <label for="">What made you choose this school?</label>
                            <div class="form-row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="chooseSchool_familySuggestion" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->chooseSchool_familySuggestion) ? 'checked' : '' }}>
                                                family suggestion
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="chooseSchool_familyTradition" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->chooseSchool_familyTradition) ? 'checked' : '' }}>
                                                family tradition
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="chooseSchool_personalChoice" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->chooseSchool_personalChoice) ? 'checked' : '' }}>
                                                personal choice
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="chooseSchool_friendChoice" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->chooseSchool_friendChoice) ? 'checked' : '' }}>
                                                friend's choice
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="chooseSchool_teacherChoice" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->chooseSchool_teacherChoice) ? 'checked' : '' }}>
                                                teacher's choice
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="chooseSchool_followingIAdmired" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->chooseSchool_followingIAdmired) ? 'checked' : '' }}>
                                                following vocation of someone I admire
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-check-label">
                                                Others (please specify)
                                            </label>
                                            <input type="text" name="chooseSchool_otherReasonChoseSchool" class="form-control form-control-sm" value="{{ $student_info['educational_background']->chooseSchool_otherReasonChoseSchool }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">If choice is not your own, what course would you rather take up?</label>
                                <input type="text" name="coursePreferredToTakeInstead" class="form-control" value="{{ $student_info['educational_background']->coursePreferredToTakeInstead }}">
                            </div>
                            <div class="form-group">
                                <label for="">How did you come to this school?</label>
                                <div class="form-row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="howComeSchool_personalChoice" id="" class="form-check-input" value="1"  {{ ($student_info['educational_background']->howComeSchool_personalChoice) ? 'checked' : '' }}>
                                                    personal choice
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="howComeSchool_parentChoice" id="" class="form-check-input" value="1"  {{ ($student_info['educational_background']->howComeSchool_parentChoice) ? 'checked' : '' }}>
                                                    parent's choice
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="howComeSchool_friendRecommendation" id="" class="form-check-input" value="1"  {{ ($student_info['educational_background']->howComeSchool_friendRecommendation) ? 'checked' : '' }}>
                                                    friend's recommendation
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="howComeSchool_others" id="" class="form-check-input" value="1"  {{ ($student_info['educational_background']->howComeSchool_othersSpecified) ? 'checked' : '' }}>
                                                    Others (please specify)
                                                </label>
                                                <input type="text" name="howComeSchool_othersSpecified" class="form-control" value="{{ $student_info['educational_background']->howComeSchool_othersSpecified }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 form-row">
                            <label for="">How much information do you have about the requirements of the course you are taking up?</label>
                            <div class="col-12 text-center mb-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="course_knowledge_taking_up" id="cktu_very_much" value="5" {{ ($student_info['educational_background']->course_knowledge_taking_up == 5) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cktu_very_much">
                                        very much
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="course_knowledge_taking_up" id="cktu_much" value="4" {{ ($student_info['educational_background']->course_knowledge_taking_up == 4) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cktu_much">
                                        much
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="course_knowledge_taking_up" id="cktu_enough" value="3" {{ ($student_info['educational_background']->course_knowledge_taking_up == 3) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cktu_enough">
                                        enough
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="course_knowledge_taking_up" id="cktu_very_little" value="2" {{ ($student_info['educational_background']->course_knowledge_taking_up == 2) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cktu_very_little">
                                        very little
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="course_knowledge_taking_up" id="cktu_none" value="1" {{ ($student_info['educational_background']->course_knowledge_taking_up == 1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cktu_none">
                                        none
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#page1" onclick="showPage(1)">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#page1" onclick="showPage(1)">1</a></li>
                            <li class="page-item active"><a class="page-link" href="#page2">2</a></li>
                            <li class="page-item"><a class="page-link" href="#page3" onclick="showPage(3)">3</a></li>
                            <li class="page-item"><a class="page-link" href="#page4" onclick="showPage(4)">4</a></li>
                            <li class="page-item"><a class="page-link" href="#page3" onclick="showPage(3)">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="row d-none" id="page3">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Where did you get this information? (Specify)</label>
                        <input type="text" name="course_knowledge_whereGetInfo" class="form-control" value="{{ $student_info['educational_background']->course_knowledge_whereGetInfo }}">
                    </div>
                    <div class="form-group">
                        <label for="">Source of financial support in college</label>
                        <div class="form-row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="financialAid_family" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->financialAid_family) ? 'checked' : '' }}>
                                            family
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="financialAid_savings" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->financialAid_savings) ? 'checked' : '' }}>
                                            savings
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="financialAid_partTime" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->financialAid_partTime) ? 'checked' : '' }}>
                                            part-time work
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="financialAid_governmentAid" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->financialAid_governmentAid) ? 'checked' : '' }}>
                                            government aid
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="financialAid_scholar" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->financialAid_scholar) ? 'checked' : '' }}>
                                            scholarship
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="financialAid_others" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->financialAid_othersSpecified) ? 'checked' : '' }}>
                                            Others (please specify)
                                        </label>
                                        <input type="text" name="financialAid_othersSpecified" class="form-control" value="{{ $student_info['educational_background']->financialAid_othersSpecified }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Self-evaluation regarding scholastic standing. Check the following which apply to you.</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="selfEval_barely" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->selfEval_barely) ? 'checked' : '' }}>
                                I barely passed most of my subjects.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="selfEval_failedMost" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->selfEval_failedMost) ? 'checked' : '' }}>
                                I failed most of my subjects.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="selfEval_hardTimePassing" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->selfEval_hardTimePassing) ? 'checked' : '' }}>
                                I am having a hard time passing my subjects.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="selfEval_difficultySomeSubjects" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->selfEval_difficultySomeSubjects) ? 'checked' : '' }}>
                                I have difficulty with some of my subjects.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="selfEval_fearFailSem" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->selfEval_fearFailSem) ? 'checked' : '' }}>
                                I fear I am going to fail this semester.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="selfEval_confidentFinishCourse" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->selfEval_confidentFinishCourse) ? 'checked' : '' }}>
                                I am confident I can finish my course.
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="selfEval_stillAdjusting" id="" class="form-check-input" value="1" {{ ($student_info['educational_background']->selfEval_stillAdjusting) ? 'checked' : '' }}>
                                I am still adjusting to my studies.
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Other remarks</label>
                        <input type="text" class="form-control" name="selfEval_remarks" value="{{ $student_info['educational_background']->selfEval_remarks }}">
                    </div>
                </div>

                <!-- Health records and living conditions -->
                <div class="col-12">
                    <h5 class="text-center text-uppercase font-weight-bolder">Health record and living conditions</h5>
                </div>
                <div class="col-12">
                    <!-- TODO: Ask maam about how to input these data -->
                    <div class="form-group">
                        <label for="">Indicate as required: Physical Profile and Identification marks</label>
                        <div class="form-row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label class="">Height</label>
                                    <div class="input-group" id="height_input_m">
                                        <input type="text" name="physical_height_m" id="physical_height_m" class="form-control" value="{{ $student_info['health_living']->physical_height }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">m</span>
                                        </div>
                                    </div>
                                    <div class="input-group d-none" id="height_input_ft_in">
                                        <input type="text" name="physical_height_ft" id="physical_height_ft" class="form-control" placeholder="ft">
                                        <input type="text" name="physical_height_in" id="physical_height_in" class="form-control" placeholder="in">
                                        <div class="input-group-append">
                                            <span class="input-group-text">feet, inch</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="height_measurement" id="meters_selected" value="m" class="form-check-input" checked>
                                                Meters
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="height_measurement" id="feet_inches_selected" value="ft_in" class="form-check-input">
                                                Feet and inches
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="">Complexion</label>
                                    <input type="text" name="physical_complexion" id="" class="form-control" value="{{ $student_info['health_living']->physical_complexion }}">
                                </div>
                                <div class="form-group">
                                    <label class="">Weight</label>
                                    <div class="input-group" id="weight_input_kg">
                                        <input type="text" name="physical_weight_kg" id="physical_weight_kg" class="form-control" value="{{ $student_info['health_living']->physical_weight }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                    <div class="input-group d-none" id="weight_input_lb">
                                        <input type="text" name="physical_weight_lb" id="physical_weight_lb" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">lb</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="weight_measurement" id="kg_selected" value="kg" class="form-check-input" checked>
                                                Kilograms
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" name="weight_measurement" id="lb_selected" value="lb" class="form-check-input">
                                                Pounds
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="">Mole</label>
                                    <input type="text" name="physical_mole" id="" class="form-control" value="{{ $student_info['health_living']->physical_mole }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-check">
                                    <div class="form-group">
                                        <label class="form-check-label">
                                            Others
                                        </label>
                                        <input type="text" name="physical_Others" id="" class="form-control" value="{{ $student_info['health_living']->physical_Others }}">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="physical_wearGlasses" id="" class="form-check-input" {{ ($student_info['health_living']->physical_wearGlasses) ? 'checked' : '' }}>
                                            wearing glasses
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Physical Programs Participated</label>
                        <div class="form-row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="physicalPrograms_aerobic" id="" class="form-check-input" value="1" {{ ($student_info['health_living']->physicalPrograms_aerobic) ? 'checked' : '' }}>
                                        aerobic fitness
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="physicalPrograms_stretchSwim" id="" class="form-check-input" value="1" {{ ($student_info['health_living']->physicalPrograms_stretchSwim) ? 'checked' : '' }}>
                                        stretching/swimming
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="physicalPrograms_weightLiftBodyBuild" id="" class="form-check-input" value="1" {{ ($student_info['health_living']->physicalPrograms_weightLiftBodyBuild) ? 'checked' : '' }}>
                                        weightlifting/body building
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="physicalPrograms_dancingGymnastics" id="" class="form-check-input" value="1" {{ ($student_info['health_living']->physicalPrograms_dancingGymnastics) ? 'checked' : '' }}>
                                        dancing/gymnastics
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="physicalPrograms_gamesSports" id="" class="form-check-input" value="1" {{ ($student_info['health_living']->physicalPrograms_gamesSports) ? 'checked' : '' }}>
                                        games/sports
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="">
                                        others
                                    </label>
                                    <input type="text" name="physicalPrograms_others" id="" class="form-control form-control-sm" value="{{$student_info['health_living']->physicalPrograms_others}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Suffering from physical ailment</label>
                        <div class="form-row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="sufferingPhysicalAilment_allergy" id="" class="form-check-input" value="1" {{ ($student_info['health_living']->sufferingPhysicalAilment_allergy) ? 'checked' : '' }}>
                                        Allergies
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="sufferingPhysicalAilment_asthma" id="" class="form-check-input" value="1" {{ ($student_info['health_living']->sufferingPhysicalAilment_asthma) ? 'checked' : '' }}>
                                        Asthma
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="sufferingPhysicalAilment_migraneDizziness" id="" class="form-check-input" value="1" {{ ($student_info['health_living']->sufferingPhysicalAilment_migraneDizziness) ? 'checked' : '' }}>
                                        Migraine/Diziness
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="sufferingPhysicalAilment_stomachache" id="" class="form-check-input" value="1" {{ ($student_info['health_living']->sufferingPhysicalAilment_stomachache) ? 'checked' : '' }}>
                                        Stomachache
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        Others
                                    </label>
                                    <input type="text" name="sufferingPhysicalAilment_others" id="" class="form-control" value="{{$student_info['health_living']->sufferingPhysicalAilment_others }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <label for="">Physician handling</label>
                                    <input type="text" name="physicianHandling" class="form-control form-control-sm" value="{{ $student_info['health_living']->physicianHandling }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Where do you live?</label>
                        <div class="form-row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="whereYouLived" value="0" id="" class="form-check-input" {{ ($student_info['health_living']->whereYouLived == 0) ? 'checked' : '' }}>
                                        Home
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="whereYouLived" value="1" id="" class="form-check-input" {{ ($student_info['health_living']->whereYouLived == 1) ? 'checked' : '' }}>
                                        Renting a room
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="whereYouLived" value="2" id="" class="form-check-input" {{ ($student_info['health_living']->whereYouLived == 2) ? 'checked' : '' }}>
                                        Boarding House
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="whereYouLived" value="3" id="" class="form-check-input" {{ ($student_info['health_living']->whereYouLived == 3) ? 'checked' : '' }}>
                                        Living with relatives
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="whereYouLived" value="4" id="" class="form-check-input" {{ ($student_info['health_living']->whereYouLived == 4) ? 'checked' : '' }}>
                                        Others
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">How many are you in your present place now?</label>
                        <input type="number" min="0" name="howManyPresentPlace" class="form-control form-control-sm" value="{{ $student_info['health_living']->howManyPresentPlace }}">
                    </div>
                    <div class="form-group">
                        <label for="">How many persons share the room with you?</label>
                        <input type="number" min="0" name="howManyShareRoom" class="form-control form-control-sm" value="{{ $student_info['health_living']->howManyShareRoom }}">
                    </div>
                </div>

                <!-- Leisure time activities -->
                <div class="col-12">
                    <h5 class="text-center text-uppercase font-weight-bolder">Leisure time activities</h5>
                </div>
                <div class="col-12">
                    <p>List any social, religious, economic, educational activities</p>

                    <div class="form-group">
                        <label for="">Membership on Organization</label>
                        <div class="form-row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">On-Campus</label>
                                    <input type="text" name="membershipOnCampus"class="form-control" value="{{ $student_info['leisure']->membershipOnCampus }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="">Off-Campus</label>
                                    <input type="text" name="membershipOffCampus" class="form-control" value="{{ $student_info['leisure']->membershipOffCampus }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="">Awards received</label>
                                <textarea name="leisureAwardsReceived" id="" cols="30" rows="3" class="form-control">{{ $student_info['leisure']->leisureAwardsReceived }}</textarea>
                            </div>
                            <div class="col-12">
                                <label for="">Organizations</label>
                                <input type="text" name="leisureOrg" class="form-control" value="{{ $student_info['leisure']->leisureOrg }}">
                            </div>
                            <div class="col-12">
                                <label for="">Hobbies & Interests</label>
                                <input type="text" name="leisureHobbiesInterests" class="form-control" value="{{ $student_info['leisure']->leisureHobbiesInterests }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#page2" onclick="showPage(2)">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#page1" onclick="showPage(1)">1</a></li>
                            <li class="page-item"><a class="page-link" href="#page2" onclick="showPage(2)">2</a></li>
                            <li class="page-item active"><a class="page-link" href="#page3">3</a></li>
                            <li class="page-item"><a class="page-link" href="#page4" onclick="showPage(4)">4</a></li>
                            <li class="page-item"><a class="page-link" href="#page4" onclick="showPage(4)">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="row d-none" id="page4">
                <div class="col-12">
                    <h5 class="text-center text-uppercase font-weight-bolder">
                        General Personality Make-Up
                    </h5>
                </div>

                <div class="col-12">
                    <p>
                        Check one or more of the following words which you feel describe your personality make-up.
                    </p>
                    <div class="form-row">
                        <div class="form-group col-md-3 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_friendly"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_friendly) ? 'checked' : '' }}>
                                    friendly
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_reserved"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_reserved) ? 'checked' : '' }}>
                                    reserved
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_stubborn"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_stubborn) ? 'checked' : '' }}>
                                    stubborn
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_capable"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_capable) ? 'checked' : '' }}>
                                    capable
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_tolerant"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_tolerant) ? 'checked' : '' }}>
                                    tolerant
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_calm"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_calm) ? 'checked' : '' }}>
                                    calm
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_anxious"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_anxious) ? 'checked' : '' }}>
                                    anxious
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_depressed"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_depressed) ? 'checked' : '' }}>
                                    depressed
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_nervous"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_nervous) ? 'checked' : '' }}>
                                    nervous
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_easily_exhausted"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_easily_exhausted) ? 'checked' : '' }}>
                                    easily exhausted
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_quiet"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_quiet) ? 'checked' : '' }}>
                                    quiet
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_unhappy"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_unhappy) ? 'checked' : '' }}>
                                    unhappy
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_pessimistic"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_pessimistic) ? 'checked' : '' }}>
                                    pessimistic
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_shy"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_shy) ? 'checked' : '' }}>
                                    shy
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_selfConfident"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_selfConfident) ? 'checked' : '' }}>
                                    self-confident
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_jealous"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_jealous) ? 'checked' : '' }}>
                                    jealous
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_talented"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_talented) ? 'checked' : '' }}>
                                    talented
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_quickTempered"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_quickTempered) ? 'checked' : '' }}>
                                    quick-tempered
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_cynical"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_cynical) ? 'checked' : '' }}>
                                    cynical
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_tactful"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_tactful) ? 'checked' : '' }}>
                                    tactful
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_conscientious"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_conscientious) ? 'checked' : '' }}>
                                    conscientious
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_talkative"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_talkative) ? 'checked' : '' }}>
                                    talkative
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-3 col-sm-12">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_cheerful"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_cheerful) ? 'checked' : '' }}>
                                    cheerful
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_lazy"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_lazy) ? 'checked' : '' }}>
                                    lazy
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_submissive"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_submissive) ? 'checked' : '' }}>
                                    submissive
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_excited"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_excited) ? 'checked' : '' }}>
                                    excited
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_irritable"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_irritable) ? 'checked' : '' }}>
                                    irritable
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_poorHealth"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_poorHealth) ? 'checked' : '' }}>
                                    poor health
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_frequentDaydreaming"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_frequentDaydreaming) ? 'checked' : '' }}>
                                    frequent daydreaming
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_sarcastic"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_sarcastic) ? 'checked' : '' }}>
                                    sarcastic
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_lovable"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_lovable) ? 'checked' : '' }}>
                                    lovable
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        name="personality_aloof"
                                        class="form-check-input"
                                        value="1"
                                    {{ ($student_info['personality']->personality_aloof) ? 'checked' : '' }}>
                                    aloof
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="personalityOthers">Others</label>
                                <input type="text" class="form-control" name="personalityOthers" id="personalityOthers" value="{{ $student_info['personality']->personalityOthers }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Significant Events in Your Life: Explain briefly.</label>
                        <textarea name="significantEventsInLife" id="" cols="30" rows="4" class="form-control">{{ $student_info['misc']->significantEventsInLife }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">What things have you caused you most humiliation or sense of failure?</label>
                        <input type="text" name="humiliationSenseOfFailure" class="form-control" value="{{ $student_info['misc']->humiliationSenseOfFailure }}">
                    </div>
                    <div class="form-group-inline">
                        <label for="">Have you had any counseling previously?</label>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" name="previous_counseling" value="1" id="" class="form-check-input" {{ ($student_info['misc']->previousCounseling) ? 'checked' : ''}}>
                                Yes
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" name="previous_counseling" value="0" id="" class="form-check-input" {{ ($student_info['misc']->previousCounseling) ? 'checked' : ''}}>
                                No
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6 col-sm-12">
                                <label for="">When?</label>
                                <input type="text" name="whenPreviousCounseling" class="form-control" value="{{ $student_info['misc']->whenPreviousCounseling }}">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <label for="">With whom?</label>
                                <input type="text" name="whoPreviousCounseling" class="form-control" value="{{ $student_info['misc']->whoPreviousCounseling }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Briefly write what seems to be your particular problem in life?</label>
                        <textarea name="problemInLife" id="" cols="30" rows="2" class="form-control">{{ $student_info['misc']->problemInLife }}</textarea>
                    </div>

                    <div class="form-group">
                        <p>List three names of person connected in this university or community, who know you personally.</p>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-row text-center">
                                    <div class="d-none d-md-block col-md-4">
                                        Name
                                    </div>
                                    <div class="d-none d-md-block col-md-4">
                                        Occupation
                                    </div>
                                    <div class="d-none d-md-block col-md-4">
                                        Address
                                    </div>
                                </div>
                            </div>
                            @foreach($student_info['connection_uni'] as $conn)
                                <div class="col-12 mt-2">
                                    <div class="form-row text-center mt-2">
                                        <div class="col-md-4 col-sm-12 mt-2">
                                            <label for="" class="d-md-none">Name</label>
                                            <input type="text" name="personConnectedName[]" class="form-control" value="{{ $conn->personConnectedName }}">
                                        </div>
                                        <div class="col-md-4 col-sm-12 mt-2">
                                            <label for="" class="d-md-none">Occupation</label>
                                            <input type="text" name="personConnectedOccupation[]" class="form-control" value="{{ $conn->personConnectedOccupation }}">
                                        </div>
                                        <div class="col-md-4 col-sm-12 mt-2">
                                            <label for="" class="d-md-none">Address</label>
                                            <input type="text" name="personConnectedAddress[]" class="form-control" value="{{ $conn->personConnectedAddress }}">                               
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if($student_info['connection_uni']->count() < 3)
                                @for($x = 3 - $student_info['connection_uni']->count(); $x != 0; $x--)
                                    <div class="col-12 mt-2">
                                        <div class="form-row text-center mt-2">
                                            <div class="col-md-4 col-sm-12 mt-2">
                                                <label for="" class="d-md-none">Name</label>
                                                <input type="text" name="personConnectedName[]" class="form-control">
                                            </div>
                                            <div class="col-md-4 col-sm-12 mt-2">
                                                <label for="" class="d-md-none">Occupation</label>
                                                <input type="text" name="personConnectedOccupation[]" class="form-control">
                                            </div>
                                            <div class="col-md-4 col-sm-12 mt-2">
                                                <label for="" class="d-md-none">Address</label>
                                                <input type="text" name="personConnectedAddress[]" class="form-control" >                               
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <h5 class="text-center text-uppercase text-underline font-weight-bolder">
                            Guidance and counseling assistance
                        </h5>
                        <p>What help do you want to obtain from the Guidance and Counseling Center?</p>
                        <textarea name="helpQuery" id="" cols="30" rows="4" class="form-control" value="{{ $student_info['family_info']->fatherHighestDegreeGrade }}"></textarea>
                    </div> --}}
                </div>

                <div class="col-12 mt-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#page3" onclick="showPage(3)">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#page1" onclick="showPage(1)">1</a></li>
                            <li class="page-item"><a class="page-link" href="#page2" onclick="showPage(2)">2</a></li>
                            <li class="page-item"><a class="page-link" href="#page3" onclick="showPage(3)">3</a></li>
                            <li class="page-item active"><a class="page-link" href="#page4">4</a></li>
                            <li class="page-item disabled"><a class="page-link">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <script>
                function showPage(page){
                    for(x = 1; x <= 4; x++){
                        if($("#page" + x).hasClass('d-none') && page == x){
                            $("#page" + x).removeClass('d-none');
                        }else{
                            if(!$("#page" + x).hasClass('d-none')){
                                $("#page" + x).addClass('d-none');
                            }
                        }
                    }
                }

                //Page 2, list of all children in the family
                $('#addChildEntry').click(function (){
                    $('#individualChild').clone().appendTo('#listChildrenFamily');
                });

                //Page 2, schools attended
                $('#addSchoolEntry').click(function (){
                    $('#schoolEntry').clone().appendTo('#schoolsAttended');
                });

                //Page 2, subjects liked
                $('#addSubjectLiked').click(function (){
                    $('#singleSubjectLiked').clone().appendTo('#subjectsLiked');
                });

                //Page 2, subjects disliked
                $('#addSubjectDisliked').click(function (){
                    $('#singleSubjectDisliked').clone().appendTo('#subjectsDisliked');
                });
            </script>
        </form>
    </div>
@endsection

@section('action')
    <div class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="navbar-item">
                <button class="btn" data-toggle="modal" data-target="#verifyModal">VERIFY</button>
                <span class="d-none d-md-inline-flex">
                    <button type="button" class="btn" id="print_button">PRINT</button>
                </span>
            </div>
        </li>
    </div>
@endsection

@section('modals')
    {{-- Verify modal --}}
    <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true">
        <form action="{{ route('profile.verify', ['id' => $student_info['student']->user_id]) }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="verifyModalLabel">Verify this information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="{{ $student_info['student']->user_id }}">
                        <div class="form-group">
                            <p>Do you find this personal data form adequate?</p>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="verifyForm" id="verifyFormYes" value="1" checked>
                                <label class="form-check-label" for="verifyFormYes">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="verifyForm" id="verifyFormNo" value="0">
                                <label class="form-check-label" for="verifyFormNo">
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-group" id="verifyFormNoReason">
                            <label for="">Reason/Message?</label>
                            <textarea name="message" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    //Disable all forms
    $("#guidanceForm :input").prop("disabled", true);

    //Print
    $('#print_button').click(function (){
        $('#navbar').addClass('d-none');
        $('.pagination').addClass('d-none');
        $('#page1').removeClass('d-none');
        $('#page2').removeClass('d-none');
        $('#page3').removeClass('d-none');
        $('#page4').removeClass('d-none');

        window.print();
        $('#navbar').removeClass('d-none');
        $('.pagination').removeClass('d-none');
        $('#page2').addClass('d-none');
        $('#page3').addClass('d-none');
        $('#page4').addClass('d-none');
    });
</script>
@endsection