@extends('layouts.admin.default')
@section('content')
    <div class="container">
        <div class="card ">
            <div class="card-header bg-transparent">
                <h5>Payment Filter</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4" >
                        <label for="order_no" class="form-label mb-1">Order No</label>
                        <input type="text" id="order_no" class="form-control" placeholder="Enter Order No">
                    </div>
                    <div class="col-md-4">
                        <label for="customer_name" class="form-label mb-1">Customer Name</label>
                        <input type="text" id="customer_name" class="form-control" placeholder="Enter Customer Name">
                    </div>
                    <div class="col-md-4">
                        <label for="transaction_id" class="form-label mb-1">Transaction ID</label>
                        <input type="text" id="transaction_id" class="form-control" placeholder="Enter Transaction ID">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="payment_gateway" class="form-label mb-1">Payment Method</label>
                        <select id="payment_gateway" class="form-select">
                            <option value="">Select Payment Method</option>
                            <option value="gpay">Google Pay</option>
                            <option value="phonepe">PhonePe</option>
                            <option value="paytm">Paytm</option>
                            <option value="cash_on_delivery">Cash On Delivery</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="payment_status" class="form-label mb-1">Payment Status</label>
                        <select id="payment_status" class="form-select">
                            <option value="">Select Payment Status</option>
                            <option value="success">Success</option>
                            <option value="pending">Pending</option>
                            <option value="failed">Failed</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="from_date" class="form-label mb-1">From Date</label>
                        <input type="text" id="from_date" class="form-control filter_date" placeholder="Select From Date">
                    </div>
                    <div class="col-md-2">
                        <label for="from_date" class="form-label mb-1">To Date</label>
                        <input type="text" id="to_date" class="form-control filter_date" placeholder="Select To Date">
                    </div>
                </div>
            </div>
           <div class="card-footer d-flex justify-content-center gap-2 bg-transparent">
                <button type="button" class="btn btn-primary" id="filterBtn">
                    <i class="fa-solid fa-filter"></i> Show Filter
                </button>

                <button type="reset" class="btn btn-secondary" id="resetBtn">
                    <i class="fa-solid fa-rotate-right"></i> Reset
                </button>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5>payment List</h5>
                <div class="dropdown">
                    <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="dropdown">Download</button>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item exportBtn" data-type="excel">Excel</a> </li>
                        <li><a href="#" class="dropdown-item exportBtn" data-type="pdf"> PDF</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Payment Date</th>
                            <th>Order No</th>
                            <th>Customer Name</th>
                            <th>Transaction ID</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                            <th>Currency</th>
                            <th>Payment</th>
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
            
            $('.filter_date').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
                endDate: new Date()
            });


            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('payment_list') }}",
                    data: function(d) {
                        d.order_no = $('#order_no').val();
                        d.customer_name = $('#customer_name').val();
                        d.transaction_id = $('#transaction_id').val();
                        d.payment_gateway = $('#payment_gateway').val();
                        d.payment_status = $('#payment_status').val();
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                    }
                },
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
                            if (!data) {
                                return '-';
                            }
                            let date = new Date(data);
                            let day = String(date.getDate()).padStart(2, '0');
                            let month = String(date.getMonth() + 1).padStart(2, '0');
                            let year = date.getFullYear();
                            return `${day}-${month}-${year}`;
                        }
                    },
                    {
                        data: 'get_order.order_no',
                        name: 'get_order.order_no',
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name',
                    },
                    {
                        data: 'transaction_id',
                        name: 'transaction_id',
                        render: function(data) {
                            return data ?? '-';
                        }
                    },
                    {
                        data: 'payment_gateway',
                        name: 'payment_gateway',
                        render: function(data, type, row) {
                            if (data == 'gpay') {
                                return '<span>Google Pay</span>';
                            } else if (data == 'phonepe') {
                                return '<span>Phone Pe</span>'
                            } else if (data == 'paytm') {
                                return '<span>PAYTM</span>'
                            } else {
                                return '<span>Cash On Delivery</span>'
                            }
                        }
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        render: function(data) {
                            return '₹ ' + data;
                        }
                    },
                    {
                        data: 'currency',
                        name: 'currency',
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                        render: function(data) {
                            if (data == 'success') {
                                return '<span class="badge bg-success">Success</span>';
                            } else if (data == 'pending') {
                                return '<span class="badge bg-warning">Pending</span>';
                            } else if (data == 'failed') {
                                return '<span class="badge bg-danger">Failed</span>';
                            } else {

                                return '<span class="badge bg-secondary">Refunded</span>';
                            }
                        }
                    }
                ]
            });
           $('#filterBtn').click(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            $('#resetBtn').click(function() {
                $('#order_no').val('');
                $('#customer_name').val('');
                $('#transaction_id').val('');
                $('#payment_gateway').val('');
                $('#payment_status').val('');
                $('#from_date').val('');
                $('#to_date').val('');
                table.ajax.reload();
            });


        });
        $(document).on('click', '.exportBtn', function(e) {

            e.preventDefault();

            let type = $(this).data('type');

            let order_no = $('#order_no').val();
            let customer_name = $('#customer_name').val();
            let transaction_id = $('#transaction_id').val();

            let payment_gateway = $('#payment_gateway').val();
            let payment_status = $('#payment_status').val();

            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();

            let url = "{{ route('payment.export') }}";

            window.location.href =
                url +
                '?type=' + type +
                '&order_no=' + encodeURIComponent(order_no || '') +
                '&customer_name=' + encodeURIComponent(customer_name || '') +
                '&transaction_id=' + encodeURIComponent(transaction_id || '') +
                '&payment_gateway=' + encodeURIComponent(payment_gateway || '') +
                '&payment_status=' + encodeURIComponent(payment_status || '') +
                '&from_date=' + encodeURIComponent(from_date || '') +
                '&to_date=' + encodeURIComponent(to_date || '');
        });
    </script>
@endsection
