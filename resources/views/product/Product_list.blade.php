@extends('layouts.user.default')
@section('content')
    <style>
        .product-image-container {
            width: 100%;
            height: 200px;
            /* 300 -> 180 */
            overflow: hidden;
        }
        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .product-card {
            margin-bottom: 15px;
        }
        .product-card .card-body {
            padding: 10px;
        }
        .product-card .card-title {
            font-size: 15px;
            margin-bottom: 5px;
        }
        .product-card p {
            margin-bottom: 3px;
            font-size: 13px;
        }
        .product-card .btn {
            font-size: 13px;
            padding: 6px;
        }
    </style>
    <div class="container ">
        <div class="row">
            @foreach ($products as $p)
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border-0 position-relative ">

                        <!-- Favourite Heart -->
                        <a href="#" class="position-absolute top-0 start-0 m-2 fs-4 favourite-toggle"
                            data-product-id="{{ $p->id }}">
                            <i class="{{ in_array($p->id, $favouriteIds) ? 'fa-solid' : 'fa-regular'  }} fa-regular fa-heart text-danger"></i>
                        </a>

                        <div class="product-image-container">
                            <img src="{{ asset($p->get_product_images->image_path) }}" alt="Product Image"
                                class="product-image">
                        </div>

                        <div class="card-body text-center">
                            <h6 class="card-title text-dark fw-bold">{{ $p->product_name }}</h6>
                            <p class="text-muted mb-1"><i class="fa-solid fa-indian-rupee-sign"></i>
                                {{ number_format($p->price, 2) }}</p>
                            <p class="text-muted mb-1">{{ $p->get_category->name }}</p>
                            @if ($p->discount_price)
                                <p class="text-danger fw-bold">Discount: <i class="fa-solid fa-indian-rupee-sign"></i>
                                    {{ number_format($p->discount_price, 2) }}</p>
                            @endif
                        </div>
                        <div class="card-footer bg-white text-center d-flex justify-content-between align-items-center">
                            <a href="{{ route('add_to_cart', ['id' => encrypt($p->id), 'add_into_cart' => true]) }}"
                                class="btn btn-warning w-50 me-2">
                                Add to Cart
                            </a>

                            <a href="{{ route('order', ['id' => encrypt($p->id)]) }}" class="btn btn-primary w-50 ">
                                Buy Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('layouts.user.footer')
@endsection
@section('script')
    @include('layouts.datatable')
    <script>
        $(document).on('click', '.favourite-toggle', function(event) {
            event.preventDefault();
            let btn = $(this);
            let heartIcon = btn.find('i');
            let productId = btn.data('product-id');
            $.ajax({
                url: "{{ route('product_list') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    get_favourite: true
                },
                success: function(response) {
                    if (response.favourited) {
                        heartIcon.removeClass('fa-regular text-danger')
                            .addClass('fa-solid text-danger');
                    } else {
                        heartIcon.removeClass('fa-solid text-danger')
                            .addClass('fa-regular text-danger');
                    }
                }
            });
        });
    </script>
@endsection
