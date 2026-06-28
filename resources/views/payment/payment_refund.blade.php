@extends('layouts.admin.default')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-transparent ">
                <h5>Payment Refund Filter</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="from_date" class="form-label mb-1">From Date</label>
                        <input type="text" id="from_date" class="form-control filter_date" placeholder="Select From Date">
                    </div>

                    <div class="col-md-4">
                        <label for="to_date" class="form-label mb-1">To Date</label>
                        <input type="text" id="to_date" class="form-control filter_date" placeholder="Select To Date">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label mb-1">Order No</label>
                        <input type="text" class="form-control" id="order_no" placeholder="Enter Order No">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="customer_name" class="form-label mb-1">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" placeholder="Enter Customer Name">
                    </div>

                    <div class="col-md-4">
                        <label for="payment_method" class="form-label mb-1">Payment Method</label>
                        <select class="form-control" id="payment_method">
                            <option value="">Select Payment Method</option>
                            <option value="gpay">Google Pay</option>
                            <option value="phonepe">PhonePe</option>
                            <option value="paytm">Paytm</option>
                        </select>
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
            $('#filterBtn').click(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            $('#resetBtn').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#order_no').val('');
                $('#customer_name').val('');
                $('#payment_method').val('');
                $('#status').val('');
                table.ajax.reload();
            });
        });
    </script>
@endsection
