@extends('layout.default_login_two')
@push('after-style')
@endpush
@section('content')
    <div class="row">
        {{-- <div class="col-xl-5">
        <img class="bg-img-cover bg-center"
                src="{{ asset('template/admin2/assets/images/login/1.png') }}" alt="looginpage">
        </div> --}}
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
                        <form class="theme-form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <h4>Login</h4>
                            <p>Masukkan email dan password</p>
                            <div class="form-group">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" type="email" required="" placeholder="your_mail@gmail.com" name="email">
                                <div class="invalid-feedback">Please enter your valid password </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Password</label>
                                <div class="form-input position-relative">
                                    <input class="form-control" type="password" name="password" required=""
                                        placeholder="*********">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                                @if ($errors->has('email'))
                                    <h6><span class="badge badge-danger mt-3">{{ $errors->first('email') }}</span></h6>
                                @endif
                            </div>
                            <div class="form-group mb-0">
                                <div class="checkbox p-0">
                                    <input id="checkbox1" type="checkbox">
                                    <label class="text-muted" for="checkbox1">Ingat password</label>
                                </div>
                                <button class="btn btn-dark btn-block w-100" type="submit">Login</button>
                            </div>

                            <p class="mt-4 mb-0 text-center">Belum punya akun?<a class="ms-2" href="/sign-up">Buat Akun</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
@endpush
