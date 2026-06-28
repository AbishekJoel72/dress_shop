@extends('layouts.admin.default')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5>Favourite Filter</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="customer_name" class="form-label mb-1">Customer Name</label>
                        <input type="text" id="customer_name" class="form-control" placeholder="Enter Customer Name">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label mb-1">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="col-md-4">
                        <label for="phone_no" class="form-label mb-1">Phone Number</label>
                        <input type="text" id="phone_no" class="form-control" placeholder="Enter Phone Number">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="product_name" class="form-label mb-1">Product Name</label>
                        <input type="text" id="product_name" class="form-control" placeholder="Enter Product Name">
                    </div>
                    <div class="col-md-4">
                        <label for="category_name" class="form-label mb-1">Category Name</label>
                        <input type="text" id="category_name" class="form-control" placeholder="Enter Category Name">
                    </div>
                    <div class="col-md-2">
                        <label for="from_date" class="form-label mb-1">From Date</label>
                        <input type="text" id="from_date" class="form-control filter_date" placeholder="Select From date">
                    </div>
                    <div class="col-md-2">
                        <label for="to_date" class="form-label mb-1">To Date</label>
                        <input type="text" id="to_date" class="form-control filter_date" placeholder="Select To date">
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
                <h5>Favourites product List</h5>
                <div class="dropdown">
                    <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="dropdown">Download</button>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item exportBtn" data-type="excel"> Excel</a></li>
                        <li><a href="#" class="dropdown-item exportBtn" data-type="pdf">PDF</a> </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Date</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone NO</th>
                            <th>Product Name</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Offcanvas Image display -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="imageCanvas">
            <div class="offcanvas-header">
                <h5>Favourite Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas">
                </button>
            </div>
            <div class="offcanvas-body text-center">
                <img id="fav_image" class="img-fluid rounded border mb-3" style="max-height:300px">
                <h5 id="fav_product"></h5>
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
                    url: "{{ route('favourites') }}",
                    data: function(d) {
                        d.customer_name = $('#customer_name').val();
                        d.email = $('#email').val()
                        d.phone_no = $('#phone_no').val();
                        d.product_name = $('#product_name').val();
                        d.category_name = $('#category_name').val();
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
                        data: 'added_date',
                        name: 'added_date',
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
                        data: 'get_user.first_name',
                        name: 'get_user.first_name',
                        render: function(data, type, row) {
                            return (row.get_user?.first_name ?? '') + ' ' + (row.get_user
                                ?.last_name ?? '');
                        }
                    },
                    {
                        data: 'get_user.email',
                        name: 'get_user.email'
                    },
                    {
                        data: 'get_user.phone_no',
                        name: 'get_user.phone_no'
                    },
                    {
                        data: 'get_product.product_name',
                        name: 'get_product.product_name'
                    },
                    {
                        data: 'get_product.get_category.name',
                        name: 'get_product.get_category.name'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ]
            });
            $('#filterBtn').click(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            $('#resetBtn').click(function() {
                $('#customer_name').val('');
                $('#email').val('');
                $('#phone_no').val('');
                $('#product_name').val('');
                $('#category_name').val('');
                $('#from_date').val('');
                $('#to_date').val('');
                table.ajax.reload();
            });
        });

        $(document).on('click', '.ViewImage', function() {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('favourites') }}",
                type: "GET",
                data: {
                    id: id,
                    get_view_image: true
                },
                success: function(data) {
                    $('#fav_product').text(data.get_product?.product_name ?? '-');
                    let image = '';
                    if (data.get_product?.get_product_images) {
                        image = '/' + data.get_product.get_product_images.image_path;
                    }
                    $('#fav_image').attr('src', image);
                    let canvas = new bootstrap.Offcanvas(document.getElementById(
                        'imageCanvas'));
                    canvas.show();
                }
            });
        });

        $(document).on('click', '.exportBtn', function(e) {
            e.preventDefault();
            let type = $(this).data('type');
            let customer_name = $('#customer_name').val();
            let email = $('#email').val();
            let phone_no = $('#phone_no').val();
            let product_name = $('#product_name').val();
            let category_name = $('#category_name').val();
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let url = "{{ route('favourites.export') }}";
            window.location.href =
                url +
                '?type=' + type +
                '&customer_name=' + encodeURIComponent(customer_name || '') +
                '&email=' + encodeURIComponent(email || '') +
                '&phone_no=' + encodeURIComponent(phone_no || '') +
                '&product_name=' + encodeURIComponent(product_name || '') +
                '&category_name=' + encodeURIComponent(category_name || '') +
                '&from_date=' + encodeURIComponent(from_date || '') +
                '&to_date=' + encodeURIComponent(to_date || '');

        });
    </script>
@endsection
