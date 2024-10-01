<!DOCTYPE html>
<html lang="en">
    @stack('before-style')
    @include('includes.admin2.style')
    @stack('after-style')

    <body onload="startTime()">
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
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">Copyright 2023 © Cuba theme by pixelstrap </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        @stack('before-script')
        @include('includes.admin2.script')
        @stack('after-script')
    </body>

</html>
