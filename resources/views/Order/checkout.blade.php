@extends('layouts.user.default')
@section('content')
<div class="container mt-5">
    <!-- Amazon style minimalist header line -->
    <h2 class="mb-4 fw-normal text-dark border-bottom pb-3">Checkout</h2>

    <div class="row">
        {{-- Left Side: Checkout Main Sections (Amazon Style) --}}
        <div class="col-lg-8 mb-4">

            {{-- Section 1: Delivery Address --}}
            <div class="card shadow-sm p-4 mb-3 border-0 rounded-3 bg-white">
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="fw-bold text-dark"><span class="text-secondary me-2">1</span> Shipping Address</h5>
                    </div>
                    <div class="col-md-7 ps-md-4">
                        <p class="fw-bold mb-1">{{ Auth::user()->name ?? 'Guest User' }}</p>
                        <p class="text-muted small mb-0">
                            123, Anna Salai, T. Nagar,<br>
                            Chennai, Tamil Nadu - 600017
                        </p>
                    </div>
                    <div class="col-md-2 text-md-end mt-2 mt-md-0">
                        <a href="#" class="small text-decoration-none text-primary">Change</a>
                    </div>
                </div>
            </div>

            {{-- Section 2: Payment Method --}}
            <div class="card shadow-sm p-4 mb-3 border-0 rounded-3 bg-white">
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="fw-bold text-dark"><span class="text-secondary me-2">2</span> Payment Method</h5>
                    </div>
                    <div class="col-md-9 ps-md-4">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD" checked>
                            <label class="form-check-label fw-bold small text-dark" for="cod">
                                Cash on Delivery / Pay on Delivery
                                <span class="d-block text-muted fw-normal small">Scan UPI QR code or pay cash at the time of delivery.</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="online" value="Online">
                            <label class="form-check-label fw-bold small text-dark" for="online">
                                Credit Card / Debit Card / Net Banking / UPI
                                <span class="d-block text-muted fw-normal small">Pay securely online using our payment gateway.</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 3: Review Items and Delivery --}}
            <div class="card shadow-sm p-4 border-0 rounded-3 bg-white">
                <h5 class="fw-bold text-dark mb-3"><span class="text-secondary me-2">3</span> Review Items and Delivery</h5>

                <div class="border rounded p-3 bg-light mb-3">
                    <span class="text-success fw-bold small"><i class="fa fa-truck me-1"></i> Your order qualifies for FREE Delivery.</span>
                </div>

                <div class="ps-md-2">
                    @php $grandTotal = 0; @endphp
                    @foreach ($cart as $item)
                        @php
                            $total = $item['price'] * $item['quantity'];
                            $grandTotal += $total;
                        @endphp

                        <div class="row align-items-center py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="col-3 col-md-2 text-center">
                                <img src="{{ asset($item['image']) }}" class="img-fluid rounded" style="max-height: 80px; object-fit: contain;">
                            </div>
                            <div class="col-9 col-md-7">
                                <h6 class="fw-bold mb-1 text-dark">{{ $item['name'] }}</h6>
                                <p class="text-danger small fw-bold mb-1">₹ {{ number_format($item['price'], 2) }}</p>
                                <span class="badge bg-secondary-subtle text-dark border small">Qty: {{ $item['quantity'] }}</span>
                            </div>
                            <div class="col-12 col-md-3 text-md-end mt-2 mt-md-0">
                                <span class="text-dark small d-block">Subtotal</span>
                                <span class="fw-bold text-dark">₹ {{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right Side: Amazon Style Sticky Order Summary Box --}}
        <div class="col-lg-4">
            <div class="card shadow-sm border p-4 bg-white position-sticky rounded-3" style="top: 20px; border-color: #ddd !important;">

                {{-- Final Place Order Button at Top --}}
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning w-100 py-2.5 rounded-3 fw-bold shadow-sm text-dark border-0 mb-3"
                            style="background-color: #ffd814; transition: background 0.2s;"
                            onmouseover="this.style.backgroundColor='#f7ca00'"
                            onmouseout="this.style.backgroundColor='#ffd814'">
                        Place Your Order
                    </button>
                </form>

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

                <div class="p-2 rounded small text-muted bg-light border d-flex align-items-center" style="font-size: 12px;">
                    <i class="fa fa-lock text-success me-2 fs-5"></i>
                    <span>Secure transaction. Your personal and financial information is fully protected.</span>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.user.footer')
@endsection
