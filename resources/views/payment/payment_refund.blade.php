@extends('layouts.admin.default')
@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-header bg-transparent ">
                <h5 class="mb-0">Filter</h5>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-md-3 ">
                        <label for="from_date">From Date</label>
                        <input type="text" id="from_date" class="form-control filter_date" placeholder="From Date">
                    </div>

                    <div class="col-md-3">
                        <label for="to_date">To Date</label>
                        <input type="text" id="to_date" class="form-control filter_date" placeholder="To Date">
                    </div>

                    <div class="col-md-3">
                        <label>Order No</label>
                        <input type="text" class="form-control" id="order_no" placeholder="Enter Order No">
                    </div>

                    <div class="col-md-3">
                        <label>Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" placeholder="Enter Customer Name">
                    </div>

                    <div class="col-md-3 mt-3">
                        <label>Payment Method</label>
                        <select class="form-control" id="payment_method">
                            <option value="">Select Payment Method</option>
                            <option value="gpay">Google Pay</option>
                            <option value="phonepe">PhonePe</option>
                            <option value="paytm">Paytm</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center bg-transparent">
                <button class="btn  btn-primary" id="filterBtn"> <i class="fa-solid fa-filter"></i>
                    Show Filter</button>
            </div>
        </div>

        <div class="card">

            <div class="card-header bg-transparent">
                <h5>Refund List</h5>
            </div>

            <div class="card-body">

                <table id="datatable" class="table table-bordered">

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
                    url: "{{ route('payment_refund') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.order_no = $('#order_no').val();
                        d.customer_name = $('#customer_name').val();
                        d.payment_method = $('#payment_method').val();
                        d.status = $('#status').val();
                    }
                },

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'refund_date',
                        name: 'refund_date',
                        render: function(data) {

                            if (!data) return '-';

                            let date = new Date(data);

                            let day = String(date.getDate()).padStart(2, '0');
                            let month = String(date.getMonth() + 1).padStart(2, '0');
                            let year = date.getFullYear();

                            return `${day}-${month}-${year}`;
                        }
                    },
                    {
                        data: 'order_no',
                        name: 'order_no'
                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    },
                    {
                        data: 'transaction_id',
                        name: 'transaction_id'
                    },
                    {
                        data: 'refund_transaction_id',
                        name: 'refund_transaction_id'
                    },
                    {
                        data: 'refund_amount',
                        name: 'refund_amount',
                        render: function(data) {
                            return '₹ ' + data;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#filterBtn').click(function() {
                table.ajax.reload();
            });


        });
    </script>
@endsection
