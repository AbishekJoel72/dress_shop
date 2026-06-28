@extends('layouts.admin.default')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5>Contact Filter</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="name" class="form-label mb-1">Customer Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label mb-1">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label mb-1">Phone Numer</label>
                        <input type="text" id="phone" class="form-control" placeholder="Enter Phone Number">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="from_date" class="form-label mb-1">From Date</label>
                        <input type="text" id="from_date" class="form-control filter_date"
                            placeholder="Select From Date">
                    </div>
                    <div class="col-md-6">
                        <label for="to_date" class="form-label mb-1">To Date</label>
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
                <h5>Contact List</h5>
                <div class="dropdown">
                    <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="dropdown"> Download </button>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item exportBtn" data-type="excel"> Excel</a></li>
                        <li><a href="#" class="dropdown-item exportBtn" data-type="pdf"> PDF</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Received Date</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
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
                    url: "{{ route('contact_list') }}",
                    data: function(d) {
                        d.name = $('#name').val();
                        d.email = $('#email').val();
                        d.phone = $('#phone').val();
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
                        data: 'created_at',
                        name: 'created_at',
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
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'message',
                        name: 'message',

                    },
                ]
            });
            $('#filterBtn').click(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            $('#resetBtn').click(function() {
                $('#name').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#from_date').val('');
                $('#to_date').val('');
                table.ajax.reload();
            });
        });

        $(document).on('click', '.exportBtn', function(e) {
            e.preventDefault();
            let type = $(this).data('type');
            let name = $('#name').val();
            let email = $('#email').val();
            let phone = $('#phone').val();
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let url = "{{ route('contact.export') }}";
            window.location.href =
                url +
                '?type=' + type +
                '&name=' + encodeURIComponent(name || '') +
                '&email=' + encodeURIComponent(email || '') +
                '&phone=' + encodeURIComponent(phone || '') +
                '&from_date=' + encodeURIComponent(from_date || '') +
                '&to_date=' + encodeURIComponent(to_date || '');

        });
    </script>
@endsection
