@foreach($students as $stud)
    <tr>
        <td>{{ $stud->id }}</td>
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