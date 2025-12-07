@extends('layouts.admin.default')
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">List Product</h5>
                <a href="{{ route('update_products') }}" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-plus"></i> Add New
                </a>
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

        <!-- View Image Modal -->
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

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product') }}",

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
                        // Description
                        $('#product_description').text(data.description ?? "-");

                        // Clear old images
                        $('#product_images').html('');

                        // Append images dynamically
                        if (data.image_path) {

                            $('#product_images').append(`
                            <div class="col-md-3 mb-3">
                                <img src="/${data.image_path}" class="img-fluid rounded border" />
                            </div>`);


                        } else {
                            $('#product_images').html(
                                '<p class="text-muted">No Images Found</p>');
                        }

                        // Show modal
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
        });
    </script>
@endsection
