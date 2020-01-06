@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <h2>System Log</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Message</th>
                        <th>User</th>
                        {{-- <th>Rating</th> --}}
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr
                            @switch($log->rating)
                                @case(1)
                                    class="table-warning"
                                    @break
                                @case(2)
                                    class="table-info"
                                    @break
                            @endswitch
                        >
                            <td>{{ $log->message }}</td>
                            <td>
                                @if($log->user['role'] == 0)
                                    Administrator (#id: {{ $log->user['id'] }})
                                @elseif($log->user['role'] == 2)
                                    {{ $log->user->student->full_name }} (#id: {{ $log->user['id'] }})
                                @elseif($log->user['role'] == 1)
                                    {{ $log->user->counsel->full_name }} (#id: {{ $log->user['id'] }})
                                @else
                                    Unknown
                                @endif
                            </td>
                            {{-- <td>{{ $log->rating }}</td> --}}
                            <td>{{ $log->created_at }}</td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
            {{ $logs->links() }}
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
                    <a class="nav-link active" href="{{ route('maintenance.logs') }}">System Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('maintenance.config') }}">Configuration</a>
                </li>
            </ul>
        </div>          
    </div>
</div>

@endsection