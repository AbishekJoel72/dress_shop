<!DOCTYPE html>
<html>

<head>
    <title>Customer List</title>
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

    <h3>Customer List</h3>

<table>

<thead>

<tr>

<th>S.NO</th>

<th>Registered Date</th>

<th>Customer Name</th>

<th>Email</th>

<th>Phone</th>

</tr>

</thead>

<tbody>

@foreach($users as $key => $user)

<tr>

<td>{{ $key+1 }}</td>

<td>

{{ $user->created_at ? date('d-m-Y',strtotime($user->created_at)) : '-' }}

</td>

<td>

{{ $user->first_name }}

{{ $user->last_name }}

</td>

<td>{{ $user->email }}</td>

<td>{{ $user->phone_no }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>

</html>
