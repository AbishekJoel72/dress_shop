@include('layouts.head')
{{-- @include('layouts.style') --}}
@include('home.home-page_style')

<body>
    <header id="header" class="d-flex justify-content-between align-items-center ">
        @php
            use App\Models\Configuration;

            $config = Configuration::first();

        @endphp
        @if (empty($config->logo))
            <h5 class="mb-0">My Company</h5>
        @else
            <img src="{{ asset($config->logo) }}" width="190" height="100"
                style="border:1px solid #000;border-radius:0px;" alt="Company Logo" class="img-thumbnail">
        @endif


          <ul class="nav-links" id="navLinks">

                <li><a href="/">Home</a></li>
                <li><a href="/product_list">Products</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                <li> <a href="{{ route('login') }}">Login</a></li>
        </nav>
    </header>

</body>
<footer>

</footer>
