@extends('layouts.user.default')

@section('content')
    <div class="container">


        <div class="row">
            @foreach ($products as $p)
                @if ($p->status == 1)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="text-center p-3">
                                <img src="{{ asset($p->image_path) }}" alt="Product Image" class="img-fluid rounded"
                                    style="height: 220px; object-fit: cover;">
                            </div>
                            <div class="card-body text-center">
                                <h6 class="card-title text-dark fw-bold">{{ $p->product_name }}</h6>
                                <p class="text-muted mb-1"><i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($p->price, 2) }}</p>
                                <p class="text-muted mb-1">{{ $p->get_category->name }}</p>
                                @if ($p->discount_price)
                                    <p class="text-danger fw-bold">Discount: <i class="fa-solid fa-indian-rupee-sign"></i> {{ number_format($p->discount_price, 2) }}</p>
                                @endif
                            </div>
                            <div class="card-footer bg-white text-center ">
                                <a href="{{ route('order', ['id' => encrypt($p->id)]) }}" class="btn btn-secondary w-100">
                                    <i class="fa fa-shopping-cart"></i> Buy Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>

    @include('layouts.user.footer')
@endsection
@section('script')
    @include('layouts.datatable')
    <script></script>
@endsection
