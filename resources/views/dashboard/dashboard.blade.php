@extends('layouts.admin.default')

@section('content')
    <div class="container">

        <div class="card ">
            <div class="card-header bg-transparent">
                <h5>Dashboard</h5>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-3">
                        <div class="card text-bg-primary mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Category</h6>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-between align-items-center text-center">
                                <label for="category">Count</label>
                                <a href="{{ route('categories') }}" class="text-light"
                                    id="category">{{ $category }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-bg-secondary mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Size Type</h6>
                            </div>
                            <div
                                class="card-body d-flex flex-column justify-content-between align-items-center text-center">
                                <label for="sizetype">Count</label>
                                <a href="{{ route('size_type') }}" class="text-light" id="sizetype">{{ $size }}</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="card text-bg-success mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Feedback</h6>
                            </div>
                            <div
                                class="card-body d-flex flex-column justify-content-between align-items-center text-center">
                                <label for="feedback">Count</label>
                                <a href="{{ route('feedback_list') }}" class="text-light"
                                    id="feedback">{{ $feedback }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-bg-light  mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Contact</h6>
                            </div>
                            <div
                                class="card-body d-flex flex-column justify-content-between align-items-center text-center">
                                <label for="contact">Count</label>
                                <a href="{{ route('contact_list') }}" class="text-dark"
                                    id="contact">{{ $contact }}</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-3">
                        <div class="card text-bg-info mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Product</h6>
                            </div>
                            <div class="card-body  ">
                                <div class="row text-center">
                                    <div class="col-6 d-flex flex-column align-items-center">
                                        <label for="men">Men</label>
                                        <a href="{{ route('product') }}" class="text-dark"
                                            id="men">{{ $men_products }}</a>
                                    </div>

                                    <div class="col-6 d-flex flex-column align-items-center">
                                        <label for="women">Women</label>
                                        <a href="{{ route('product') }}" class="text-dark"
                                            id="women">{{ $women_products }}</a>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card text-bg-warning mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Order</h6>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6 d-flex flex-column align-items-center">
                                        <label for="total">Total</label>
                                        <a href="{{ route('order_list') }}" class="text-dark"
                                            id="total">{{ $total_orders }}</a>
                                    </div>

                                    <div class="col-6 d-flex flex-column align-items-center">
                                        <label for="today">Today</label>
                                        <a href="{{ route('order_list') }}" class="text-dark"
                                            id="today">{{ $today_orders }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="card text-bg-danger mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Payment</h6>
                            </div>
                            <div
                                class="card-body d-flex flex-column justify-content-between align-items-center text-center">
                                <label for="payment">Count</label>
                                <a href="{{ route('payment_list') }}" id="payment"
                                    class="text-light">{{ $payment }}</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-bg-dark mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>User</h6>
                            </div>
                            <div
                                class="card-body d-flex flex-column justify-content-between align-items-center text-center">
                                <label for="user">Count</label>
                                <a href="{{ route('user_list_details') }}" id="user"
                                    class="text-light">{{ $user }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>






            </div>

        </div>








        <div class="row mt-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h5>Product</h5>
                    </div>
                    <div class="card-body">

                        @if ($men_products + $women_products > 0)
                            <canvas id="productPie" style="max-height:300px;"></canvas>
                        @else
                            <p>Product empty</p>
                        @endif


                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <h5>Order</h5>
                    </div>
                    <div class="card-body">
                        @if ($total_orders > 0)
                            <canvas id="orderPie" style="max-height:300px;"></canvas>
                        @else
                            <p>Order empty</p>
                        @endif
                    </div>
                </div>
            </div>



        </div>

      



        @include('layouts.footer')
    @endsection

    @section('script')
        <script>
            @if ($men_products + $women_products > 0)
                const ctx = document.getElementById('productPie').getContext('2d');

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Men', 'Women'],
                        datasets: [{
                            data: [{{ $men_products }}, {{ $women_products }}],
                            backgroundColor: ['#36A2EB', '#FF6384']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            @endif

            @if ($total_orders > 0)
                const ctxOrder = document.getElementById('orderPie').getContext('2d');

                new Chart(ctxOrder, {
                    type: 'pie',
                    data: {
                        labels: ['Total Orders'],
                        datasets: [{
                            data: [{{ $total_orders }}],
                            backgroundColor: ['#4CAF50']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            @endif

        </script>
    @endsection
