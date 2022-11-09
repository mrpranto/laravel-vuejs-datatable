<table>
    <thead>
    <tr>
        <th>SL</th>
        <th>Class Name</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Age</th>
        <th>Address</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $key => $student)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $student->classInfo->class_name }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->age }}</td>
            <td>{{ $student->address }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
