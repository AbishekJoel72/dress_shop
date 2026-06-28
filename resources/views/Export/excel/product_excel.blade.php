<!DOCTYPE html>
<html>

<head>
    <title>Product List</title>
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
