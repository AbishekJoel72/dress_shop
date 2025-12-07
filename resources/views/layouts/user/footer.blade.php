<footer id="footer" class="d-flex">
        @php
        use App\Models\Configuration;
        $config = Configuration::first();
    @endphp
     <h6 >© {{ date('Y') }} {{ $config->company_name }}-{{ $config->tag_line }}. All Rights Reserved.</h6>
</footer>
