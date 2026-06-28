<!DOCTYPE html>
<html>

<head>
    <title>Size Type List</title>
    <style>
        body {
            font-family: Arial;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }
    </style>
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
