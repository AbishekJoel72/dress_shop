    <footer id="mainFooter" class="footer d-flex">
        @php
            use App\Models\Configuration;
            $config = Configuration::first();
        @endphp
        @if (!empty($config))
            <h6>© {{ date('Y') }} {{ $config->company_name }}-{{ $config->tag_line }}. All Rights Reserved.</h6>
        @else
            <p class="text-danger">Configuration now define</p>
        @endif
    </footer>
