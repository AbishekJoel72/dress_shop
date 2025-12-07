@extends('layouts.user.default')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header bg-transparent d-flex justify-content-between align-items-center py-2">
                <h5 class="mb-0">Ordered List</h5>
                <a href="{{ route('product_list') }}" class="btn btn-sm btn-primary">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
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

        <div class="modal fade" id="PaymentModal" tabindex="-1" aria-hidden="true">
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
                                    <td><span id="paid_at"></span></td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td><span id="payment_gateway"></span></td>
                                </tr>
                                <tr>
                                    <th>Card Type</th>
                                    <td><span id="card_type"></span></td>
                                </tr>
                                <tr>
                                    <th>Transaction ID</th>
                                    <td><span id="transaction_id"></span></td>
                                </tr>
                                <tr>
                                    <th>Currency</th>
                                    <td><span id="currency"></span></td>
                                </tr>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    @include('layouts.user.footer')
@endsection
@section('script')
    @include('layouts.datatable')
    <script>
        $(document).ready(function() {

            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('order_placed') }}",

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
                        render: function(data,type, row) {
                            if(data == 'gpay'){
                                 return '<span  >G Pay</span>';
                            }else if (data == 'phonepe') {
                                return '<span >Phonepe</span>'
                            }
                            else if (data == 'paytm') {
                                return '<span >Pay TM</span>'
                            }
                            else if (data == 'netbanking') {
                                return '<span>Net Banking</span>'
                            }
                            else if (data == 'card') {
                                return '<span >Card</span>'
                            }
                            else if (data == 'cash_on_delivery') {
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


            $(document).on('click', '.ViewRow', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('order_placed') }}",
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

            $(document).on('click', '.PaymentRow', function() {

                let id = $(this).data('id');
                // console.log(id);

                $.ajax({
                    url: "{{ route('order_placed') }}",
                    method: "GET",
                    data: {
                        id: id,
                        get_payment_list: true,
                    },
                    success: function(data) {
                        if (data.get_payment?.paid_at) {
                            let dateObj = new Date(data.get_payment.paid_at);
                            let formattedDate = dateObj.toLocaleDateString(
                                'en-GB');
                            $('#paid_at').text(formattedDate);
                        } else {
                            $('#paid_at').text("-");
                        }
                        $('#payment_gateway').text(
                            data.get_payment?.payment_gateway ?
                            data.get_payment.payment_gateway.toUpperCase() :
                            "-"
                        );
                        if (data.get_payment?.card_type) {
                            $('#card_type').closest('tr').show();
                            $('#card_type').text(data.get_payment.card_type ?
                                data.get_payment.card_type.toUpperCase() : "-"
                            );
                        } else {
                            $('#card_type').closest('tr').hide();
                        }
                        $('#transaction_id').text(data.get_payment.transaction_id ?? "-");
                        $('#currency').text(data.get_payment.currency ?? "-");
                        $("#PaymentModal").modal("show");
                    }

                });
            });


            $(document).on('click', '.deleteRow', function() {
                let id = $(this).data('id');
                $.ajax({
                    url: "{{ route('order_placed') }}",
                    type: "DELETE",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}",
                        delete_order: true,
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
