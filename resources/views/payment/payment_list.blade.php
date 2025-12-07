@extends('layouts.admin.default')
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">payment List</h5>
            </div>
            <div class="card-body">

                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Order ID</th>
                            <th>Transaction ID</th>
                            <th>payment Gateway</th>
                            <th>Amount</th>
                            <th>Currency</th>
                      
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>


    </div>
    @include('layouts.footer')
@endsection
@section('script')
    @include('layouts.datatable')
    <script>
        $(document).ready(function() {

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('payment_list') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        className: 'text-center'
                    },
                    {
                        data: 'paid_at',
                        name: 'paid_at',
                        render: function(data) {
                            if (!data) return "-";
                            let dateObj = new Date(data);
                            return dateObj.toLocaleDateString('en-GB');
                        }

                    },
                    {
                        data: 'get_order.get_product.product_name',
                        name: 'get_order.get_product.product_name',

                    },
                    {
                        data: 'get_order.order_id',
                        name: 'get_order.order_id',

                    },
                    {
                        data: 'transaction_id',
                        name: 'transaction_id',

                    },
                    {
                        data: 'payment_gateway',
                        name: 'payment_gateway',
                         render: function(data, type, row) {
                            if (data == 'gpay') {
                                return '<span  >G Pay</span>';
                            } else if (data == 'phonepe') {
                                return '<span >Phonepe</span>'
                            } else if (data == 'paytm') {
                                return '<span >Pay TM</span>'
                            } else if (data == 'netbanking') {
                                return '<span>Net Banking</span>'
                            } else if (data == 'card') {
                                return '<span >Card</span>'
                            } else if (data == 'cash_on_delivery') {
                                return '<span >Cash On Delivery</span>'
                            }
                        }
                    },
                    {
                        data: 'get_order.total_amount',
                        name: 'get_order.total_amount',


                    },
                    {
                        data: 'currency',
                        name: 'currency',
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false,
                    //     width: '5%',
                    //     className: 'text-center'
                    // }
                ]
            });



        });
    </script>
@endsection
