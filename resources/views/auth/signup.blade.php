@extends('layout.default_login_two')
@push('after-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/admin2/assets/css/vendors/sweetalert2.css') }}">
@endpush
@section('content')
    <div class="row">

        <div class="col-xl-12 p-0">
            <div class="login-card login-dark">
                <div>
                    <div><a class="logo text-start" href="/">
                            {{-- <img class="img-fluid for-light"
                                src="{{ asset('template/admin2/assets/images/logo/logo.png') }}" alt="looginpage"><img
                                class="img-fluid for-dark"
                                src="{{ asset('template/admin2/assets/images/logo/logo_dark.png') }}" alt="looginpage"> --}}
                            <h3 class="text-dark text-center">POS Application</h3>
                        </a>
                    </div>
                    <div class="login-main">
                        <div class="theme-form">
                            <h4>Registrasi Akun</h4>
                            {{-- <p>Enter your email & password to login</p> --}}
                            <div class="form-group">
                                <label class="col-form-label">Nama</label>
                                <input class="form-control" type="email" required="" placeholder="Nama" id="v-name">

                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" type="email" required="" placeholder="Test@gmail.com"
                                    id="v-email">

                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Phone</label>
                                <input class="form-control" type="email" required="" placeholder="08***"
                                    id="v-phone">

                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Alamat</label>
                                <input class="form-control" type="email" required="" placeholder="bandung"
                                    id="v-alamat">

                            </div>
                            <div class="form-group mb-4">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input class="form-control" type="password" name="password" id="v-password"
                                        required="" placeholder="*********">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                                {{-- @if ($errors->has('email'))
                                <h6><span class="badge badge-danger mt-3">{{ $errors->first('email') }}</span></h6>
                            @endif --}}
                            </div>
                            <div class="form-group mb-0">
                                {{-- <div class="checkbox p-0">
                                <input id="checkbox1" type="checkbox">
                                <label class="text-muted" for="checkbox1">Remember password</label>
                            </div> --}}
                                <button class="btn btn-dark btn-block w-100" id="save-btn">Daftar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script src="{{ asset('template/admin/vendor/sweetalert2/dist/sweetalert2.min.js') }}" aria-hidden="true"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        isObject = {}
        var baseURL = window.location.origin;

        function validationSwalFailed(param, isText) {
            // console.log(param);
            if (param == "" || param == null) {
                sweetAlert("Oops...", isText, "warning");

                return 1;
            }
        }

        $("#save-btn").on("click", function(e) {
            e.preventDefault();
            checkValidation();
        });

        function checkValidation() {
            // console.log($el);
            if (
                validationSwalFailed(
                    (isObject["name"] = $("#v-name").val()),
                    "Nama tidak boleh kosong."
                )
            )
                return false;
            if (
                validationSwalFailed(
                    (isObject["email"] = $("#v-email").val()),
                    "Email tidak boleh kosong"
                )
            )
                return false;
            if (
                validationSwalFailed(
                    (isObject["phone"] = $("#v-phone").val()),
                    "Phone tidak boleh kosong"
                )
            )
                return false;
            if (
                validationSwalFailed(
                    (isObject["address"] = $("#v-alamat").val()),
                    "Alamat tidak boleh kosong"
                )
            )
                return false;
            if (
                validationSwalFailed(
                    (isObject["password"] = $("#v-password").val()),
                    "Password tidak boleh kosong."
                )
            )
                return false;


            saveData();
        }

        function saveData() {
            isObject.id = null;
            $.ajax({
                url: baseURL + "/sign-up",
                type: "POST",
                data: JSON.stringify(isObject),
                dataType: "json",
                contentType: "application/json",
                beforeSend: function() {
                    Swal.fire({
                        title: "Loading",
                        text: "Please wait...",
                    });
                },
                complete: function() {},
                success: function(response) {
                    // Handle response sukses
                    if (response.code == 0) {
                        swal("Saved !", response.message, "success").then(function() {
                            location.reload();
                        });
                        // Reset form
                    } else {
                        sweetAlert("Oops...", response.message, "error");
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    // console.log(xhr.responseText);
                    sweetAlert("Oops...", xhr.responseText, "error");
                },
            });
        }
    </script>
@endpush
