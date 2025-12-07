<html>
    @include('layouts.head')
    @include('layouts.style')

    <body>
        @include('layouts.user.header')

        <main id="maincontant">
            @yield('content')
        </main>

        @include('layouts.script')
        @yield('script')
    </body>

</html>
