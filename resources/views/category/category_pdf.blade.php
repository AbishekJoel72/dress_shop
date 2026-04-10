<!DOCTYPE html>
<html>
<head>
    <title>Category List</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; }
    </style>
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
