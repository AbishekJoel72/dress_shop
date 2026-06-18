<!DOCTYPE html>
<html>

<head>
    <title>Payment List</title>
</head>

<body>

    <h3>Payment List</h3>

    <table>
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Payment Date</th>
                <th>Order NO</th>
                <th>Customer Name</th>
                <th>Transaction ID</th>
                <th>Payment Method</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Payment Status</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $key => $p)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td> {{ $p->paid_at ? date('d-m-Y', strtotime($p->paid_at)) : '-' }}</td>
                    <td>{{ $p->get_order->order_no ?? '-' }}</td>
                    <td> {{ $p->get_order->get_user->first_name ?? '' }}
                        {{ $p->get_order->get_user->last_name ?? '' }}</td>

                    <td>{{ $p->transaction_id }}</td>
                    <td>
                        @if ($p->payment_gateway == 'gpay')
                            Google Pay
                        @elseif($p->payment_gateway == 'phonepe')
                            PhonePe
                        @elseif($p->payment_gateway == 'paytm')
                            Paytm
                        @else
                            Cash On Delivery
                        @endif
                    </td>
                    <td>{{ $p->amount }}</td>
                    <td>{{ $p->currency }}</td>
                    <td>
                        @if ($p->payment_status == 'pending')
                            Pending
                        @elseif($p->payment_status == 'success')
                            Success
                        @elseif($p->payment_status == 'failed')
                            Failed
                        @else
                            Refunded
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
