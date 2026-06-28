<!DOCTYPE html>

<html>

<head>
    <title>order Cancelled List</title>
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
    <h3>Order Cancelled List</h3>
    <table>
        <thead>
            <tr>
                <th>S.NO</th>
                <th>Date</th>
                <th>Order No</th>
                <th>Customer</th>
                <th>Grand Total</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
                <th>Payment Method</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $o)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ date('d-m-Y', strtotime($o->order_date)) }}</td>
                    <td>{{ $o->order_no }}</td>
                    <td>
                        {{ $o->get_user->first_name ?? '' }}
                        {{ $o->get_user->last_name ?? '' }}
                    </td>
                    <td>{{ $o->grand_total }}</td>
                    <td>
                        @if ($o->get_payment->payment_status == 'pending')
                            Pending
                        @elseif($o->get_payment->payment_status == 'success')
                            Success
                        @elseif($o->get_payment->payment_status == 'failed')
                            Failed
                        @else
                            Refunded
                        @endif
                    </td>
                    <td>
                        @if ($o->delivery_status == 'pending')
                            Pending
                        @elseif($o->delivery_status == 'confirmed')
                            Confirmed
                        @elseif($o->delivery_status == 'shipped')
                            Shipping
                        @elseif($o->delivery_status == 'out_for_delivery')
                            Out For Delivery
                        @elseif($o->delivery_status == 'delivered')
                            Delivered
                        @else
                            Cancelled
                        @endif
                    </td>
                    <td>
                        @if ($o->get_payment->payment_gateway == 'gpay')
                            Google Pay
                        @elseif($o->get_payment->payment_gateway == 'phonepe')
                            PhonePe
                        @elseif($o->get_payment->payment_gateway == 'paytm')
                            Paytm
                        @else
                            Cash On Delivery
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
