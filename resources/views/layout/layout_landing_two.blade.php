<!DOCTYPE html>
<html class="no-js" lang="en">
    @stack('before-style')
    @include('includes.layout_frontend.style')
    @stack('after-style')

    <body>
        @include('includes.layout_frontend.header_promotion')
        @include('includes.layout_frontend.header')
        @include('includes.layout_frontend.right_sidebar')
        <main class="main">
            @yield('content')
        </main>
        @include('includes.layout_frontend.footer')
        
        @stack('before-script')
        @include('includes.layout_frontend.script')
        @stack('after-script')
    </body>

</html>
