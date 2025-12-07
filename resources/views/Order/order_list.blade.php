@extends('layouts.admin.default')
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">Ordered List</h5>
            </div>
            <div class="card-body">

                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
        <div class="modal fade" id="viewStateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <input type="hidden" name="edit_status" value="true">

                        <div class="modal-header">
                            <h5 class="modal-title">Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row ">
                                <div class="col">
                                    <label class="form-label d-block">Delivery Status</label>

                                    <div class="d-flex align-items-center gap-4 form-control">
                                        <div class="form-check">
                                            <input type="radio" name="delivery_status" id="pending" value="pending"
                                                class="form-check-input" required>
                                            <label for="pending" class="form-check-label">Pending</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="delivery_status" id="shipped" value="shipped"
                                                class="form-check-input" required>
                                            <label for="shipped" class="form-check-label">Shipping</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="delivery_status" id="out_for_delivery"
                                                value="out_for_delivery" class="form-check-input" required>
                                            <label for="out_for_delivery" class="form-check-label">Out For Delivery</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" name="delivery_status" id="delivered" value="delivered"
                                                class="form-check-input" required>
                                            <label for="delivered" class="form-check-label">Delivery</label>
                                        </div>

                                        <div class="form-check">
                                            <input type="radio" name="delivery_status" id="cancelled" value="cancelled"
                                                class="form-check-input" required>
                                            <label for="cancelled" class="form-check-label">Cancelled</label>
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

        <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
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
                                    <th>Date</th>
                                    <td><span id="date"></span></td>
                                </tr>
                                <tr>
                                    <th>Order</th>
                                    <td><span id="order_id"></span></td>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <td><span id="product_id"></span></td>
                                </tr>
                                <tr>
                                    <th>Category Name</th>
                                    <td><span id="category_id"></span></td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <div class="row" id="product_images"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td><span id="price"></span></td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td><span id="quantity"></span></td>
                                </tr>
                                <tr>
                                    <th>Size</th>
                                    <td><span id="size_id"></span></td>
                                </tr>
                                <tr>
                                    <th>Total Amount</th>
                                    <td><span id="total_amount"></span></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><span id="address"></span></td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td><span id="state"></span></td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td><span id="city_id"></span></td>
                                </tr>
                                <tr>
                                    <th>Pincode</th>
                                    <td><span id="pin_no"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewPaymentModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Product Details</h5>
                    </div>
                    <form action="{{ route('order_list') }}">
                        @csrf
                        <input type="hidden" id="payment_id" name="id">
                        <input type="hidden" name="edit_payment" value="true">
                        <div class="modal-body">
                            <p>Cash Was received update this payment to the Customer</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary "> <i
                                    class="fa-solid fa-pen"></i> Update</button>
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
                ajax: "{{ route('order_list') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        className: 'text-center'
                    },
                    {
                        data: 'date',
                        name: 'date',
                        render: function(data) {
                            if (!data) return "-";
                            let dateObj = new Date(data);
                            return dateObj.toLocaleDateString('en-GB');
                        }

                    },
                    {
                        data: 'order_id',
                        name: 'order_id',

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
                        data: 'total_amount',
                        name: 'total_amount',

                    },
                    {
                        data: 'delivery_status',
                        name: 'delivery_status',
                        render: function(data, type, row) {
                            if (data == 'pending') {
                                return '<span class="badge bg-info">Pending</span>';
                            } else if (data == 'shipped') {
                                return '<span class="badge bg-warning">Shipping</span>'
                            } else if (data == 'out_for_delivery') {
                                return '<span class="badge bg-secondary">Out For Delivery</span>'
                            } else if (data == 'delivered') {
                                return '<span class="badge bg-success"> Delivered </span>'
                            } else {
                                return '<span class="badge bg-danger">Cancelled</span>';
                            }
                        }

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
                                return '<span  >Pay TM</span>'
                            } else if (data == 'netbanking') {
                                return '<span >Net Banking</span>'
                            } else if (data == 'card') {
                                return '<span >Card</span>'
                            } else if (data == 'cash_on_delivery') {
                                return '<span >Cash On Delivery</span>'
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


            $(document).on('click', '.EditStatusRow', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('order_list') }}",
                    method: "GET",
                    dataType: "json",
                    data: {
                        id: id,
                        get_status: true,
                    },
                    success: function(data) {
                        $('#edit_id').val(data.id);
                        if (data.delivery_status == 'pending') {
                            $('#pending').prop('checked', true);
                        } else if (data.delivery_status == 'shipped') {
                            $('#shipped').prop('checked', true);
                        } else if (data.delivery_status == 'out_for_delivery') {
                            $('#out_for_delivery').prop('checked', true);
                        } else if (data.delivery_status == 'delivered') {
                            $('#delivered').prop('checked', true);
                        } else if (data.delivery_status == 'cancelled') {
                            $('#cancelled').prop('checked', true);
                        }



                        $('#viewStateModal').modal('show');
                    }
                })
            });

            $(document).on('click', '.AddPaymentRow', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('order_list') }}",
                    method: "GET",
                    data: {
                        id: id,
                        get_payment: true,
                    },
                    success: function(data) {
                         $('#payment_id').val(data.id);
                        $('#viewPaymentModal').modal('show');
                    }
                });

            });

            $(document).on('click', '.ViewRow', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('order_list') }}",
                    method: "GET",
                    data: {
                        id: id,
                        get_view_item: true,
                    },
                    success: function(data) {
                        $('#date').text(data.date ?? "-");
                        $('#order_id').text(data.order_id ?? "-");
                        $('#product_id').text(data.get_product?.product_name ?? "-");
                        $('#category_id').text(data.get_product?.get_category?.name ?? "-");

                        if (data.get_product?.image_path) {
                            $('#product_images').html(`
                    <div class="col-md-3 mb-3">
                        <img src="/${data.get_product.image_path}" class="img-fluid rounded border" />
                    </div>
                `);
                        } else {
                            $('#product_images').html(
                                '<p class="text-muted">No Images Found</p>');
                        }

                        $('#price').text(data.get_product?.price ?? "-");
                        $('#size_id').text(data.get_size?.size_name ?? "-");
                        $('#quantity').text(data.quantity ?? "-");
                        $('#total_amount').text(data.total_amount ?? "-");
                        $('#address').text(data.address ?? "-");
                        $('#state').text(data.get_state?.state_name ?? "-");
                        $('#city_id').text(data.get_cities?.city_name ?? "-");
                        $('#pin_no').text(data.pincode ?? "-");

                        $('#viewModal').modal('show');
                    }
                });
            });




        });
    </script>
@endsection
