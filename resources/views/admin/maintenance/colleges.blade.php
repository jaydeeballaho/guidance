@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
                <h2>View Colleges</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Courses</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($colleges as $college)
                            <tr>
                                <td>
                                    {{ $college->name }}
                                </td>
                                <td>{{ $college->courses_count }}</td>
                                <td>
                                    <a href="{{ route('maintenance.courses', ['id' => $college->id]) }}" class="btn btn-primary">View courses</a>
                                </td>
                                <td>
                                    <button
                                        class="btn btn-sm btn-primary"
                                        data-collegename="{{ $college->name }}"
                                        data-collegeid="{{ $college->id }}"
                                        data-toggle="modal"
                                        data-target="#editCollegeModal"
                                        >Edit
                                    </button>
                                    <button
                                        class="btn btn-sm btn-danger"
                                        data-clid="{{ $college->id }}"
                                        data-toggle="modal"
                                        data-target="#deleteCollegeModal">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCollegeModal">Add new college</button>
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
                        <a class="nav-link" href="{{ route('maintenance.logs') }}">System Logs</a>
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
    <div class="modal fade" id="addCollegeModal" tabindex="-1" role="dialog" aria-labelledby="addCollegeModalLabel" aria-hidden="true">
        <form action="{{ route('maintenance.colleges.add') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCollegeModalLabel">Add new college</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">College name</label>
                            <input type="text" class="form-control" name="college_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Add college</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Edit college modal --}}
    <div class="modal fade" id="editCollegeModal" tabindex="-1" role="dialog" aria-labelledby="editCollegeModalLabel" aria-hidden="true">
        <form action="{{ route('maintenance.colleges.update') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCollegeModalLabel">Edit college</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">College name</label>
                            <input type="hidden" name="college_id" id="college_id">
                            <input type="text" class="form-control" name="college_name" id="college_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Delete college modal --}}
    <div class="modal fade" id="deleteCollegeModal" tabindex="-1" role="dialog" aria-labelledby="deleteCollegeModalLabel" aria-hidden="true">
        <form action="{{ route('maintenance.college.delete') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCollegeModalLabel">Delete account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="college_id" id="del_cl_id">
                        <p>Are you sure to delete this college? Any data that uses this course will NOT be deleted however.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger btn-block">Delete Account</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $("#editCollegeModal").on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('collegeid')
                var name = button.data('collegename')

                var modal = $(this)
                modal.find('#college_id').val(id)
                modal.find('#college_name').val(name)
            }
        );

        $("#deleteCollegeModal").on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var cl_id = button.data('clid')

                var modal = $(this)
                modal.find('#del_cl_id').val(cl_id)
            }
        );
    </script>
@endsection