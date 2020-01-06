@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-1"></div>
            <div class="col">
                <h2>Configuration</h2>

                <div class="container">
                    <form action="{{ route('maintenance.config') }}" method="POST">
                        @csrf
                        <div class="col-sm-12 col-md-8">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-0">Email verification for new users</h5>
                                        @if($email_verify->value)
                                            <input type="hidden" name="email_verify" value="0">
                                            <button class="btn btn-danger btn-sm" type="submit">Disable</button>
                                        @else
                                            <input type="hidden" name="email_verify" value="1">
                                            <button class="btn btn-primary btn-sm" type="submit">Enable</button>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="{{ route('maintenance.colleges') }}" class="nav-link">Colleges</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('maintenance.accounts') }}">User Accounts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('maintenance.logs') }}">System Logs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('maintenance.config') }}">Configuration</a>
                    </li>
                </ul>
            </div>          
        </div>
    </div>
@endsection

@section('modals')
    
@endsection

@section('scripts')

@endsection