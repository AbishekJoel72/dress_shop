@extends('layouts.user.default')
@section('content')
    <div class="container">
        <style>
            .checkout-card {
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
                background: #fff;
                margin-bottom: 20px;
            }

            .checkout-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid #e0e0e0;
                padding: 15px 20px;
                font-weight: 700;
                color: #212529;
                text-transform: uppercase;
                font-size: 0.9rem;
                letter-spacing: 0.5px;
            }

            .product-sidebar-img {
                max-width: 100%;
                max-height: 180px;
                object-fit: contain;
                display: block;
                margin: 0 auto 15px;
            }

            .payment-method-box {
                border: 1px solid #dee2e6;
                border-radius: 6px;
                padding: 15px;
                margin-bottom: 12px;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .payment-method-box:hover {
                border-color: #0d6efd;
                background-color: #f8f9ff;
            }

            .price-row {
                display: flex;
                justify-content: space-between;
                margin-bottom: 10px;
                font-size: 0.95rem;
            }

            .price-total {
                border-top: 1px dashed #dee2e6;
                padding-top: 12px;
                margin-top: 12px;
                font-weight: 700;
                font-size: 1.2rem;
            }

            .sticky-sidebar {
                position: sticky;
                top: 20px;
            }

            /* Quantity Button Controls */
            .qty-container {
                width: max-content;
                display: flex;
                align-items: center;
                justify-content: center;
                border: 1px solid #ced4da;
                border-radius: 4px;
                overflow: hidden;
                background: #fff;
            }

            .qty-btn {
                background: #212529;
                color: #fff;
                border: none;
                padding: 5px 12px;
                font-size: 1rem;
                font-weight: bold;
                cursor: pointer;
                transition: background 0.2s;
                height: 31px;
                display: flex;
                align-items: center;
            }

            .qty-btn:hover {
                background: #e9ecef;
                color: #212529;
            }

            .qty-input {
                width: 45px;
                border: none;
                text-align: center;
                font-weight: bold;
                font-size: 0.95rem;
                height: 31px;
                -moz-appearance: textfield;
            }

            .qty-input::-webkit-outer-spin-button,
            .qty-input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>

        <form action="{{ route('order') }}" method="POST" id="orderForm">
            @csrf
            <input type="hidden" name="order_items" value="true">

            <input type="hidden" name="product_id" id="product_id" required value="{{ $product_items->id }}">
            <input type="hidden" name="date" id="date" required value="{{ date('Y-m-d') }}">
            <input type="hidden" name="price" id="price" value="{{ $product_items->price }}"
                oninput="addcalculation()">
            <input type="hidden" name="discount" id="discount" value="{{ $product_items->discount_price }}"
                oninput="addcalculation()">


            <div class="row g-4">
                <div class="col-lg-8">

                    <div class="checkout-card">
                        <div class="checkout-header">
                            <span class="badge bg-primary rounded-circle me-2">1</span> Delivery Address
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label for="address" class="form-label fw-semibold">Address 1 <span
                                            class="text-danger small">*</span></label>
                                    <textarea name="address" id="address" class="form-control" placeholder="Address 1" required style="height: 100px">{{ $address->address_line1 ?? '' }}</textarea>
                                </div>
                                <div class="col-6">
                                    <label for="address2" class="form-label fw-semibold">Address 2 <span
                                            class="text-muted small">(Optional)</span></label>
                                    <textarea name="address2" id="address2" class="form-control" placeholder="Address 2" style="height: 100px">{{ $address->address_line2 ?? '' }}</textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="state_id" class="form-label fw-semibold">State</label>
                                    <select name="state_id" id="state_id" required class="form-select select2">
                                        <option value="" selected disabled>Select State</option>
                                        @foreach ($state as $s)
                                            <option value="{{ $s->id }}"
                                                {{ isset($address) && $address->state_id == $s->id ? 'selected' : '' }}>
                                                {{ $s->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="city_id" class="form-label fw-semibold">City</label>
                                    <select name="city_id" id="city_id" required class="form-select select2">
                                        <option value="" selected disabled>Select City</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="pincode" class="form-label fw-semibold">Pincode</label>
                                    <input type="number" name="pincode" id="pincode" class="form-control"
                                        value="{{ $address->pincode ?? '' }}" placeholder="Pincode" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-card">
                        <div class="checkout-header">
                            <span class="badge bg-primary rounded-circle me-2">2</span> Select Payment Method
                        </div>
                        <div class="card-body p-4">
                            <div class="payment-options">
                                <label for="gpay" class="payment-method-box d-flex align-items-center w-100">
                                    <input type="radio" name="payment_gateway" id="gpay" value="gpay"
                                        class="form-check-input me-3" required>
                                    <div>
                                        <span class="fw-bold d-block">Google Pay (UPI)</span>
                                        <small class="text-muted">Pay instantly using your UPI app</small>
                                    </div>
                                </label>

                                <label for="phonepe" class="payment-method-box d-flex align-items-center w-100">
                                    <input type="radio" name="payment_gateway" id="phonepe" value="phonepe"
                                        class="form-check-input me-3" required>
                                    <div>
                                        <span class="fw-bold d-block">PhonePe</span>
                                        <small class="text-muted">Fast and secure checkout via PhonePe</small>
                                    </div>
                                </label>

                                <label for="paytm" class="payment-method-box d-flex align-items-center w-100">
                                    <input type="radio" name="payment_gateway" id="paytm" value="paytm"
                                        class="form-check-input me-3" required>
                                    <div>
                                        <span class="fw-bold d-block">Paytm Wallet / UPI</span>
                                        <small class="text-muted">Pay using linked Paytm wallet or UPI</small>
                                    </div>
                                </label>
                                <label for="cod" class="payment-method-box d-flex align-items-center w-100">
                                    <input type="radio" name="payment_gateway" id="cod" value="cash_on_delivery"
                                        class="form-check-input me-3" required>
                                    <div>
                                        <span class="fw-bold d-block">Cash on Delivery</span>
                                        <small class="text-muted">Pay when you receive the product</small>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="d-none">
                        <button type="submit" id="hiddenSubmitBtn"></button>
                        <button type="reset" id="hiddenResetBtn"></button>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="sticky-sidebar">

                        <div class="checkout-card ">
                            <div class="card-body p-4 text-center">
                                <img src="{{ asset($product_items->get_product_images->image_path) }}"
                                    alt="Product Image" class="product-sidebar-img img-fluid rounded">
                                <h6 class="fw-bold text-start text-dark mb-1">{{ $product_items->product_name }}</h6>
                                <p class="text-muted text-start small mb-3">Category:
                                    {{ $product_items->get_category->name }}</p>

                                <div class="text-start mb-3">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#descModal"
                                        class="text-decoration-none small text-primary fw-semibold">
                                        <i class="fa-solid fa-circle-info"></i> View Full Description
                                    </a>
                                </div>

                                <div class="row g-2 text-start align-items-end">
                                    <div class="col-6">
                                        <label class="form-label small fw-semibold text-secondary mb-1">Quantity</label>
                                        <div class="qty-container">
                                            <button type="button" class="qty-btn" onclick="decrementQty()">-</button>
                                            <input type="number" name="quantity" id="quantity" value="1"
                                                min="1" class="qty-input" oninput="addcalculation()" readonly>
                                            <button type="button" class="qty-btn" onclick="incrementQty()">+</button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="size_id"
                                            class="form-label small fw-semibold text-secondary mb-1">Size</label>
                                        <select name="size_id" id="size_id" required class="form-select form-select-sm"
                                            style="height: 31px;">
                                            <option value="" selected disabled>Size</option>
                                            @foreach ($size as $s)
                                                <option value="{{ $s->id }}">{{ $s->size_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="checkout-card shadow-sm">
                            <div class="checkout-header bg-white text-secondary fw-bold"
                                style="border-bottom: 1px dashed #dee2e6;">
                                Price Details
                            </div>
                            <div class="card-body p-3">
                                <div class="price-row">
                                    <span class="text-muted">Price (<span id="summary-qty">1</span> item)</span>
                                    <span>₹{{ number_format($product_items->price, 2) }}</span>
                                </div>
                                <div class="price-row">
                                    <span class="text-muted">Discount</span>
                                    <span class="text-danger">-
                                        ₹{{ number_format($product_items->discount_price, 2) }}</span>
                                </div>
                                <div class="price-row">
                                    <span class="text-muted">Delivery Charges</span>
                                    <span class="text-success">FREE</span>
                                </div>

                                <div class="price-total d-flex justify-content-between align-items-center">
                                    <span>Total Amount</span>
                                    <div class="d-flex align-items-center">
                                        {{-- <span class="text-dark fw-bold me-1">₹</span> --}}
                                        <input type="text" name="total_amount" id="total_amount"
                                            class="fw-bold text-end border-0 p-0 text-dark bg-transparent"
                                            style="width: 120px; font-size: 1.25rem;" readonly>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="button"
                                        class="btn btn-warning w-100 py-2.5  text-dark shadow-sm rounded" id="payment">
                                        Proceed to Checkout
                                    </button>

                                    <button type="button" class="btn btn-light w-100 mt-2 btn  border-0 sm text-muted"
                                        onclick="window.location.href='{{ route('product_list') }}';">
                                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Product List
                                    </button>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="descModal" tabindex="-1" aria-labelledby="descModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fw-bold" id="descModalLabel">Product Description</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            {{ $product_items->description }}
                        </div>
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
        </form>
    </div>
    @include('layouts.user.footer')
@endsection

@section('script')
    @include('layouts.datatable')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select  option",
                width: '100%'
            });
        });

        // Quantity Increase Function
        function incrementQty() {
            let qtyInput = document.getElementById("quantity");
            let currentVal = parseInt(qtyInput.value) || 1;
            qtyInput.value = currentVal + 1;
            addcalculation();
        }

        // Quantity Decrease Function
        function decrementQty() {
            let qtyInput = document.getElementById("quantity");
            let currentVal = parseInt(qtyInput.value) || 1;
            if (currentVal > 1) {
                qtyInput.value = currentVal - 1;
                addcalculation();
            }
        }

        function addcalculation() {
            let price = parseFloat(document.getElementById("price").value) || 0;
            let discount = parseFloat(document.getElementById("discount").value) || 0;
            let quantity = parseFloat(document.getElementById("quantity").value) || 1;
            document.getElementById("summary-qty").innerText = quantity;
            let netprice = price - discount;
            if (netprice < 0) {
                netprice = 0;
            }
            let amt = netprice * quantity;
            document.getElementById("total_amount").value = amt.toFixed(2);
        }
        addcalculation();

        $(document).ready(function() {
            $('#state_id').on('change', function() {
                var stateID = $(this).val();
                if (stateID) {
                    $.ajax({
                        url: '{{ route('order') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            stateID: stateID,
                            get_city: true,
                        },
                        success: function(data) {
                            $('#city_id').empty();
                            $('#city_id').append(
                                '<option value="" selected disabled>Select City</option>');
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
                if (!document.getElementById('orderForm').checkValidity()) {
                    document.getElementById('orderForm').reportValidity();
                    return;
                }
                var gateway = $("input[name='payment_gateway']:checked").val();
                var amount = $("#total_amount").val();
                var productName = "{{ $product_items->product_name }}";
                var quantity = $("#quantity").val();
                var size = $("#size_id option:selected").text();
                var address = $("#address").val();
                var address2 = $("#address2").val();
                var pincode = $("#pincode").val();
                var state = $("#state_id option:selected").text();
                var city = $("#city_id option:selected").text();

                let modalBody = `
                    <div class="text-center mb-4">
                        <i class="fa-solid fa-circle-check text-success fa-3x mb-2"></i>
                        <h5 class="text-success fw-bold">₹ ${amount}</h5>
                        <p class="text-muted small">Final payable amount including discounts</p>
                    </div>

                    <table class="table table-sm table-borderless border-top pt-2"">
                        <tr>
                            <th>Product</th>
                            <td>${productName}</td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td>${quantity}</td>
                        </tr>
                        <tr>
                            <th>Size</th>
                            <td>${size}</td>
                        </tr>
                        <tr>
                            <th>Payment Mode</th>
                            <td>${gateway.toUpperCase()}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>₹ ${amount}</td>
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
                var myModal = new bootstrap.Modal(document.getElementById('paymentModal'));
                myModal.show();
            });
        });
    </script>
@endsection
