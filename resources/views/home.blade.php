@extends('layout.default_two')
@push('after-style')
    @foreach ($cssFiles as $file)
        <link rel="stylesheet" href="{{ $file }}">
    @endforeach
    <link rel="stylesheet" type="text/css" href="{{ asset('template/admin2/assets/css/vendors/owlcarousel.css') }}">
@endpush

@section('content')
    {{-- <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>{{ $subtitle }}</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{asset('template/admin2/assets/svg/icon-sprite.svg#stroke-home')}}""></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">{{ $title }}</li>
                        <li class="breadcrumb-item active">{{ $subtitle }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Container-fluid starts-->
    <div class="container-fluid p-4">
        <div class="row"
            style="width: 100%;background-image: url({{ asset('template/admin2/assets/images/email-template/invoice-3/bg-0.png') }});background-position: center;background-size: cover;background-repeat: no-repeat; border-radius: 10px;">
            <div class="col-xxl-9 col-md-6 box-col-12">
                {{-- <div class="card">
                    <div class="card-header card-no-border">
                        <h5>Total Profits</h5><span class="f-light f-w-500 f-14">(Detail Profit)</span>
                    </div>
                    <div class="card-body pt-0">
                        <div class="monthly-profit">
                            <div id="profitmonthly"></div>
                        </div>
                    </div>
                </div> --}}
                <div class="p-5">
                    <div class="">
                        <h2>KIMI SHOP</h2>
                        <p class="my-3 w-50 f-w-300 f-14">Kami dengan bangga mempersembahkan layanan eksklusif
                            kami yang
                            didedikasikan untuk kenyamanan dan kebahagiaan hewan kesayangan anda.</p>
                    </div>
                    <div class="">
                        <a class="btn btn-primary" href="#set-appointment">Pesan Sekarang!</a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6 box-col-6">
                {{-- <div class="card">
                    <div class="card-header card-no-border pb-0">
                        <h5>Overview Transaksi</h5><span class="f-light f-w-500 f-14">(Transaksi bulan ini berdasarkan
                            hari)</span>
                    </div>
                    <div class="card-body pt-0">
                        <div class="visitors-container">
                            <div id="visitor-chart"></div>
                        </div>
                    </div>
                </div> --}}
                <img class="w-50" src="{{ asset('template/admin2/assets/images/grooming-8.png') }}" alt="grooming">
            </div>

        </div>
        <div class="row d-flex justify-content-center p-5" id="imgcontent">
            {{-- <div class="col-xxl-12 col-md-12 box-col-12">
                <div class="carousel slide" id="carouselExampleInterval" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000"><img class="d-block w-100"
                                src="{{asset('template/admin2/assets/images/slider/5.jpg')}}" alt="drawing-room"></div>
                        <div class="carousel-item" data-bs-interval="2000"><img class="d-block w-100"
                                src="{{asset('template/admin2/assets/images/slider/10.jpg')}}" alt="drawing-room"></div>
                        <div class="carousel-item"><img class="d-block w-100" src="{{asset('template/admin2/assets/images/slider/2.jpg')}}"
                                alt="drawing-room"></div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span
                            class="visually-hidden">Previous</span></button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span
                            class="visually-hidden">Next</span></button>
                </div>
            </div> --}}

        </div>
    </div>
    <div id="set-appointment" class="row p-5 pt-0 me-3">
        <div class="col-xxl-3 col-md-6 box-col-6">
            <ul class="schedule-list">
                <li class="primary"><i class="fa fa-calendar fs-2"></i>
                    <div>
                        <h6 class="mb-1">1 Hari Sebelumnya</h6>
                        <span class="f-light">Pastikan melakukan pesanan / janji temu sehari sebelum tanggal grooming</span>
                    </div>
                </li>
                <li class="primary"><i class="fa fa-clock-o fs-2"></i>
                    <div>
                        <h6 class="mb-1">Jam Buka</h6>
                        <span class="f-light">Senin - Jum'at Pukul 09.00-17.00 Tutup Sabtu - Minggu</span>
                    </div>
                </li>
                <li class="primary"><i class="fa fa-map-marker fs-2"></i>
                    <div>
                        <h6 class="mb-1">Kedatangan</h6>
                        <span class="f-light">Pastikan datang pada waktu tanggal grooming</span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-xxl-9 col-md-6 box-col-12">
            <div class="card">
                <div class="card-header card-no-border pb-0 d-none">
                    <h5>Overview Transaksi</h5><span class="f-light f-w-500 f-14">(Transaksi bulan ini berdasarkan
                        hari)</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="validationCustom01">Nama:</label>
                                <input class="form-control" id="v-nama" type="text" placeholder="Nama" required="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="validationCustom01">Alamat:</label>
                                <input class="form-control" id="v-alamat" type="text" placeholder="Alamat"
                                    required="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="validationCustom01">Email:</label>
                                <input class="form-control" id="v-email" type="email" placeholder="Email"
                                    required="">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="validationCustom01">Phone:</label>
                                <input class="form-control" id="v-phone" type="text" placeholder="Phone"
                                    required="">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="validationCustom01">Tanggal Grooming:</label>
                                <input class="form-control" id="datetime-local" type="date" value=""
                                    placeholder="Select a date" readonly>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="validationCustom01">Pilih Jam:</label>
                                <select class="form-select tipebayar" aria-label="Default select example">
                                    <option selected>Pilih Jam</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="mb-1">
                                Tambah Pets
                            </div>
                            <div class="table-responsive">
                                <table class="table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Pet</th>
                                            <th scope="col">Paket/Layanan</th>
                                            <th scope="col">Karyawan</th>
                                            <th scope="col">Jenis Pet (ex: Dog)</th>
                                            <th scope="col"><a class="btn btn-primary" id="add-btn"><i
                                                        class="fa fa-plus"></i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody id="f-pet">

                                    </tbody>
                                    <tfoot>
                                        <th class="text-end" colspan='2'>Total</th>
                                        <th colspan="3"> <input class="form-control v-total" type="number"
                                                value="0" placeholder="Total" readonly></th>
                                        </th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-4 col-xl-4 mt-3 py-4">
                            <div class="mb-1">
                                <select class="form-select tipe-bayar" aria-label="Default select example">
                                    <option selected>Pilih Pembayaran</option>
                                    <option value="1">Bayar Ditempat</option>
                                    <option value="2">Transfer</option>
                                </select>
                            </div>
                            <div class="mb-1 bukti">
                                <label for="formFile" class="form-label">Transfer ke Mandiri 111-33-0927425-9 dan Upload
                                    Bukti Pembayaran</label>
                                <input class="form-control" accept="image/*" type="file" id="formFile">
                            </div>
                            <div class="mt-2">
                                <a class="btn btn-info" id="save-btn">Buat Pesanan</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div id="contact-kimi" class="row p-5">
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="klbfooterwidget footer-wrapper mb-30 widget_footer_about">
                <h3 class="footer-title">Tentang Kami</h3>
                <div class="footer-text">
                    <p>KIMI SHOP adalah penyedia jasa layanan grooming dan penitipan hewan yang berada di bandung </p>
                </div>
                <div class="footer-icon">
                    <a href="http://www.facebook.com/" target="_blank"><i class="fa fa-facebook fs=2 me-2"></i></a>
                    <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter fs=2 me-2"></i></a>
                    <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram fs=2 me-2"></i></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="klbfooterwidget footer-wrapper ml-20 mb-30 widget_footer_contact">
                <h3 class="footer-title">Kontak Kami</h3>
                <p class="m-0 p-0"><i class="fa fa-map-marker me-1"></i>Bandung, Indonesia
                </p>
                <p class="m-0 p-0"> <i class="fa fa-phone me-1"></i>+ 888 456-7890
                </p>
                <p class="m-0 p-0"><i class="fa fa-envelope me-1"></i>kimishop@gmail.com</p>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="klbfooterwidget footer-wrapper mb-30 widget_footer_about">
                <h3 class="footer-title">Grooming</h3>
                <div class="footer-text">
                    <p>Jasa pelayanan yang ada di KIMI SHOP untuk merawat kesehatan hewan peliharan anda</p>
                </div>

            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6">
            <div class="klbfooterwidget footer-wrapper mb-30 widget_footer_about">
                <h3 class="footer-title">Penitipan</h3>
                <div class="footer-text">
                    <p>Jasa pelayanan yang ada di KIMI SHOP untuk anda yang ingin menitipkan hewan peliharaan anda di
                        penitipan yang nyaman</p>
                </div>

            </div>
        </div>

    </div>
    </div>



    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 footer-copyright text-center">
                    <p class="mb-0">Copyright 2023 © KIMI SHOP </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Container-fluid Ends-->
@endsection


@push('after-script')
    <script>
        @foreach ($varJs as $varjsi)
            {!! $varjsi !!}
        @endforeach
    </script>


    @foreach ($javascriptFiles as $file)
        <script src="{{ $file }}"></script>
    @endforeach
    <script src="{{ asset('template/admin2/assets/js/owlcarousel/owl.carousel.js') }}"></script>
@endpush
