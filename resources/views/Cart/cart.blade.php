@extends('layouts.user.default')
@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 fw-bold">Shopping Cart</h3>

        <div class="row">
            {{-- Left Side: Products List --}}
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm p-3">
                    @php $grandTotal = 0; @endphp
                    @forelse ($cart as $item)
                        @php
                            $total = $item['price'] * $item['quantity'];
                            $grandTotal += $total;
                        @endphp

                        <div class="row align-items-center py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="col-3 col-md-2 text-center">
                                <img src="{{ asset($item['image']) }}" class="img-fluid rounded"
                                    style="max-height: 100px; object-fit: contain;">
                            </div>
                            <div class="col-9 col-md-6">
                                <h5 class="fw-bold mb-1">{{ $item['name'] }}</h5>
                                <p class="text-muted small mb-2">In Stock</p>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center border rounded me-3 bg-light"
                                        style="height: 35px;">
                                        <button class="btn btn-sm btn-light border-0 px-2 decreaseQty"
                                            data-id="{{ $item['id'] }}"><i class="fa fa-minus small"></i></button>
                                        <input type="text" value="{{ $item['quantity'] }}"
                                            class="form-control form-control-sm text-center border-0 bg-transparent qtyInput"
                                            data-id="{{ $item['id'] }}" style="width: 40px; font-weight: bold;" readonly>
                                        <button class="btn btn-sm btn-light border-0 px-2 increaseQty"
                                            data-id="{{ $item['id'] }}"><i class="fa fa-plus small"></i></button>
                                    </div>
                                    <span class="text-muted">|</span>
                                    <button class="btn btn-link btn-sm text-danger text-decoration-none ms-3 deleteCart"
                                        data-id="{{ $item['id'] }}">
                                        Delete
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 col-md-4 text-md-end mt-2 mt-md-0">
                                <span class="text-muted small">Price:</span>
                                <span class="fw-bold d-block">
                                    @php
                                        $productModel = \App\Models\Product::find($item['id']);
                                    @endphp

                                    @if ($productModel && $productModel->discount_price > 0)
                                        <small class="text-decoration-line-through text-muted">₹
                                            {{ number_format($productModel->price, 2) }}</small>
                                        <span class="text-danger">₹ {{ number_format($item['price'], 2) }}</span>
                                    @else
                                        ₹ {{ number_format($item['price'], 2) }}
                                    @endif
                                </span>
                                <span class="text-success small d-block">Total: ₹ {{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                    @empty
                        <div class="text-center py-5 col-12">
                            <h5 class="text-muted">Your Cart is empty.</h5>
                            <a href="{{ route('product_list') }}"
                                class="btn btn-warning px-4 mt-3 rounded-pill fw-bold">Continue Shopping</a>
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
                            <span>₹ {{ number_format($grandTotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 text-success">
                            <span>Delivery:</span>
                            <span>FREE</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="h5 fw-bold mb-0">Order Total:</span>
                            <span class="h4 fw-bold text-danger mb-0">₹ {{ number_format($grandTotal, 2) }}</span>
                        </div>

                        {{-- Proceed to Order Form --}}
                        <form action="{{ route('checkout') }}" method="GET">
                            <button type="submit"
                                class="btn btn-warning w-100 py-2 rounded-pill fw-bold shadow-sm text-dark">
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
        // Increase Quantity
        $('.increaseQty').click(function() {
            let id = $(this).data('id');
            let input = $('.qtyInput[data-id="' + id + '"]');
            let qty = parseInt(input.val());
            qty++;
            input.val(qty);
            updateCart(id, qty);
        });

        // Decrease Quantity
        $('.decreaseQty').click(function() {
            let id = $(this).data('id');
            let input = $('.qtyInput[data-id="' + id + '"]');
            let qty = parseInt(input.val());
            if (qty > 1) {
                qty--;
                input.val(qty);
                updateCart(id, qty);
            }
        });

        // AJAX Update Cart
        function updateCart(id, qty) {
            $.ajax({
                url: "{{ route('add_to_cart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    quantity: qty
                },
                success: function(response) {
                    location.reload();
                }
            });
        }

        // AJAX Delete Cart Item
        $('.deleteCart').click(function() {
            let id = $(this).data('id');
            $.ajax({
                url: "{{ route('cart') }}",
                type: "POST",
                data: {
                    get_deletecart: true,
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function() {
                    location.reload();
                }
            });
        });
    </script>
@endsection
