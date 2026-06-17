<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial;
            font-size: 13px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
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

        .right {
            text-align: right;
        }

        .no-border td {
            border: none;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>INVOICE</h2>
    </div>

    <table class="no-border">
        <tr>
            <td><b>Order No:</b> {{ $order->order_no }}</td>
            <td class="right"><b>Date:</b> {{ date('d-m-Y', strtotime($order->order_date)) }}</td>
        </tr>
    </table>

    <br>

    <h4>Customer Details</h4>
    <p>
        <b>Name:</b>
        {{ $order->get_user->first_name ?? '' }}
        {{ $order->get_user->last_name ?? '' }} <br>

        <b>Email:</b> {{ $order->get_user->email ?? '-' }} <br>
        <b>Phone:</b> {{ $order->get_user->phone_no ?? '-' }}
    </p>

    <h4>Address</h4>
    <p>
        {{ $order->get_address->address_line1 ?? '' }},
        {{ $order->get_address->address_line2 ?? '' }} <br>

        {{ $order->get_address->get_city->city_name ?? '' }},
        {{ $order->get_address->get_state->state_name ?? '' }} <br>

        {{ $order->get_address->pincode ?? '' }}
    </p>

    <h4>Products</h4>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Size</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
        <tbody>
            @foreach ($order->get_orderitems as $item)
                <tr>
                    <td>
                        @if ($item->get_product->get_product_images->image_path ?? false)
                            <img src="{{ public_path($item->get_product->get_product_images->image_path) }}"
                                width="60" height="60" style="object-fit:cover;">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->get_product->product_name ?? '-' }}</td>
                    <td>{{ $item->get_size->size_name ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
        </tbody>
    </table>

    <br>

    <h3 class="right">
        Grand Total: {{ $order->grand_total }}
    </h3>

</body>

</html>
