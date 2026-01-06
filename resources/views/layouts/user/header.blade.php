<header id="header" class="d-flex justify-content-between align-items-center ">

    {{-- Company Logo --}}

    @php
        use App\Models\Configuration;
        $config = Configuration::first();
    @endphp
    @if (empty($config->logo))
        <h5 class="mb-0">My Company</h5>
    @else
        <img src="{{ asset($config->logo) }}" width="190" height="100" style="border:1px solid #000;border-radius:0px;"
            alt="Company Logo" class="img-thumbnail">
    @endif


    {{-- Search Bar --}}
    <div class="flex-grow-1 px-3">
        <input type="search" name="search_items" id="search_items" placeholder="Search..." class="form-control w-50">
    </div>

    {{-- Navigation Menu --}}
    <ul class="nav me-3 ">
        <li class="nav-item">
            <a href="{{ route('order_placed') }}" class="nav-link text-light">
                <i class="fa-solid fa-cart-shopping"></i> Order
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="#" class="nav-link text-light">
                <i class="fa-solid fa-rotate-left"></i> Return
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="{{ route('feedback') }}" class="nav-link text-light">
                <i class="fa-solid fa-comment-dots"></i> Feedback
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('contact') }}" class="nav-link text-light ">
                <i class="fa-solid fa-envelope"></i> Contact
            </a>
        </li>
    </ul>

    {{-- Admin Dropdown --}}
    <nav class="bg-light text-primary p-3">

        @php
            use App\Models\Registration;
            $user = session('user_id');
            $register = Registration::where('id', $user)->first();
        @endphp
        <div class="dropdown">
            <div class=" d-flex flex-column align-items-start" id="adminDropdown" data-bs-toggle="dropdown"
                aria-expanded="false" style="cursor:pointer;">
                @if ($register)
                    <span><i class="fa fa-user"></i> {{ $register->first_name }} {{ $register->last_name }} </span>
                    <span><i class="fa fa-envelope"></i> {{ $register->email }}</span>
                @else
                    <span><i class="fa fa-user"></i> Guest</span>
                @endif


            </div>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                <li>
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>




</header>
