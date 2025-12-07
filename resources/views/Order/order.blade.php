@extends('layouts.user.default')

@section('content')
    <div class="container">
        <style>
            .custom-card-header {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: center;
            }

            .custom-card-header p {
                margin: 6px 0;
            }

            .product-img {
                max-width: 210px;
                height: 210px;
                object-fit: cover;
                display: block;
                margin: 0 auto;
            }

            .label-width {
                display: inline-block;
                width: 90px;

            }
        </style>

        <form action="{{ route('order') }}" method="POST" id="orderForm">
            @csrf
            <input type="hidden" name="order_items" value="true">
            <div class="card ">
                <div class="card-header bg-light custom-card-header">
                    <div class="row align-items-center justify-content-center text-center">

                        <!-- Left Side (Text) -->
                        <div class="col-md-6 text-start">
                            <h5 class="fw-bold mb-3 text-primary">{{ $product_items->product_name }}</h5>

                            <div class="d-flex mb-2">
                                <span class="fw-semibold text-secondary me-2 label-width">Category</span>
                                <span class="text-dark">: {{ $product_items->get_category->name }}</span>
                            </div>

                            <div class="d-flex mb-2">
                                <span class="fw-semibold text-secondary me-2 label-width">Price</span>
                                <span class="text-success">: ₹{{ number_format($product_items->price, 2) }}</span>
                            </div>

                            <div class="d-flex mb-2">
                                <span class="fw-semibold text-secondary me-2 label-width">Discount</span>
                                <span class="text-danger">: ₹{{ number_format($product_items->discount_price, 2) }}</span>
                            </div>

                            <div class="mt-3">
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#descModal"
                                    class="btn btn-sm btn-warning shadow-sm rounded-pill px-4">
                                    View Description
                                </a>
                            </div>
                        </div>





                        <!-- Right Side (Image) -->
                        <div class="col-md-4">
                            <img src="{{ asset($product_items->image_path) }}" alt="Product Image"
                                class="img-fluid rounded shadow-sm product-img">

                        </div>

                    </div>
                </div>

                <!-- Modal for Description -->
                <div class="modal fade" id="descModal" tabindex="-1" aria-labelledby="descModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="descModalLabel">Product Description</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                {{ $product_items->description }}
                            </div>

                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <input type="hidden" name="product_id" id="product_id" required value="{{ $product_items->id }}">
                    <input type="hidden" name="date" id="date" required value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="price" id="price" value="{{ $product_items->price }}"
                        oninput="addcalculation()">
                    <input type="hidden" name="discount" id="discount" value="{{ $product_items->discount_price }}"
                        oninput="addcalculation()">

                    <div class="row">

                        <div class="col-md-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="1" class="form-control"
                                oninput="addcalculation()">
                        </div>

                        <div class="col-md-3">
                            <label for="total_amount">Total Amount</label>
                            <input type="number" name="total_amount" id="total_amount" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label for="size_id">Size</label>

                            <select name="size_id" id="size_id" required class="form-select">
                                <option value="" selected disabled> Select Size</option>
                                @foreach ($size as $s)
                                    <option value="{{ $s->id }}">{{ $s->size_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" cols="70" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="col-2">
                            <label for="city_id">State</label>
                            <select name="state_id" id="state_id" required class="form-select select2">
                                <option value="" selected disabled>Select State</option>
                                @foreach ($state as $s)
                                    <option value="{{ $s->id }}">{{ $s->state_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-2">f
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" required class="form-select select2">
                            </select>
                        </div>

                        <div class="col-2">
                            <label for="pincode">Pincode</label>
                            <input type="number" name="pincode" id="pincode" class="form-select" required>
                        </div>

                    </div>

                    <div class="row mt-3">

                        <div class="col-4">
                            <label class="form-label d-block">Payment </label>
                            <div class="d-flex align-items-center gap-5 form-control">
                                <div class="form-check ">
                                    <input type="radio" name="payment_gateway" id="gpay" value="gpay"
                                        class="form-check-input" required>
                                    <label for="gpay" class="form-check-label">Gpay</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="payment_gateway" id="phonepe" value="phonepe"
                                        class="form-check-input" required>
                                    <label for="phonepe" class="form-check-label">Phone Pay</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="payment_gateway" id="paytm" value="paytm"
                                        class="form-check-input" required>
                                    <label for="paytm" class="form-check-label"> Pay TM</label>
                                </div>

                                {{-- <div class="form-check">
                                    <input type="radio" name="payment_gateway" id="netbanking" value="netbanking"
                                        class="form-check-input" required>
                                    <label for="netbanking" class="form-check-label"> Net Banking</label>
                                </div> --}}

                                {{-- <div class="form-check">
                                    <input type="radio" name="payment_gateway" id="card" value="card"
                                        class="form-check-input" required>
                                    <label for="card" class="form-check-label">Cards</label>
                                </div> --}}

                                {{-- <div class="form-check">
                                    <input type="radio" name="payment_gateway" id="cash_on_delivery"
                                        value="cash_on_delivery" class="form-check-input" required>
                                    <label for="cash_on_delivery" class="form-check-label"> Cash On Delivery</label>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer  bg-transparent text-center">
                    <button type="submit" class="btn btn-primary" id="payment"><i class="fa-solid fa-floppy-disk">
                        </i> Submit</button>
                    <button type="reset" class="btn btn-secondary"><i class="fa-solid fa-rotate-left"></i>
                        Reset</button>
                </div>
            </div>




            <div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Payment Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-floppy-disk">
                                </i> Submit</button>
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
                placeholder: "Select an option",
            });
        });

        function addcalculation() {
            let price = parseFloat(document.getElementById("price").value) || 0;
            let discount = parseFloat(document.getElementById("discount").value) || 0;
            let quantity = parseFloat(document.getElementById("quantity").value) || 1;


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
                            $.each(data, function(key, value) {
                                $('#city_id').append('<option value="' + value.id +
                                    '">' + value
                                    .city_name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city_id').empty();
                    $('#city_id').append('<option value="" selected disabled>Select City</option>');
                }
            });


            $(document).on("click", "#payment", function(e) {
                e.preventDefault();

                var gateway = $("input[name='payment_gateway']:checked").val();
                var amount = $("#total_amount").val();

                let modalBody = `
                    <h5 class="text-success mb-3">Confirm Your Payment</h5>
                    <table class="table table-bordered">

                        <tr>
                            <th>Payment Gateway</th>
                            <td>${gateway.toUpperCase()}</td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td> ${amount}</td>
                        </tr>

                        <tr>
                            <th>Currency</th>
                            <td><input type="text" name="currency" id="currency" value="INR"> </td>
                        </tr>
                        ${
                            gateway === "card"
                            ? `
                                                <tr>
                                                    <th>Card Type</th>
                                                    <td>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" name="card_type" id="debit_card" value="debit_card" class="form-check-input" required>
                                                            <label for="debit_card" class="form-check-label">Debit Card</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input type="radio" name="card_type" id="credit_card" value="credit_card" class="form-check-input" required>
                                                            <label for="credit_card" class="form-check-label">Credit Card</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                `
                            : ""
                        }
                    </table>
                `;

                $("#paymentModal .modal-body").html(modalBody);

                var myModal = new bootstrap.Modal(document.getElementById('paymentModal'));
                myModal.show();
            });


        });
    </script>
@endsection
