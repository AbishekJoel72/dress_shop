<header class="header d-flex justify-content-between align-items-center">
    @php
        use App\Models\Configuration;

        $config = Configuration::first();

    @endphp
    @if (!empty($config->logo))
        <img src="{{ asset($config->logo) }}" width="170" height="100" style="border:1px solid #000;border-radius:0px;"
            alt="Company Logo" class="img-thumbnail">
    @endif


    <nav class="bg-light text-primary p-3">
        @php
            use App\Models\Registration;
            $reg = Registration::where('role', 'admin')->first();
        @endphp

        <div class="dropdown">
            <div class=" d-flex flex-column align-items-start" id="adminDropdown" data-bs-toggle="dropdown"
                aria-expanded="false" style="cursor:pointer;">
                @if (isset($reg))
                    <span><i class="fa fa-user"></i> {{ $reg->first_name }}</span>
                    <span><i class="fa fa-envelope"></i> {{ $reg->email }}</span>
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
