<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student List</title>
</head>
<body>
<table border="1">
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
</body>
</html>
