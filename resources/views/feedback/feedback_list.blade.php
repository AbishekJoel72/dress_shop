@extends('layouts.admin.default')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-transparent">
                <h5>Feedback Filter</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 ">
                        <label for="from_date" class="form-label mb-1">From Date</label>
                        <input type="text" class="form-control" id="from_date" placeholder="Select From Date">
                    </div>

                    <div class="col-md-3 ">
                        <label for="to_date" class="form-label mb-1">Date To</label>
                        <input type="text" class="form-control" id="to_date" placeholder="Select To Date">
                    </div>

                    <div class="col-md-3 ">
                        <label for="customer_name" class="form-label mb-1">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" placeholder="Enter Customer Name">
                    </div>

                    <div class="col-md-3 ">
                        <label for="order_no" class="form-label mb-1">Order No</label>
                        <input type="text" class="form-control" id="order_no" placeholder="Enter Order No">
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-3 ">
                        <label for="product_name" class="form-label mb-1">Product</label>
                        <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name">
                    </div>

                    <div class="col-md-3 ">
                        <label for="category_name" class="form-label mb-1">Category</label>
                        <input type="text" class="form-control" id="category_name" placeholder="Enter Category">
                    </div>

                    <div class="col-md-3 ">
                        <label for="rating" class="form-label mb-1">Rating</label>
                        <select class="form-control" id="rating">
                            <option value="">Select Rating</option>
                            <option value="1">1 ★</option>
                            <option value="2">2 ★</option>
                            <option value="3">3 ★</option>
                            <option value="4">4 ★</option>
                            <option value="5">5 ★</option>
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
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5>Feedback List</h5>
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
                            <th>Date</th>
                            <th>Name</th>
                            <th>Order No</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Rating</th>
                            <th>Feedback</th>
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
                <h5>Product Images</h5>
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
                    url: "{{ route('feedback_list') }}",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.customer_name = $('#customer_name').val();
                        d.order_no = $('#order_no').val();
                        d.product_name = $('#product_name').val();
                        d.category_name = $('#category_name').val();
                        d.rating = $('#rating').val();
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
                    },
                    {
                        data: 'full_name',
                        name: 'full_name',
                    },
                    {
                        data: 'get_order.order_no',
                        name: 'get_order.order_no',
                    },
                    {
                        data: 'get_product.product_name',
                        name: 'get_product.product_name',
                    },
                    {
                        data: 'get_product.get_category.name',
                        name: 'get_product.get_category.name',
                    },
                    {
                        data: 'rating',
                        name: 'rating',
                    },
                    {
                        data: 'feedback',
                        name: 'feedback',
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
                $('#from_date').val('');
                $('#to_date').val('');
                $('#customer_name').val('');
                $('#order_no').val('');
                $('#product_name').val('');
                $('#category_name').val('');
                $('#rating').val('');
                table.ajax.reload();
            });
        });

        $(document).on('click', '.ViewImage', function() {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('feedback_list') }}",
                type: "GET",
                data: {
                    id: id,
                    get_viewimage: true
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
            let url = "{{ route('feedback.export') }}";
            window.location.href =
                url +
                '?type=' + type +
                '&from_date=' + $('#from_date').val() +
                '&to_date=' + $('#to_date').val() +
                '&customer_name=' + encodeURIComponent($('#customer_name').val()) +
                '&order_no=' + encodeURIComponent($('#order_no').val()) +
                '&product_name=' + encodeURIComponent($('#product_name').val()) +
                '&category_name=' + encodeURIComponent($('#category_name').val()) +
                '&rating=' + $('#rating').val();

        });
    </script>
@endsection
