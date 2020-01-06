@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            @if(auth()->user()->role != 0)
                <h1>Profile</h1>
                <div class="col-6">
                    <form action="{{ route('account.edit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Last name</label>
                            <input
                                type="text"
                                class="form-control"
                                name="lastName"
                                id="lastName"
                                value="{{ $role_details->lastName }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">First name</label>
                            <input
                                type="text"
                                class="form-control"
                                name="firstName"
                                id="firstName"
                                value="{{ $role_details->firstName }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Middle name</label>
                            <input
                                type="text"
                                class="form-control"
                                name="middleName"
                                id="middleName"
                                value="{{ $role_details->middleName }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Ext. name</label>
                            <input
                                type="text"
                                class="form-control"
                                name="extName"
                                id="extName"
                                value="{{ $role_details->extName }}" disabled>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" id="editButton">Edit</button>
                            <button class="btn btn-danger" id="cancelButton" disabled>Cancel</button>
                            <button type="submit" class="btn btn-success" id="saveButton" disabled>Save</button>
                        </div>
                    </form>
                </div>
            @endif
            <hr>
            <div class="col-md-4 col-sm-12 mt-4">
                <h2>Change password</h2>
                <form action="{{ route('account.password_change') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="password" name="currentPassword" id="" class="form-control" placeholder="Current password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="" class="form-control" placeholder="New password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="" class="form-control" placeholder="Retype new password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary">Change password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#editButton').click(function (){
            $('#editButton').prop('disabled', true);
            $('#cancelButton').prop('disabled', false);
            $('#saveButton').prop('disabled', false);

            $('#firstName').prop('disabled', false);
            $('#middleName').prop('disabled', false);
            $('#lastName').prop('disabled', false);
            $('#extName').prop('disabled', false);

            return false;

        });
        $('#cancelButton').click(function (){
            $('#editButton').prop('disabled', false);
            $('#cancelButton').prop('disabled', true);
            $('#saveButton').prop('disabled', true);

            $('#firstName').prop('disabled', true);
            $('#middleName').prop('disabled', true);
            $('#lastName').prop('disabled', true);
            $('#extName').prop('disabled', true);

            return false;
        });
    </script>
@endsection
    