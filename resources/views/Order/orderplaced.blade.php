@extends('layouts.user.default')
@section('content')
    <style>
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 8px;
            font-size: 2rem;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #d3d3d3;
            cursor: pointer;
            transition: .2s;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffb400;
        }

        .star-rating input:checked~label {
            color: #ffb400;
        }
    </style>

    <div class="container-fluid">
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
                            <th>Order Date</th>
                            <th>Order NO</th>
                            <th>No. of Items</th>
                            <th>Delivery Charges</th>
                            <th>Grand amount</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>View Items</th>
                            <th>Payment</th>
                            <th>Cancel Order</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="viewCanvas" style="width: 600px">
            <div class="offcanvas-header">
                <h5>Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas">
                </button>
            </div>
            <div class="offcanvas-body">
                <p>
                    <strong>Date :</strong>
                    <span id="date"></span>

                </p>
                <p>
                    <strong>Order No :</strong>
                    <span id="order_id"></span>
                </p>
                <p>
                    <strong>Address :</strong>
                    <span id="address"></span>
                </p>
                <p>
                    <strong>State :</strong>
                    <span id="state"></span>
                </p>
                <p>
                    <strong>City :</strong>
                    <span id="city_id"></span>
                </p>
                <p>
                    <strong>Pincode :</strong>
                    <span id="pin_no"></span>
                </p>
                <hr>
                <h6>Products</h6>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Size</th>
                            <th>Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="product_list"></tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" id="PaymentModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"> </button>
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
                                    <th>Transaction ID</th>
                                    <td><span id="transaction_id"></span></td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td> <span id="amount"></span></td>
                                </tr>
                                <tr>
                                    <th>Currency</th>
                                    <td><span id="currency"></span></td>
                                </tr>
                                <tr>
                                    <th>Payment Status</th>
                                    <td> <span id="payment_status"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="feedbackModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Product Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="feedback_order_id">
                        <input type="hidden" id="feedback_product_id">
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5">
                                <label for="star5"><i class="fa fa-star"></i></label>
                                <input type="radio" id="star4" name="rating" value="4">
                                <label for="star4"><i class="fa fa-star"></i></label>
                                <input type="radio" id="star3" name="rating" value="3">
                                <label for="star3"> <i class="fa fa-star"></i></label>
                                <input type="radio" id="star2" name="rating" value="2">
                                <label for="star2"><i class="fa fa-star"></i></label>
                                <input type="radio" id="star1" name="rating" value="1">
                                <label for="star1"><i class="fa fa-star"></i></label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Feedback</label>
                            <textarea id="feedback" class="form-control" style="height:150px" placeholder="Write your feedback"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" id="saveFeedbackBtn" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="returnModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Return Product</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="return_order_id">
                        <input type="hidden" id="return_order_item_id">
                        <div class="mb-3">
                            <label>Reason</label>
                            <select class="form-control" id="return_reason">
                                <option value="">Select</option>
                                <option value="damaged">Damaged</option>
                                <option value="wrong_product"> Wrong Product</option>
                                <option value="size_issue"> Size Issue</option>
                                <option value="quality_issue">Quality Issue</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Remarks</label>
                            <textarea class="form-control" id="remarks"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="saveReturnBtn">Submit</button>
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
                        data: 'order_date',
                        name: 'order_date',
                        render: function(data) {
                            if (!data) return '-';
                            let dateObj = new Date(data);
                            let day = String(dateObj.getDate()).padStart(2, '0');
                            let month = String(dateObj.getMonth() + 1).padStart(2, '0');
                            let year = dateObj.getFullYear();
                            return `${day}-${month}-${year}`;
                        }
                    },
                    {
                        data: 'order_no',
                        name: 'order_no',

                    },
                    {

                        data: 'items_count',
                        name: 'items_count',
                    },
                    {
                        data: 'delivery_charge',
                        name: 'delivery_charge',

                    },
                    {
                        data: 'grand_total',
                        name: 'grand_total',

                    },
                    {
                        data: 'payment_gateway',
                        name: 'payment_gateway',
                        render: function(data, type, row) {

                            if (data == 'gpay') {
                                return '<span>Google Pay</span>';
                            } else if (data == 'phonepe') {
                                return '<span>Phone Pe</span>';
                            } else if (data == 'paytm') {
                                return '<span>PAYTM</span>'
                            } else {
                                return '<span>Cash On Delivery</span>';
                            }
                        }
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                        render: function(data, type, row) {
                            if (data == 'pending') {
                                return '<span class="badge bg-info">Pending</span>';
                            } else if (data == 'success') {
                                return '<span class="badge bg-success">Sucess</span>';
                            } else if (data == 'failed') {
                                return '<span class="badge bg-danger">Failed</span>'
                            } else {
                                return '<span class="badge bg-warning">Refunded</span>';
                            }
                        }

                    },
                    {
                        data: 'delivery_status',
                        name: 'delivery_status',
                        render: function(data, type, row) {
                            if (data == 'pending') {
                                return '<span class="badge bg-info">Pending</span>';
                            } else if (data == 'confirmed') {
                                return '<span class="badge bg-primary">Confirmed</span>';
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
                        data: 'view_btn',
                        name: 'view_btn',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'payment_btn',
                        name: 'payment_btn',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'cancel_btn',
                        name: 'cancel_btn',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'feedback_btn',
                        name: 'feedback_btn',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
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
                    if (data.order_date) {
                        let dateObj = new Date(data.order_date);
                        let day = String(dateObj.getDate()).padStart(2, '0');
                        let month = String(dateObj.getMonth() + 1).padStart(2, '0');
                        let year = dateObj.getFullYear();
                        $('#date').text(`${day}-${month}-${year}`);
                    } else {
                        $('#date').text('-');
                    }
                    $('#order_id').text(data.order_no ?? '-');
                    $('#address').text(data.get_address?.address_line1 ?? '-');
                    $('#state').text(data.get_address?.get_state?.state_name ?? '-');
                    $('#city_id').text(data.get_address?.get_city?.city_name ?? '-');
                    $('#pin_no').text(data.get_address?.pincode ?? '-');
                    let html = '';

                    data.get_orderitems.forEach(function(item) {
                        let returnBtn = '-';
                        if (data.delivery_status == 'delivered') {
                            returnBtn = `
                                <button class="btn btn-sm btn-warning returnRow"
                                    data-order-id="${data.id}"
                                    data-order-item-id="${item.id}">
                                    Return
                                </button>
                            `;
                        }
                        html += `
                            <tr>
                                <td>
                                    <img src="/${item.get_product?.get_product_images?.image_path}" width="60">
                                </td>
                                <td>
                                    ${item.get_product?.product_name ?? '-'}
                                </td>
                                <td>
                                    ${item.get_size?.size_name ?? '-'}
                                </td>
                                <td>
                                    ${item.quantity}
                                </td>
                                <td>
                                    ${returnBtn}
                                </td>
                            </tr>
                        `;
                    });
                    $('#product_list').html(html);
                    let offcanvas = new bootstrap.Offcanvas(
                        document.getElementById('viewCanvas')
                    );
                    offcanvas.show();
                }

            });
        });

        $(document).on('click', '.PaymentRow', function() {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('order_placed') }}",
                method: "GET",
                data: {
                    id: id,
                    get_payment_list: true,
                },
                success: function(data) {
                    if (data.get_payment) {
                        if (data.get_payment.paid_at) {
                            let dateObj = new Date(data.get_payment.paid_at);
                            let day = String(dateObj.getDate()).padStart(2, '0');
                            let month = String(dateObj.getMonth() + 1).padStart(2, '0');
                            let year = dateObj.getFullYear();
                            let formattedDate = `${day}-${month}-${year}`;
                            $('#paid_at').text(formattedDate);
                        } else {
                            $('#paid_at').text('-');
                        }
                        let gateway = data.get_payment?.payment_gateway;
                        $('#payment_gateway').text(
                            gateway == 'gpay' ? 'Google Pay' :
                            gateway == 'phonepe' ? 'PhonePe' :
                            gateway == 'paytm' ? 'PAYTM' :
                            'Cash On Delivery'
                        );
                        $('#transaction_id').text(data.get_payment.transaction_id ?? '-');
                        $('#amount').text(data.get_payment.amount ?? '-');
                        $('#currency').text(data.get_payment.currency ?? '-');
                        $('#payment_status').text(data.get_payment.payment_status
                            ?.toUpperCase() ?? '-');
                    }
                    $('#PaymentModal').modal('show');
                }
            });
        });


        $(document).on('click', '.feedbackRow', function() {
            let orderId = $(this).data('id');
            $.ajax({
                url: "{{ route('order_placed') }}",
                type: "GET",
                data: {
                    id: orderId,
                    get_view_item: true
                },

                success: function(data) {
                    let productId = data.get_orderitems[0].product_id;
                    $('#feedback_order_id').val(orderId);
                    $('#feedback_product_id').val(productId);
                    $('input[name="rating"]').prop('checked', false);
                    $('#feedback').val('');
                    $('#feedbackModal').modal('show');

                }

            });

        });

        $(document).on('click', '#saveFeedbackBtn', function() {
            $.ajax({
                url: "{{ route('order_placed') }}",
                type: "POST",
                data: {
                    id: $('#feedback_order_id').val(),
                    product_id: $('#feedback_product_id').val(),
                    rating: $('input[name="rating"]:checked').val(),
                    feedback: $('#feedback').val(),
                    give_feedback: true,
                    _token: "{{ csrf_token() }}"
                },

                success: function(res) {
                    $('#feedbackModal').modal('hide');
                    $('#modalMessage').text(res.message);
                    let modal = new bootstrap.Modal(
                        document.getElementById('sessionModal')
                    );
                    modal.show();

                    $('#datatable').DataTable().ajax.reload();
                }

            });

        });


        $(document).on('click', '.deleteRow', function() {
            let id = $(this).data('id');
            showConfirm(messages.delete_confirm, function() {
                $.ajax({
                    url: "{{ route('order_placed') }}",
                    type: "DELETE",
                    data: {
                        id: id,
                        delete_order: true,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        if (res.status) {
                            $('#modalMessage').text(res.message);
                            $('#sessionModal .modal-content')
                                .removeClass('border-danger')
                                .addClass('border-success');
                        } else {
                            $('#modalMessage').text(res.message);
                            $('#sessionModal .modal-content')
                                .removeClass('border-success')
                                .addClass('border-danger');
                        }

                        let modal = new bootstrap.Modal(
                            document.getElementById('sessionModal')
                        );

                        modal.show();
                        $('#sessionModal').on('hidden.bs.modal', function() {
                            $('#datatable').DataTable().ajax.reload();
                        });

                    },
                    error: function() {
                        $('#modalMessage').text('Something went wrong');
                        $('#sessionModal .modal-content')
                            .removeClass('border-success')
                            .addClass('border-danger');
                        let modal = new bootstrap.Modal(
                            document.getElementById('sessionModal')
                        );
                        modal.show();
                    }

                });

            });

        });

        $(document).on('click', '.returnRow', function() {

            $('#return_order_id').val($(this).data('order-id'));

            $('#return_order_item_id').val($(this).data('order-item-id'));

            $('#return_reason').val('');

            $('#remarks').val('');

            $('#returnModal').modal('show');

        });

        $(document).on('click', '#saveReturnBtn', function() {

            $.ajax({

                url: "{{ route('order_placed') }}",

                type: "POST",

                data: {
                    order_id: $('#return_order_id').val(),
                    order_item_id: $('#return_order_item_id').val(),
                    reason: $('#return_reason').val(),
                    remarks: $('#remarks').val(),
                    save_return: true,
                    _token: "{{ csrf_token() }}"
                },

                success: function(res) {

                    $('#returnModal').modal('hide');

                    $('#datatable').DataTable().ajax.reload();

                }

            });

        });
    </script>
@endsection
