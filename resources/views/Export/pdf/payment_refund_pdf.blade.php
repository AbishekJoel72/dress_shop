<!DOCTYPE html>
<html>

<head>
    <title>Payment Refund List</title>
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
    <h3>Payment Refund List</h3>
    <table>
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Refund Date</th>
                <th>Order No</th>
                <th>Customer Name</th>
                <th>Payment Method</th>
                <th>Transaction ID</th>
                <th>Refund Reference</th>
                <th>Refund Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($refunds as $key => $refund)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        {{ $refund->refund_date ? date('d-m-Y', strtotime($refund->refund_date)) : '-' }}
                    </td>
                    <td>{{ $refund->get_payment->get_order->order_no ?? '-' }}</td>
                    <td>
                        {{ $refund->get_payment->get_order->get_user->first_name ?? '' }}
                        {{ $refund->get_payment->get_order->get_user->last_name ?? '' }}
                    </td>
                    <td>
                        @if ($refund->get_payment->payment_gateway == 'gpay')
                            Google Pay
                        @elseif($refund->get_payment->payment_gateway == 'phonepe')
                            PhonePe
                        @elseif($refund->get_payment->payment_gateway == 'paytm')
                            Paytm
                        @else
                            Cash On Delivery
                        @endif
                    </td>
                    <td>{{ $refund->get_payment->transaction_id ?? '-' }}</td>
                    <td>{{ $refund->refund_transaction_id ?? '-' }}</td>
                    <td>{{ $refund->refund_amount ?? 0 }}</td>
                    <td>Refunded</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
