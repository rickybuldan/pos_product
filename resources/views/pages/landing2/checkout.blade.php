@extends('layout.layout_landing_two')
@push('after-style')
    @foreach ($cssFiles as $file)
        <link rel="stylesheet" href="{{ $file }}">
    @endforeach


@endpush

@section('content')
    <div class="container" data-select2-id="14">
        <div class="row mt-50">
            <div class="col-lg-6">
                <div class="toggle_info">
                    <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Pilih kurir dan pembayaran yang
                            tersedia</span></span>
                </div>
            </div>
            <div class="col-lg-6 mb-sm-15">
                <div class="toggle_info">
                    <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Silakan cek detail order dibawah
                            ini!</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="divider mt-50 mb-50"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="mb-25">
                    <h4>Detail Tagihan</h4>
                </div>
                <form method="post">

                    <div class="form-group">
                        <input type="text" required="" name="name" id="f-name" placeholder="Nama">
                    </div>

                    <div class="form-group">
                        <input required="" type="text" name="email" id="f-email" placeholder="Email address *"
                            disabled>
                    </div>

                    <div class="form-group">
                        <input required="" type="number" name="phone" id="f-phone" placeholder="Phone *">
                    </div>

                    {{-- <div class="mb-20">
                        <h5>Informasi alamat dan kurir</h5>
                    </div> --}}

                    <div class="form-group">
                        <select class="form-control select2 sel-provinces">
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control select2 sel-cities">
                            <option value="">Pilih Kota</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <input required="" type="text" name="address" id="f-address" placeholder="Alamat *">
                    </div>

                    <div class="form-group">
                        <select class="form-control select2 sel-courier">
                            <option value="">Pilih Kurir</option>
                            <option value="jne">JNE</option>
                            <option value="tiki">Tiki</option>
                            <option value="pos">Pos Indonesia</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-control select2 sel-courier-package">
                            <option value="">Pilih Jenis Paket</option>
                        </select>
                    </div>

                    <div class="form-group detail-service">

                    </div>

                    <div class="form-group mb-30">
                        <textarea rows="5" placeholder="Catatan" id="f-note-order"></textarea>
                    </div>
                </form>
            </div>
            <div class="col-md-7">
                <div class="order_review">
                    <div class="mb-20">
                        <h4>Detail Order</h4>
                    </div>
                    <div class="table-responsive order_table text-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                    <div class="payment_method">
                        <div class="mb-25">
                            <h5>Payment</h5>
                        </div>
                        <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option"
                                    id="exampleRadios3" checked="">
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                    data-target="#bankTranfer" aria-controls="bankTranfer">Direct Bank Transfer</label>
                                <div class="form-group collapse in" id="bankTranfer">
                                    <p class="text-muted mt-5">There are many variations of passages of Lorem Ipsum
                                        available, but the majority have suffered alteration. </p>
                                </div>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option"
                                    id="exampleRadios4" checked="">
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                    data-target="#checkPayment" aria-controls="checkPayment">Check Payment</label>
                                <div class="form-group collapse in" id="checkPayment">
                                    <p class="text-muted mt-5">Please send your cheque to Store Name, Store Street, Store
                                        Town, Store State / County, Store Postcode. </p>
                                </div>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option"
                                    id="exampleRadios5" checked="">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                                    data-target="#paypal" aria-controls="paypal">Paypal</label>
                                <div class="form-group collapse in" id="paypal">
                                    <p class="text-muted mt-5">Pay via PayPal; you can pay with your credit card if you
                                        don't have a PayPal account.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <a href="#" class="btn btn-fill-out btn-secondary mt-30">Cek Ongkir</a> --}}
                    <a class="btn btn-fill-out btn-block mt-30" id="payButton" >Konfirmasi Order</a>
                </div>
            </div>
        </div>
    </div>
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
