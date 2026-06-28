@extends('layouts.admin.default')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-transparent ">
                <h5> Ordered Cancelled Items Filter</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="order_no" class="form-label mb-1">Order No</label>
                        <input type="text" id="order_no" class="form-control" placeholder="Enter Order No">
                    </div>
                    <div class="col-md-4">
                        <label for="customer_name" class="form-label mb-1">Customer Name</label>
                        <input type="text" id="customer_name" class="form-control" placeholder="Enter Customer Name">
                    </div>
                    <div class="col-md-4">
                        <label for="payment_gateway" class="form-label mb-1">Payment Method</label>
                        <select id="payment_gateway" class="form-select">
                            <option value="">Select Payment Methods</option>
                            <option value="gpay">Google Pay</option>
                            <option value="phonepe">PhonePe</option>
                            <option value="paytm">Paytm</option>
                            <option value="cash_on_delivery">Cash On Delivery</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="payment_status" class="form-label mb-1">Payment Status</label>
                        <select id="payment_status" class="form-select">
                            <option value="">Select Payment Status</option>
                            <option value="pending">Pending</option>
                            <option value="success">Success</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="from_date" class="form-label mb-1">From Date</label>
                        <input type="text" id="from_date" class="form-control filter_date"
                            placeholder="Select From Date">
                    </div>
                    <div class="col-md-4">
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
                <h5>Ordered Cancelled list</h5>
                <div class="d-flex align-items-center gap-2 ms-auto">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="dropdown"> Download</button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="dropdown-item exportBtn" data-type="excel">Excel</a></li>
                            <li><a href="#" class="dropdown-item exportBtn" data-type="pdf">PDF </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Date</th>
                            <th>Order No</th>
                            <th>Customer Name</th>
                            <th>Grand Total</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Payment Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Offcanvas Customer Details -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="viewOrderCanvas" style="width: 600px">
            <div class="offcanvas-header">
                <h5>Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <a href="javascript:void(0)" id="invoiceBtn" class="btn btn-danger" style="border: 0">
                    Download Invoice
                </a>

                <!-- Customer Details -->
                <div class="card mt-3">
                    <div class="card-header">
                        <strong>Customer Details</strong>
                    </div>

                    <div class="card-body">
                        <p><b>Name :</b> <span id="view_customer_name"></span></p>
                        <p><b>Email :</b> <span id="customer_email"></span></p>
                        <p><b>Phone :</b> <span id="customer_phone"></span></p>
                    </div>
                </div>

                <!-- Address -->
                <div class="card mt-3">
                    <div class="card-header">
                        <strong>Delivery Address</strong>
                    </div>
                    <div class="card-body">
                        <p><b>Address :</b> <span id="address_line"></span></p>
                        <p><b>State :</b> <span id="state"></span></p>
                        <p><b>City :</b> <span id="city"></span></p>
                        <p><b>Pincode :</b> <span id="pincode"></span></p>
                    </div>
                </div>

                <!-- Products -->
                <div class="card mt-3">
                    <div class="card-header">
                        <strong>Products</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="product_table"></tbody>
                        </table>
                        <div class="text-end">
                            <strong>
                                Grand Total :
                                ₹<span id="grand_total"></span>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="refundModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Refund Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="refund_order_id">
                        <p class="text-center">
                            Are you sure you want to refund this payment?
                        </p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-success" id="confirmRefundBtn">
                            Refund Complete
                        </button>
                    </div>
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
                    url: "{{ route('order_cancelled') }}",
                    data: function(d) {
                        d.order_no = $('#order_no').val();
                        d.customer_name = $('#customer_name').val();
                        d.payment_status = $('#payment_status').val();
                        d.payment_gateway = $('#payment_gateway').val();
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
                        data: 'order_date',
                        name: 'order_date',
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
                        name: 'order_no',

                    },
                    {
                        data: 'customer_name',
                        name: 'customer_name',

                    },
                    {
                        data: 'grand_total',
                        name: 'grand_total',

                    },
                    {
                        data: 'get_payment.payment_status',
                        name: 'get_payment.payment_status',
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
                        data: 'get_payment.payment_gateway',
                        name: 'get_payment.payment_gateway',
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '5%',
                        className: 'text-center',

                    }
                ]
            });
            $('#filterBtn').click(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            $('#resetBtn').click(function() {
                $('#order_no').val('');
                $('#customer_name').val('');
                $('#payment_status').val('');
                $('#payment_gateway').val('');
                $('#from_date').val('');
                $('#to_date').val('');
                table.ajax.reload();
            });
        });

        $(document).on('click', '.ViewRow', function() {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('order_cancelled') }}",
                type: "GET",
                data: {
                    id: id,
                    get_view_item: true
                },
                success: function(data) {
                    // Customer
                    $('#view_customer_name').text((data.get_user?.first_name ?? '') + ' ' +(data.get_user?.last_name ?? ''));
                    $('#customer_email').text(data.get_user?.email ?? '-');
                    $('#customer_phone').text(data.get_user?.phone_no ?? '-');

                    // Address
                    $('#address_line').text((data.get_address?.address_line1 ?? '') + ' ' +(data.get_address?.address_line2 ?? ''));
                    $('#city').text(data.get_address?.get_city?.city_name ?? '-');
                    $('#state').text(data.get_address?.get_state?.state_name ?? '-');
                    $('#pincode').text(data.get_address?.pincode ?? '-');

                    // Products
                    let html = '';
                    $.each(data.get_orderitems, function(index, item) {
                        let image = '-';
                        if (item.get_product?.get_product_images?.image_path) {
                            image = `
                                <img
                                    src="/${item.get_product.get_product_images.image_path}"
                                    width="60"
                                    height="60"
                                    class="rounded border"
                                    style="object-fit:cover"
                                >
                            `;
                        }
                        html += `
                            <tr>
                                <td>${image}</td>
                                <td>${item.get_product?.product_name ?? '-'}</td>
                                <td>${item.get_size?.size_name ?? '-'}</td>
                                <td>${item.quantity}</td>
                                <td>${item.price}</td>
                                <td>${item.total_amount}</td>
                            </tr>
                        `;


                    });
                    $('#product_table').html(html);
                    $('#grand_total').text(data.grand_total);
                    // Invoice Bill
                    let invoiceUrl = "{{ route('order_list') }}" + "?id=" + data.id +
                        "&get_invoice_bill=true";
                    $('#invoiceBtn').attr('href', invoiceUrl);

                    // OPEN OFFCANVAS
                    let canvas = new bootstrap.Offcanvas(document.getElementById(
                        'viewOrderCanvas'));
                    canvas.show();
                }
            });

        });

        $(document).on('click', '.RefundRow, #confirmRefundBtn', function() {
            if ($(this).hasClass('RefundRow')) {
                $('#refund_order_id').val($(this).data('id'));
                $('#refundModal').modal('show');
                return;
            }

            $.ajax({
                url: "{{ route('order_cancelled') }}",
                type: "POST",
                data: {
                    refund_payment: true,
                    id: $('#refund_order_id').val(),
                    _token: "{{ csrf_token() }}"
                },

                success: function(res) {
                    $('#refundModal').modal('hide');
                    $('#modalMessage').text(res.message);
                    let modal = new bootstrap.Modal(
                        document.getElementById('sessionModal')
                    );
                    modal.show();
                    $('#datatable').DataTable().ajax.reload();
                }
            });
        });

        $(document).on('click', '.exportBtn', function(e) {
            e.preventDefault();
            let type = $(this).data('type');
            let order_no = $('#order_no').val();
            let customer_name = $('#customer_name').val();
            let payment_gateway = $('#payment_gateway').val();
            let payment_status = $('#payment_status').val();
            let from_date = $('#from_date').val();
            let to_date = $('#to_date').val();
            let url = "{{ route('order_cancelled.export') }}";
            window.location.href =
                url +
                '?type=' + type +
                '&order_no=' + encodeURIComponent(order_no || '') +
                '&customer_name=' + encodeURIComponent(customer_name || '') +
                '&payment_gateway=' + encodeURIComponent(payment_gateway || '') +
                '&payment_status=' + encodeURIComponent(payment_status || '') +
                '&from_date=' + encodeURIComponent(from_date || '') +
                '&to_date=' + encodeURIComponent(to_date || '');

        });
    </script>
@endsection
