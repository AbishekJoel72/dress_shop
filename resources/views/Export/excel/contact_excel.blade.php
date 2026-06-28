<!DOCTYPE html>
<html>

<head>
    <title> Customer Contact List</title>
</head>

<body>
    <h3>Customer Contact List</h3>
    <table>
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Registered Date</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $key => $contact)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $contact->created_at ? date('d-m-Y', strtotime($contact->created_at)) : '-' }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->message }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
