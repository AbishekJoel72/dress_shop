<html>
    @include('layouts.head')
    {{-- @include('layouts.style') --}}
  <link rel="stylesheet" href="{{ asset('css/panel.css') }}" >
    <body>
        @include('layouts.user.header')

        <main id="maincontant">
            @yield('content')
        </main>

        @include('layouts.script')
        @yield('script')
    </body>

</html>
