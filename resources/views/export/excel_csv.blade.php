<table>
    <thead>

    <tr>
        @if(!in_array('id', $hide_columns))
            <th>ID</th>
        @endif
        @if(!in_array('class_info', $hide_columns))
            <th>Class Name</th>
        @endif
        @if(!in_array('name', $hide_columns))
            <th>Name</th>
        @endif
        @if(!in_array('phone', $hide_columns))
            <th>Email</th>
        @endif
        @if(!in_array('email', $hide_columns))
            <th>Phone</th>
        @endif
        @if(!in_array('age', $hide_columns))
            <th>Age</th>
        @endif
        @if(!in_array('address', $hide_columns))
            <th>Address</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($students as $key => $student)
        <tr>
            @if(!in_array('id', $hide_columns))
                <td>{{ $student->id }}</td>
            @endif
            @if(!in_array('class_info', $hide_columns))
                <td>{{ $student->classInfo->class_name }}</td>
            @endif
            @if(!in_array('name', $hide_columns))
                <td>{{ $student->name }}</td>
            @endif
            @if(!in_array('phone', $hide_columns))
                <td>{{ $student->email }}</td>
            @endif
            @if(!in_array('email', $hide_columns))
                <td>{{ $student->phone }}</td>
            @endif
            @if(!in_array('age', $hide_columns))
                <td>{{ $student->age }}</td>
            @endif
            @if(!in_array('address', $hide_columns))
                <td>{{ $student->address }}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
