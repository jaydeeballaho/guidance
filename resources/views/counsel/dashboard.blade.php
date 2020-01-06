@extends('layouts.app')



@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-sm-12">
            <h5>Search Student</h5>
            <form action="{{ route('profile.search') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" value="{{ $request->input('name') }}" name="name" class="form-control form-control-sm" placeholder="Name">
                </div>
                <div class="form-group">
                    <select name="course" id="" class="form-control form-control-sm">
                        <option value="-1">Select course</option>
                        @foreach($colleges as $college)
                            @if($college->id == auth()->user()->counsel->college_id)
                            <optgroup label="{{$college->name}}">
                                @foreach($college->courses as $course)
                                    <option
                                        @if($course->id == $request->input('course'))
                                            selected="selected"
                                        @endif
                                        value="{{$course->id}}"
                                        >{{$course->name}}
                                    </option>
                                @endforeach
                            </optgroup>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" value="{{ $request->input('address') }}" name="address" class="form-control form-control-sm" placeholder="Address">
                </div>
                <div class="form-group">
                    <label for="genderSearch">Gender</label>
                    <select name="genderSearch" id="genderSearch" class="form-control form-control-sm">
                        <option
                            value="Any"
                            @if($request->input('genderSearch') == "Both")
                                selected="selected"
                            @endif
                            >Both
                        </option>
                        <option value="Male" {{ ($request->input('genderSearch') == "Male") ? 'selected="selected"' : '' }}>Male</option>
                        <option value="Female" {{ ($request->input('genderSearch') == "Female") ? 'selected="selected"' : '' }}>Female</option>
                        <option value="Lesbian" {{ ($request->input('genderSearch') == "Lesbian") ? 'selected="selected"' : '' }}>Lesbian</option>
                        <option value="Gay" {{ ($request->input('genderSearch') == "Gay") ? 'selected="selected"' : '' }}>Gay</option>
                        <option value="Bisexual" {{ ($request->input('genderSearch') == "Bisexual") ? 'selected="selected"' : '' }}>Bisexual</option>
                        <option value="Transgender" {{ ($request->input('genderSearch') == "Transgender") ? 'selected="selected"' : '' }}>Transgender</option>
                        <option value="Other" {{ ($request->input('genderSearch') == "Other") ? 'selected="selected"' : '' }}>Others</option>
                        <option value="N/A" {{ ($request->input('genderSearch') == "N/A") ? 'selected="selected"' : '' }}>Preferred not to say</option>
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <h5>Religion</h5>
                    <select name="religion" id="" class="form-control form-control-sm">
                        <option value="-1">Select religion</option>
                        <option value="Aglipayan">Aglipayan</option>
                        <option value="Association of Fundamental Baptist Churches in the Philippines">Association of Fundamental Baptist Churches in the Philippines</option>
                        <option value="Bible Baptist Church">Bible Baptist Church</option>
                        <option value="Buddhist">Buddhist</option>
                        <option value="Church of Christ">Church of Christ</option>
                        <option value="Convention of the Philippine Baptist Church">Convention of the Philippine Baptist Church</option>
                        <option value="Crusaders of the Divine Church of Christ Inc.">Crusaders of the Divine Church of Christ Inc.</option>
                        <option value="Evangelical Christian Outreach Foundation">Evangelical Christian Outreach Foundation</option>
                        <option value="Evangelicals (PCEC)">Evangelicals (PCEC)</option>
                        <option value="Faith Tabernacle Church (Living Rock Ministries)">Faith Tabernacle Church (Living Rock Ministries)</option>
                        <option value="Iglesia Ni Cristo">Iglesia Ni Cristo</option>
                        <option value="Iglesia sa Dios Espiritu Santo Inc.">Iglesia sa Dios Espiritu Santo Inc.</option>
                        <option value="Igreja Católica Apostólica Brasileira nas Filipinas">Igreja Católica Apostólica Brasileira nas Filipinas</option>
                        <option value="Islam">Islam</option>
                        <option value="Jehovah's Witnesses">Jehovah's Witnesses</option>
                        <option value="Jesus Is Lord Church Worldwide">Jesus Is Lord Church Worldwide</option>
                        <option value="Lutheran Church in the Philippines">Lutheran Church in the Philippines</option>
                        <option value="Philippine Benevolent Missionaries Association">Philippine Benevolent Missionaries Association</option>
                        <option value="Philippine Independent Catholic Church">Philippine Independent Catholic Church</option>
                        <option value="Roman Catholic">Roman Catholic</option>
                        <option value="Seventh-day Adventist">Seventh-day Adventist</option>
                        <option value="The Church of Jesus Christ of Latter-day Saints">The Church of Jesus Christ of Latter-day Saints</option>
                        <option value="United Church of Christ in the Philippines">United Church of Christ in the Philippines</option>
                        <option value="United Pentecostal Church (Philippines) Inc.">United Pentecostal Church (Philippines) Inc.</option>
                        <option value="Unión Espiritista Cristiana de Filipinas, Inc.">Unión Espiritista Cristiana de Filipinas, Inc.</option>
                        <option value="Non-Roman Catholic and Protestant (NCCP)">Non-Roman Catholic and Protestant (NCCP)</option>
                        <option value="Other Protestants">Other Protestants</option>
                        <option value="Tribal Religions">Tribal Religions</option>
                        <option value="Other Baptists">Other Baptists</option>
                        <option value="None">None</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-row">
                    <h5>Source of financial support</h5>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="financialAid_family" id="" class="form-check-input" value="1" {{ ($request->input('financialAid_family')) ? 'checked' : '' }}>
                                    family
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="financialAid_savings" id="" class="form-check-input" value="1" {{ ($request->input('financialAid_savings')) ? 'checked' : '' }}>
                                    savings
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="financialAid_partTime" id="" class="form-check-input" value="1" {{ ($request->input('financialAid_partTime')) ? 'checked' : '' }}>
                                    part-time work
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="financialAid_governmentAid" id="" class="form-check-input" value="1" {{ ($request->input('financialAid_governmentAid')) ? 'checked' : '' }}>
                                    government aid
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="financialAid_scholar" id="" class="form-check-input" value="1" {{ ($request->input('financialAid_scholar')) ? 'checked' : '' }}>
                                    scholarship
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="financialAid_others" id="" class="form-check-input" value="1" {{ ($request->input('financialAid_othersSpecified')) ? 'checked' : '' }}>
                                    Others
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Personal Data Form Verification</label>
                    <div class="form-check">
                        <input class="form-check-input" name="pdfVerification" type="radio" value="1" id="pdfVerified" {{ ($request->input('pdfVerification') == 1) ? 'checked' : '' }}>
                        <label class="form-check-label" for="pdfVerified">
                            Verified
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="pdfVerification" type="radio" value="0" id="pdfNotVerified" {{ ($request->input('pdfVerification') == 0) ? 'checked' : '' }}>
                        <label class="form-check-label" for="pdfNotVerified">
                            Not verified
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="pdfVerification" type="radio" value="2" id="pdfNotVerifiedForm" {{ ($request->input('pdfVerification') == 2 || is_null($request->pdfVerification)) ? 'checked' : '' }}>
                        <label class="form-check-label" for="pdfNotVerifiedForm">
                            Both
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" id="searchBtn" class="btn btn-primary btn-sm btn-block">Search</button>
                    <button type="reset" class="btn btn-danger btn-sm btn-block">Reset Search</button>
                </div>
            </form>
        </div>
        <div class="col">
            <h3 class="display-4">Student list</h3>
            <div class="table-responsive-sm">
                <table id="student_table" class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Date of Birth</th>
                            <th>Place of Birth</th>
                            <th>City Address</th>
                            <th>Provincial Address</th>
                            <th>Course</th>
                            <th>Civil Status</th>
                            <th>Tel./Cel. no.</th>
                            <th>Religion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="searchResults">
                        @foreach($students as $stud)
                            <tr 
                                @if($stud->infoVerification == 0)
                                    class="table-warning"
                                @elseif($stud->infoVerification == 2)
                                    class="table-danger"
                                @endif
                            >
                                <td>{{ $stud->full_name }}</td>
                                <td>{{ $stud->gender }}</td>
                                <td>{{ $stud->dateOfBirth }}</td>
                                <td>{{ $stud->placeOfBirth }}</td>
                                <td>{{ $stud->cityAddress }}</td>
                                <td>{{ $stud->provincialAddress }}</td>
                                <td>{{ $stud->course->name }}</td>
                                <td>
                                    @switch($stud->civilStatus)
                                        @case(1)
                                            Single
                                            @break
                                        @case(2)
                                            Married
                                            @break
                                        @case (0)
                                            Separated
                                            @break
                                        @default                            
                                    @endswitch
                                </td>
                                <td>{{ $stud->tellCellNo }}</td>
                                <td>{{ $stud->religion }}</td>
                                <td>
                                    <a href="{{ route('profile.view', ['id' => $stud->user_id]) }}" class="btn btn-outline-primary btn-sm">View data form</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        $('#student_table').DataTable();

        function goToStudentProfile($id){
            window.location.href = "/student/" . $id;
        }
    });

</script>


@endsection