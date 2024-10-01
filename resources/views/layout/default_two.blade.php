<!DOCTYPE html>
<html lang="en">
    @stack('before-style')
    @include('includes.admin2.style')
    @stack('after-style')

    <body>
        <div class="loader-wrapper">
            <div class="loader-index"> <span></span></div>
            <svg>
                <defs></defs>
                <filter id="goo">
                    <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                    <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                    </fecolormatrix>
                </filter>
            </svg>
        </div>
        <div class="tap-top"><i data-feather="chevrons-up"></i></div>
        <div class="page-wrapper compact-wrapper" id="pageWrapper">
            @include('includes.admin2.header')
            <div class="page-body-wrapper">
                @include('includes.admin2.sidebar')
                <div class="page-body">
                    @yield('content')
                </div>
            </div>
           
        </div>
        @stack('before-script')
        @include('includes.admin2.script')
        @stack('after-script')
    </body>

</html>
