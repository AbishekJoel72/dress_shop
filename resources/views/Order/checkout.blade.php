@extends('layouts.user.default')
@section('content')
    <style>
        .payment-method-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            transition: border-color 0.2s, background-color 0.2s;
        }

        .payment-method-box:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }

        .payment-method-box input[type="radio"] {
            margin-right: 10px;
        }
    </style>
    <div class="container">
        {{-- <h2 class="mb-4 fw-normal text-dark border-bottom pb-3">Checkout</h2> --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold mb-0">Checkout</h3>

            @if (count($cart) > 0)
                <a href="{{ route('cart') }}" class="btn btn-outline-dark">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            @endif

        </div>
        <form action="{{ route('checkout') }}" method="POST" id="orderForm">
            @csrf
            <input type="hidden" name="cart_items" value="true">

            <div class="row">
                <div class="col-lg-8 mb-5">
                    <div class="card shadow-sm p-4 mb-3 border-0 rounded-3 bg-white">
                        <div class="card-header bg-transparent border-0 p-0 mb-3">
                            <h5 class="fw-bold text-dark"><span class="text-secondary me-2">1</span> Shipping Address</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="address" class="form-label fw-semibold">Address 1 <span
                                            class="text-danger small">*</span></label>
                                    <textarea name="address" id="address" class="form-control" placeholder="Address 1" required style="height: 100px;">{{ $address->address_line1 ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="address2" class="form-label fw-semibold">Address 2 <span
                                            class="text-muted small">(Optional)</span></label>
                                    <textarea name="address2" id="address2" rows="3" maxlength="100" class="form-control" placeholder="Address 2"
                                        style="height: 100px;">{{ $address->address_line2 ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label for="state_id" class="form-label fw-semibold">State</label>
                                    <select name="state_id" id="state_id" class="form-select select2" required>
                                        <option value="" selected disabled>Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ isset($address) && $address->state_id == $state->id ? 'selected' : '' }}>
                                                {{ $state->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="city_id" class="form-label fw-semibold">City</label>
                                    <select name="city_id" id="city_id" class="form-select select2" required>
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="pincode" class="form-label fw-semibold">Pin Code</label>
                                    <input type="text" name="pincode" id="pincode" class="form-control"
                                        value="{{ $address->pincode ?? '' }}" placeholder="Pin Code" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm p-4 mb-3 border-0 rounded-3 bg-white">
                        <div class="card-header bg-transparent border-0 p-0 mb-3">
                            <h5 class="fw-bold text-dark"><span class="text-secondary me-2">2</span> Payment Method</h5>
                        </div>
                        <div class="card-body">
                            <div class="payment-options">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="gpay" class="payment-method-box d-flex align-items-center ">
                                            <input type="radio" name="payment_gateway" id="gpay" value="gpay"
                                                class="form-check-input me-3" required>
                                            <div>
                                                <span class="fw-bold d-block">Google Pay (UPI)</span>
                                                <small class="text-muted">Pay instantly using your UPI app</small>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label for="phonepe" class="payment-method-box d-flex align-items-center ">
                                            <input type="radio" name="payment_gateway" id="phonepe" value="phonepe"
                                                class="form-check-input me-3" required>
                                            <div>
                                                <span class="fw-bold d-block">PhonePe</span>
                                                <small class="text-muted">Fast and secure checkout via PhonePe</small>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label for="paytm" class="payment-method-box d-flex align-items-center ">
                                            <input type="radio" name="payment_gateway" id="paytm" value="paytm"
                                                class="form-check-input me-3" required>
                                            <div>
                                                <span class="fw-bold d-block">Paytm Wallet / UPI</span>
                                                <small class="text-muted">Pay using linked Paytm wallet or UPI</small>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label for="cod" class="payment-method-box d-flex align-items-center">
                                            <input type="radio" name="payment_gateway" id="cod"
                                                value="cash_on_delivery" class="form-check-input me-3" required>
                                            <div>
                                                <span class="fw-bold d-block">Cash on Delivery</span>
                                                <small class="text-muted">Pay when you receive the product</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm p-4 border-0 rounded-3 bg-white">
                        <h5 class="fw-bold text-dark mb-3"><span class="text-secondary me-2">3</span> Review Items and
                            Delivery</h5>

                        <div class="border rounded p-3 bg-light mb-3">
                            <span class="text-success fw-bold small"><i class="fa fa-truck me-1"></i> Your order qualifies
                                for FREE Delivery.</span>
                        </div>

                        <div class="ps-md-2">
                            @php $grandTotal = 0; @endphp
                            @foreach ($cart as $item)
                                <input type="hidden" name="product_id[]" value="{{ $item->product_id }}">
                                <input type="hidden" name="size_id[]" value="{{ $item->size_id }}">
                                <input type="hidden" name="quantity[]" value="{{ $item->quantity }}">
                                <input type="hidden" name="price[]" value="{{ $item->price }}">
                                <input type="hidden" name="discount[]" value="{{ $item->discount_price }}">

                                @php
                                    $price =
                                        $item->discount_price > 0 ? $item->price - $item->discount_price : $item->price;

                                    $total = $price * $item->quantity;
                                    $grandTotal += $total;
                                @endphp

                                <div class="row align-items-center py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <div class="col-3 col-md-2 text-center">
                                        <img src="{{ asset($item->get_product->get_product_images->image_path) }}"
                                            class="img-fluid rounded" style="max-height: 80px; object-fit: contain;">
                                    </div>
                                    <div class="col-9 col-md-7">
                                        <h6 class="fw-bold mb-1 text-dark">{{ $item->get_product->name }}</h6>
                                        <p class="text-danger small fw-bold mb-1">₹
                                            {{ number_format($item->price, 2) }}
                                        </p>
                                        <span class="badge bg-secondary-subtle text-dark border small">Qty:
                                            {{ $item->quantity }}</span>

                                        <span class="badge bg-secondary-subtle text-dark border small">Size:
                                            {{ $item->get_size->size_name }}</span>

                                    </div>
                                    <div class="col-12 col-md-3 text-md-end mt-2 mt-md-0">
                                        <span class="text-dark small d-block">Subtotal</span>
                                        <span class="fw-bold text-dark">₹ {{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            @endforeach
                            <input type="hidden" name="total_amount" value="{{ $grandTotal }}">
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 ">
                    <div class="card shadow-sm border p-4 bg-white position-sticky rounded-3"
                        style="top: 170px; border-color: #ddd !important;">
                        <button type="submit" id="payment"
                            class="btn btn-warning w-100 py-2.5 rounded-3 fw-bold shadow-sm text-dark border-0 mb-3"
                            style="background-color: #ffd814; transition: background 0.2s;"
                            onmouseover="this.style.backgroundColor='#f7ca00'"
                            onmouseout="this.style.backgroundColor='#ffd814'">
                            Place Your Order
                        </button>


                        <p class="text-muted text-center" style="font-size: 11px; line-height: 1.4;">
                            By placing your order, you agree to our privacy notice and conditions of use.
                        </p>

                        <hr class="my-3">

                        <h5 class="fw-bold mb-3 text-dark small text-uppercase tracking-wider">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-2 small text-dark">
                            <span>Items ({{ count($cart) }}):</span>
                            <span>₹ {{ number_format($grandTotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 small text-dark">
                            <span>Delivery:</span>
                            <span class="text-success fw-bold">FREE Shipping</span>
                        </div>

                        <hr class="my-2">

                        <div class="d-flex justify-content-between align-items-center my-3">
                            <span class="h5 fw-bold text-dark mb-0">Order Total:</span>
                            <span class="h4 fw-bold text-danger mb-0">₹ {{ number_format($grandTotal, 2) }}</span>
                        </div>

                        <div class="p-2 rounded small text-muted bg-light border d-flex align-items-center"
                            style="font-size: 12px;">
                            <i class="fa fa-lock text-success me-2 fs-5"></i>
                            <span>Secure transaction. Your personal and financial information is fully
                                protected.</span>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold text-dark">Confirm Your Order</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4"></div>
                            <div class="modal-footer bg-light text-center">
                                <button type="button" class="btn btn-success px-4 fw-semibold"
                                    onclick="document.getElementById('orderForm').submit();">
                                    <i class="fa-solid fa-check me-1"></i> Place Order
                                </button>
                                <button type="button" class="btn btn-danger px-4 fw-semibold"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('layouts.user.footer')
@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select  option",
                width: '100%'
            });
        });

        $('#state_id').on('change', function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: '{{ route('checkout') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        stateID: stateID,
                        get_city: true,
                    },
                    success: function(data) {
                        $('#city_id').empty();
                        $('#city_id').append('<option value="" selected disabled>Select City</option>');
                        var selectedCity = '{{ $address->city_id ?? '' }}';
                        $.each(data, function(key, value) {
                            var selected = '';
                            if (selectedCity == value.id) {
                                selected = 'selected';
                            }
                            $('#city_id').append('<option value="' + value.id +
                                '" ' + selected + '>' + value.city_name +
                                '</option>');
                        });
                        $('#city_id').trigger('change');
                    }
                });
            } else {
                $('#city_id').empty();
                $('#city_id').append('<option value="" selected disabled>Select City</option>');
            }
        });
        if ($('#state_id').val()) {
            $('#state_id').trigger('change');
        }
        
        $(document).on("click", "#payment", function(e) {
            e.preventDefault();
            // let form = $('form')[0];
            let form = document.getElementById('orderForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            var gateway = $("input[name='payment_gateway']:checked").val();
            if (!gateway) {
                alert('Please select a payment method.');
                return;
            }
            var address = $("#address").val();
            var address2 = $("#address2").val();
            var pincode = $("#pincode").val();
            var state = $("#state_id option:selected").text();
            var city = $("#city_id option:selected").text();

            let productsHtml = '';
            let grandTotal = 0;

            @foreach ($cart as $item)
                productsHtml += `
            <tr>
                <td>{{ $item->get_product->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->get_size->size_name ?? '' }}</td>
                <td>₹ {{ number_format(($item->discount_price > 0 ? $item->price - $item->discount_price : $item->price) * $item->quantity, 2) }}</td>
            </tr>
        `;

                grandTotal +=
                    {{ ($item->discount_price > 0 ? $item->price - $item->discount_price : $item->price) * $item->quantity }};
            @endforeach

            let modalBody = `
        <div class="text-center mb-3">
            <h4 class="text-success">₹ ${grandTotal.toFixed(2)}</h4>
            <p class="text-muted">Final Payable Amount</p>
        </div>

        <h6 class="fw-bold">Products</h6>

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Size</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                ${productsHtml}
            </tbody>
        </table>

        <table class="table table-sm">
            <tr>
                <th>Payment Mode</th>
                <td>${gateway.toUpperCase()}</td>
            </tr>
            <tr>
                <th>Delivery Address</th>
                <td>
                    ${address}<br>
                    ${address2 ? address2 + '<br>' : ''}
                    ${city}, ${state} - ${pincode}
                </td>
            </tr>
        </table>
    `;

            $("#paymentModal .modal-body").html(modalBody);

            let myModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            myModal.show();
        });
    </script>
@endsection
@endsection
