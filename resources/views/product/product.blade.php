@extends('layouts.admin.default')
@section('content')
    <div class="container">

        <div class="card mb-3">
            <div class="card-header bg-transparent">
                <h5 class="mb-0">Product Filter</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="product_name">Product Name</label>
                        <input type="text" id="product_name" class="form-control" placeholder="Enter Product Name">
                    </div>
                    <div class="col-md-4">
                        <label for="category_id">Category</label>
                        <select id="category_id" class="form-select">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Status</label>
                        <select id="status" class="form-select">
                            <option value="" >All Status</option>
                            <option value="1">Active</option>
                            <option value="0">In active</option>
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
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">List Product</h5>
                <div class="d-flex align-items-center gap-2 ms-auto">
                    <a href="{{ route('update_products') }}" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-plus"></i> Add New
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="dropdown">
                            Download
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#" class="dropdown-item exportBtn" data-type="excel">Excel</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item exportBtn" data-type="pdf">PDF</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Stock</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="viewImageModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Product Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <div class="row" id="product_images"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Discription</th>
                                    <td>
                                        <span id="product_description"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editstatusmodel" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('product') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="edit_status" value="true">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label d-block">Status</label>
                                    <div class="d-flex align-items-center gap-4">
                                        <div class="form-check">
                                            <input type="radio" name="status" id="status_1" value="1"
                                                class="form-check-input" required>
                                            <label for="status_1" class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="status" id="status_0" value="0"
                                                class="form-check-input" required>
                                            <label for="status_0" class="form-check-label">Inactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-pen">
                                </i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
@section('script')
    @include('layouts.datatable')
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('product') }}",
                    data: function(d) {
                        d.product_name = $('#product_name').val();
                        d.category_id = $('#category_id').val();
                        d.status = $('#status').val();
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
                        data: 'product_name',
                        name: 'product_name',

                    },
                    {
                        data: 'price',
                        name: 'price',

                    },
                    {
                        data: 'discount_price',
                        name: 'discount_price',

                        render: function(data, type, row) {
                            return data ? data : "-";
                        }
                    },
                    {
                        data: 'stock',
                        name: 'stock',


                    },
                    {
                        data: 'get_category.name',
                        name: 'get_category.name',


                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<span class="badge bg-primary">Active</span>';
                            } else {
                                return '<span class="badge bg-danger">Inactive</span>';
                            }
                        }

                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        className: 'text-center'
                    }
                ]
            });
            $('#filterBtn').click(function() {
                table.draw();
            });

            $(document).on('click', '.ViewimageRow', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('product') }}",
                    method: "GET",
                    data: {
                        id: id,
                        get_image: true,
                    },
                    success: function(data) {
                        $('#product_description').text(data.description ?? "-");
                        $('#product_images').html('');
                        if (data.get_product_images && data.get_product_images.image_path) {
                            $('#product_images').append(`
                            <div class="col-md-3 mb-3">
                                <img src="/${data.get_product_images.image_path}" class="img-fluid rounded border" />
                            </div>`);
                        } else {
                            $('#product_images').html(
                                '<p class="text-muted">No Images Found</p>');
                        }
                        $('#viewImageModal').modal('show');
                    }
                });
            });


            $(document).on('click', '.StatusRow', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('product') }}",
                    method: "GET",
                    dataType: "json",
                    data: {
                        id: id,
                        get_status: true,
                    },
                    success: function(data) {
                        $('#edit_id').val(data.id);
                        if (data.status == 1) {
                            $('#status_1').prop('checked', true);
                        } else {
                            $('#status_0').prop('checked', true);
                        }
                        $('#editstatusmodel').modal("show");
                    }
                })
            });


            $(document).on('click', '.deleteRow', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('product') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}",
                        delete_product: true,
                    },
                    success: function(data) {
                        $('#modalMessage').text("Delete Successfully");
                        var modal = new bootstrap.Modal(document.getElementById(
                            'sessionModal'));
                        modal.show();
                        $('#sessionModal').on('hidden.bs.modal', function() {
                            $('#datatable').DataTable().ajax.reload();
                        });
                    },
                    error: function() {
                        $("#modalMessage").text("Something went wrong!");
                        var modal = new bootstrap.Modal(document.getElementById(
                            'sessionModal'));
                        modal.show();
                    }
                });
            });

            $(document).on('click', '.exportBtn', function(e) {
                e.preventDefault();
                let type = $(this).data('type');
                let product_name = $('#product_name').val();
                let category_id = $('#category_id').val();
                let status = $('#status').val();
                let url = "{{ route('products.export') }}";
                window.location.href =
                    url +
                    '?type=' + type +
                    '&product_name=' + encodeURIComponent(product_name) +
                    '&category_id=' + encodeURIComponent(category_id) +
                    '&status=' + encodeURIComponent(status);
            });
        });
    </script>
@endsection
