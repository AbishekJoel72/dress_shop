<!DOCTYPE html>
<html>

<head>
    <title>Feedback List</title>
</head>

<body>
    <h3>Feedback List</h3>
    <table>
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Order No</th>
                <th>Product</th>
                <th>Category</th>
                <th>Rating</th>
                <th>Feedback</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedbacks as $key => $feedback)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ date('d-m-Y', strtotime($feedback->created_at)) }}</td>
                    <td>
                        {{ $feedback->get_register->first_name ?? '' }}
                        {{ $feedback->get_register->last_name ?? '' }}
                    </td>
                    <td>{{ $feedback->get_order->order_no ?? '-' }}</td>
                    <td>{{ $feedback->get_product->product_name ?? '-' }}</td>
                    <td>{{ $feedback->get_product->get_category->name ?? '-' }}</td>
                    <td>{{ $feedback->rating }}</td>
                    <td>{{ $feedback->feedback }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
