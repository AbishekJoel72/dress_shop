@extends('layouts.user.default')
@section('content')
    <div class="container ">
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="fw-bold mb-0">Shopping Cart</h3>

            @if (count($cart) > 0)
                <a href="{{ route('product_list') }}" class="btn btn-outline-dark">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            @endif

        </div>

        <div class="row">
            {{-- Left Side: Products List --}}
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm p-3">
                    @php $grandTotal = 0; @endphp
                    @forelse ($cart as $item)
                        @php
                            $finalPrice =
                                $item->discount_price > 0 ? $item->price - $item->discount_price : $item->price;
                            $grandTotal += $finalPrice * $item->quantity;
                        @endphp

                        <div class="row align-items-center cartRow py-3 {{ !$loop->last ? 'border-bottom' : '' }}"
                            data-id="{{ $item->id }}">
                            <div class="col-3 col-md-2 text-center">
                                <img src="{{ asset($item->get_product->get_product_images->image_path ?? null) }}"
                                    class="img-fluid rounded" style="max-height: 100px; object-fit: contain;">
                            </div>
                            <div class="col-9 col-md-6">
                                <h5 class="fw-bold mb-1">{{ $item->get_product->product_name }}</h5>
                                <p class="text-muted small mb-2">In Stock</p>
                                <div class="d-flex align-items-center flex-wrap gap-2">
                                    <!-- Quantity -->
                                    <div class="d-flex align-items-center border rounded  bg-light" style="height: 35px;">
                                        <button class="btn btn-sm btn-light border-0 px-2 decreaseQty"
                                            data-id="{{ $item->id }}"><i class="fa fa-minus small"></i></button>
                                        <input type="text" value="{{ $item->quantity }}"
                                            class="form-control form-control-sm text-center border-0 bg-transparent qtyInput"
                                            data-id="{{ $item->id }}" style="width: 40px; font-weight: bold;" readonly>
                                        <button class="btn btn-sm btn-light border-0 px-2 increaseQty"
                                            data-id="{{ $item->id }}"><i class="fa fa-plus small"></i></button>
                                    </div>

                                    <span class="text-muted">|</span>

                                    <!-- Size Selection -->

                                    <select name="size" id="size" class="form-select form-select-sm  sizeSelected"
                                        data-id="{{ $item->id }}" style="width: 100px; font-weight: bold;height: 35px;"
                                        required>
                                        <option value="" selected disabled>Select </option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}"
                                                {{ $item->size_id == $size->id ? 'selected' : '' }}>
                                                {{ $size->size_name }}
                                            </option>
                                        @endforeach
                                    </select>


                                    <span class="text-muted">|</span>

                                    <!-- Delete Button -->
                                    <button class="btn btn-link btn-sm text-danger text-decoration-none  deleteCart"
                                        data-id="{{ $item->id }}">
                                        Delete
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 text-md-end mt-2 mt-md-0">
                                <span class="text-muted small">Price:</span>
                                <span class="fw-bold d-block">
                                    @if ($item->discount_price > 0)
                                        <small class="text-decoration-line-through text-muted">₹
                                            {{ number_format($item->price, 2) }}</small>
                                        <span class="text-danger">₹
                                            {{ number_format($item->price - $item->discount_price, 2) }}</span>
                                    @else
                                        ₹ {{ number_format($item->price, 2) }}
                                    @endif
                                </span>
                                <span class="text-success small d-block itemTotal " data-id="{{ $item->id }}">Total: ₹
                                    {{ number_format($item->total_amount, 2) }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 col-12">
                            <h5 class="text-muted text-center">Your Cart is empty.</h5>
                            <a href="{{ route('product_list') }}"
                                class="btn btn-warning px-4 mt-3 text-center rounded-pill fw-bold">Continue Shopping</a>
                        </div>
                    @endforelse
                </div>
            </div>

            @if (count($cart) > 0)
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 bg-light p-4 position-sticky" style="top: 20px;">
                        <h5 class="fw-bold mb-3">Order Summary</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Items ({{ count($cart) }}):</span>
                            <span id="cartGrandTotal">₹ {{ number_format($grandTotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 text-success">
                            <span>Delivery:</span>
                            <span>FREE</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="h5 fw-bold mb-0">Order Total:</span>
                            <span class="h4 fw-bold text-danger mb-0" id="orderTotal">₹
                                {{ number_format($grandTotal, 2) }}</span>
                        </div>

                        {{-- Proceed to Order Form --}}
                        <form action="{{ route('checkout') }}" method="GET" id="checkoutForm">
                            <button type="submit" class="btn btn-warning w-100 py-2 rounded-pill  shadow-sm text-dark">
                                Proceed to Buy
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('layouts.user.footer')
@endsection

@section('script')
    <script>
        $(document).on('click', '.increaseQty, .decreaseQty', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let input = $('.qtyInput[data-id="' + id + '"]');
            let qty = parseInt(input.val());
            if ($(this).hasClass('increaseQty')) {
                qty++;
            } else {
                if (qty <= 1) return;
                qty--;
            }
            $.ajax({
                url: "{{ route('add_to_cart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    quantity: qty,
                    get_increasecart: true
                },
                success: function(response) {
                    if (response.status) {
                        input.val(response.quantity);
                        $('.itemTotal[data-id="' + id + '"]').text('Total: ₹ ' + response.total_amount
                            .toFixed(2));
                        $('#cartGrandTotal').text('₹ ' + parseFloat(response.cart_grand_total).toFixed(
                            2));
                        $('#orderTotal').text('₹ ' + parseFloat(response.cart_grand_total).toFixed(2));

                    }

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });



        // AJAX Delete Cart Item
        $(document).on('click', '.deleteCart', function(event) {
            event.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('cart') }}",
                type: "POST",
                data: {
                    get_deletecart: true,
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        });

        // AJAX Update Size
        $(document).on('change', '.sizeSelected', function() {
            let id = $(this).data('id');
            let sizeId = $(this).val();
            $.ajax({
                url: "{{ route('cart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    size_id: sizeId,
                    get_updatesize: true
                },
                success: function(response) {
                    response = true;
                }
            });
        });

        $('#checkoutForm').on('submit', function(e) {
            let sizeMissing = false;
            $('.sizeSelected').each(function() {
                if ($(this).val() == '' || $(this).val() == null) {
                    sizeMissing = true;
                    $(this).focus();
                    return false;
                }
            });
            if (sizeMissing) {
                e.preventDefault();
                return false;
            }

        });
    </script>
@endsection
