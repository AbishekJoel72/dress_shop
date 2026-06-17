@extends('layouts.admin.default')
@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-header bg-transparent">
                <h5 class="mb-0">Customer Filter</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" id="customer_name" class="form-control" placeholder="Enter Customer Name">
                    </div>
                    <div class="col-md-4">
                        <label for="email">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="col-md-4">
                        <label for="phone_no">Phone No</label>
                        <input type="text" id="phone_no" class="form-control" placeholder="Enter Phone Number">
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="from_date">From Date</label>
                        <input type="text" id="from_date" class="form-control filter_date"
                            placeholder="Select From Date">
                    </div>
                    <div class="col-md-6">
                        <label for="to_date">To Date</label>
                        <input type="text" id="to_date" class="form-control filter_date" placeholder="Select To Date">
                    </div>
                </div>
            </div>
            <div class="card-footer text-center bg-transparent">
                <button class="btn btn-primary" id="filterBtn">
                    <i class="fa-solid fa-filter"></i> Show Filter </button>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">List Customer</h5>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Registered Date</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
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
                    url: "{{ route('user_list_details') }}",
                    data: function(d) {
                        d.customer_name = $('#customer_name').val();
                        d.email = $('#email').val();
                        d.phone_no = $('#phone_no').val();
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
                        data: 'registered_date',
                        name: 'registered_date',
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
                        data: 'full_name',
                        name: 'full_name',
                        width: '30%',
                    },
                    {
                        data: 'email',
                        name: 'email',
                        width: '30%',

                    },
                    {
                        data: 'phone_no',
                        name: 'phone_no',
                        width: '30%',

                    },

                ]
            });
            $('#filterBtn').click(function() {
                table.draw();
            });
        });
    </script>
@endsection
