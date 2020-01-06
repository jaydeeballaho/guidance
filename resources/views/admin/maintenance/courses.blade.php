@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
                <h2>View Courses</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Students</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->students_count }}</td>
                                <td>
                                    <button 
                                        class="btn btn-primary"
                                        data-toggle="modal"
                                        data-target="#editCourseModal"
                                        data-coursename="{{ $course->name }}"
                                        data-courseid="{{ $course->id }}">
                                        Edit
                                    </button>

                                    <button
                                        class="btn btn-danger"
                                        data-crid="{{ $course->id }}"
                                        data-toggle="modal"
                                        data-target="#deleteCourseModal">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCourseModal">Add new course</button>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="{{ route('maintenance.colleges') }}" class="nav-link active">Colleges</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('maintenance.accounts') }}">User Accounts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('maintenance.config') }}">Configuration</a>
                    </li>
                </ul>
            </div>          
        </div>
    </div>
@endsection

@section('modals')
    {{-- Add college modal --}}
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <form action="{{ route('maintenance.course.add') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCourseModalLabel">Add new course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Course name</label>
                            <input type="hidden" name="college_id" value="{{ $college->id }}">
                            <input type="text" class="form-control" name="course_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Add course</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Edit course modal --}}
    <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true">
        <form action="{{ route('maintenance.course.update') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCourseModalLabel">Edit course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Course name</label>
                            <input type="hidden" name="course_id" id="course_id">
                            <input type="text" class="form-control" name="course_name" id="course_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Delete course modal --}}
    <div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
        <form action="{{ route('maintenance.course.delete') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCourseModalLabel">Delete account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="crs_id" id="del_crs_id">
                        <p>Are you sure to delete this course? However, any data that uses this course will NOT be deleted.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger btn-block">Delete Course</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $("#editCourseModal").on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('courseid')
                var name = button.data('coursename')

                var modal = $(this)
                modal.find('#course_id').val(id)
                modal.find('#course_name').val(name)
            }
        );

        $("#deleteCourseModal").on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var crs_id = button.data('crid')

                var modal = $(this)
                modal.find('#del_crs_id').val(crs_id)
            }
        );
    </script>
@endsection