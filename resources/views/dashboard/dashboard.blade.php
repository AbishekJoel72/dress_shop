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
                            <div class="card-body text-center">
                                <label for="">Count</label>
                                <a href="{{ route('categories') }}">{{ $category }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-bg-secondary mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Size Type</h6>
                            </div>
                            <div class="card-body text-center">
                                <label for="">Count</label>
                                <a href="{{ route('size_type') }}">{{ $size }}</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-3">
                        <div class="card text-bg-success mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Feedback</h6>
                            </div>
                            <div class="card-body text-center">
                                <label for="">Count</label>
                                <a href="">{{ $feedback }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="card text-bg-light  mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Contact</h6>
                            </div>
                            <div class="card-body text-center">
                                <label for="">Count</label>
                                <a href="" class="text-dark">0</a>
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
                                    <div class="col-6">
                                        <label for="">Men</label>
                                        <a href="{{ route('product') }}" class="text-dark">{{ $men_products }}</a>
                                    </div>

                                    <div class="col-6">
                                        <label for="">Women</label>
                                        <a href="{{ route('product') }}" class="text-dark">{{ $women_products }}</a>
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
                                    <div class="col-6">
                                        <label for="">Total</label>
                                        <a href="{{ route('order_list') }}" class="text-dark">{{ $total_orders }}</a>
                                    </div>

                                    <div class="col-6">
                                        <label for="">Today</label>
                                        <a href="{{ route('order_list') }}" class="text-dark">{{ $total_orders }}</a>
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
                                <div class="card-body text-center">
                                    <label for="">Count</label>
                                    <a href="">{{ $payment }}</a></p>
                                </div>
                            </div>
                        </div>



                    {{-- <div class="col-3">
                        <div class="card text-bg-danger mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>Return</h6>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <label for="">Total</label>
                                        <a href="">0</a>
                                    </div>

                                    <div class="col-6">
                                        <label for="">Today</label>
                                        <a href="">0</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                    <div class="col-3">
                        <div class="card text-bg-dark mb-3" style="height:130px">
                            <div class="card-header bg-transparent text-center">
                                <h6>User</h6>
                            </div>
                            <div class="card-body text-center">
                                <label for="">Count</label>
                                <a href="">{{ $user }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>






            </div>

        </div>



        @include('layouts.footer')
    @endsection

    @section('script')
        <script></script>
    @endsection
