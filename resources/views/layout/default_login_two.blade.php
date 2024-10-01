<!DOCTYPE html>
<html lang="en">
    @stack('before-style')
    @include('includes.admin2.login.style')
    @stack('after-style')
    <body>
        <div class="container-fluid">
            @yield('content')
        </div>
        @stack('before-script')
        @include('includes.admin2.login.script')
        @stack('after-script')
    </body>

</html>
