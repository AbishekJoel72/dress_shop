<!DOCTYPE html>
<html>

<head>
    <title>Product List</title>
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
    <h3>Product List</h3>
    <table>
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Product Name</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Product</th>
                <th>Discount Price</th>
                <th>Stock</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($product as $key => $p)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $p->product_name }}</td>
                    <td>{{ $p->get_category->name ?? '-' }}</td>
                    <td>{{ $p->description ?? '-' }}</td>
                    <td>{{ $p->price }}</td>
                    <td>{{ $p->discount_price ?? '-' }}</td>
                    <td>{{ $p->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
