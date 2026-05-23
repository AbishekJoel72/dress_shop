<html>
    @include("layouts.head")
    {{-- @include("layouts.style") --}}
      <link rel="stylesheet" href="{{ asset('css/panel.css') }}" >
    <body>
        @include("layouts.admin.header")
        @include("layouts.admin.sidebar")
        <main class="main-container">
            @yield("content")
        </main>
        @include("layouts.script")
        @yield("script")
    </body>
</html>
