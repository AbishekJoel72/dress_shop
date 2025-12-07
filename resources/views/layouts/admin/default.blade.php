<html>
    @include("layouts.head")
    @include("layouts.style")
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
