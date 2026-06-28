<!DOCTYPE html>
<html>

<head>
    <title>Size Type List</title>
</head>

<body>
    <h3>Size Type List</h3>
    <table>
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($size_types as $key => $s)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $s->size_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
