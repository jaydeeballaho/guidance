@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
                <h2>View Accounts</h2>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="current-tab" data-toggle="tab" href="#current" role="tab" aria-controls="current"
                            aria-selected="true">Current</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="deactivated-tab" data-toggle="tab" href="#deactivated" role="tab" aria-controls="deactivated"
                            aria-selected="false">Deactivated</a>
                    </li>
                </ul>
                <div class="tab-content" id="tabContent">
                    <div class="tab-pane show active" id="current" role="tabpanel" aria-labelledby="current-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>College affinition</th>
                                    <th>Date working</th>
                                    <th>Account created</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($counsels as $acct)
                                <tr>
                                    <td>{{ $acct->counsel->full_name }}</td>
                                    <td>{{ $acct->email }}</td>
                                    <td>Counsel</td>
                                    <td>{{ $acct->counsel->college()->withTrashed()->first()->name }}</td>
                                    <td>{{ $acct->counsel->dateWorking }}</td>
                                    <td>{{ $acct->created_at }}</td>
                                    <td>
                                        <button
                                            class="btn btn-danger"
                                            data-usrid="{{ $acct->id }}"
                                            data-toggle="modal"
                                            data-target="#deactivateAcctModal">
                                            Deactivate
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="deactivated" role="tabpanel" aria-labelledby="deactivated-tab">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>College affinition</th>
                                    <th>Account created</th>
                                    <th>Account deactivated</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($counselsDeactivated as $acct)
                                <tr>
                                    <td>{{ $acct->counsel->full_name }}</td>
                                    <td>{{ $acct->email }}</td>
                                    <td>Counsel</td>
                                    <td>{{ $acct->counsel->college()->withTrashed()->first()->name }}</td>
                                    <td>{{ $acct->created_at }}</td>
                                    <td>{{ $acct->deleted_at }}</td>
                                    <td>
                                        <button
                                            class="btn btn-danger"
                                            data-usrid="{{ $acct->id }}"
                                            data-toggle="modal"
                                            data-target="#reactivateAcctModal">
                                            Reactivate
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                

                <button class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">Add counsel account</button>
            </div>
            <div class="col-md-2 col-sm-12">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="{{ route('maintenance.colleges') }}" class="nav-link">Colleges</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('maintenance.accounts') }}">User Accounts</a>
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
    {{-- Add account modal --}}
    <div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalLabel" aria-hidden="true">
        <form action="{{ route('maintenance.account.add') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAccountModalLabel">Add new account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Email address to use</label>
                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Retype password</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                            
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">College to be assigned</label>
                            <select name="college_id" id="" class="form-control{{ $errors->has('college_id') ? ' is-invalid' : '' }}" required>
                                @foreach($colleges as $college)
                                    <option value="{{ $college->id }}">{{ $college->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('college_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Invalid college</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Date of designation</label>
                            <input type="date" name="dateWorking" id="" class="form-control" max="{{ \Carbon\Carbon::now()->toDateString() }}">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="">Last name</label>
                            <input type="text" class="form-control" name="lastName" required>
                        </div>
                        <div class="form-group">
                            <label for="">First name</label>
                            <input type="text" class="form-control" name="firstName" required>
                        </div>
                        <div class="form-group">
                            <label for="">Middle name</label>
                            <input type="text" class="form-control" name="middleName">
                        </div>
                        <div class="form-group">
                            <label for="">Ext. name</label>
                            <input type="text" class="form-control" name="extName">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Add counsel account</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Edit account modal --}}
    <div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="editAccountModalLabel" aria-hidden="true">
        <form action="{{ route('maintenance.account.update') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAccountModalLabel">Edit account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="usr_id" id="usr_id">
                        <div class="form-group">
                            <label for="">Email address</label>
                            <input type="text" class="form-control" name="email" id="usr_email">
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="role" id="usr_role" class="form-control">
                                <option value="1">Councilor</option>
                                <option value="2">Student</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Deactivate account modal --}}
    <div class="modal fade" id="deactivateAcctModal" tabindex="-1" role="dialog" aria-labelledby="deactivateAcctModalLabel" aria-hidden="true">
        <form action="{{ route('maintenance.account.deactivate') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deactivateAcctModalLabel">Deactivate account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="usr_id" id="del_usr_id">
                        <p>Are you sure to deactivate this account?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger btn-block">Deactivate Account</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Reactivate account modal --}}
    <div class="modal fade" id="reactivateAcctModal" tabindex="-1" role="dialog" aria-labelledby="reactivateAcctModalLabel" aria-hidden="true">
        <form action="{{ route('maintenance.account.reactivate') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reactivateAcctModalLabel">Reactivate account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="usr_id" id="rel_usr_id">
                        <p>Are you sure to reactivate this account?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger btn-block">Reactivate Account</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        $("#editAccountModal").on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var usr_id = button.data('usrid')
                var email = button.data('email')
                var role = button.data('role')

                var modal = $(this)
                modal.find('#usr_email').val(email)
                modal.find('#usr_role').val(role)
                modal.find('#usr_id').val(usr_id)
            }
        );

        $("#deactivateAcctModal").on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var usr_id = button.data('usrid')

                var modal = $(this)
                modal.find('#del_usr_id').val(usr_id)
            }
        );

        $("#reactivateAcctModal").on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var usr_id = button.data('usrid')

                var modal = $(this)
                modal.find('#rel_usr_id').val(usr_id)
            }
        );
    </script>
@endsection