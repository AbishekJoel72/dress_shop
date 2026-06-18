<!DOCTYPE html>
<html>

<head>
    <title>Favourites List</title>
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

    <h3>Favourites List</h3>

    <table>
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Product</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($favourites as $key => $f)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td> {{ date('d-m-Y', strtotime($f->created_at)) }}</td>
                    <td>
                        {{ $f->get_user->first_name ?? '' }}
                        {{ $f->get_user->last_name ?? '' }}
                    </td>
                    <td>{{ $f->get_user->email ?? '-' }}</td>
                    <td>{{ $f->get_user->phone_no ?? '-' }} </td>
                    <td>{{ $f->get_product->product_name ?? '-' }}</td>
                    <td>{{ $f->get_product->get_category->name ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
