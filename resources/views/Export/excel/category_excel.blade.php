<!DOCTYPE html>
<html>
<head>
    <title>Category List</title>
</head>
<body>

<h3>Category List</h3>

<table>
    <thead>
        <tr>
            <th>S.NO</th>
            <th>Name</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $key => $cat)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $cat->name }}</td>
            <td>{{ $cat->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
