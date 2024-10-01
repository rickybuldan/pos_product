@extends('layout.default_two')
@push('after-style')
    @foreach ($cssFiles as $file)
        <link rel="stylesheet" href="{{ $file }}">
    @endforeach
@endpush
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>{{ $subtitle }}</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">{{ $title }}</li>
                        <li class="breadcrumb-item active">{{ $subtitle }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Form Transaksi</h5>
                        {{-- <span>Pastikan pet house ditiap pet berbeda dan status pet house yang dipilih adalah open.</span> --}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label for="validationCustom01">Tipe Pencarian:</label>
                                    <select class="form-select form-select-sm select2" id="form-type-search">
                                        <option value="CODE" selected>Kode Barang</option>
                                        <option value="NAME">Nama Barang</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="mb-3">
                                    <label id="label-type-search">Kode Barang:</label>
                                    <input class="form-control" id="v-kd-barang" type="text" placeholder="Kode Barang"
                                        required="">
                                    <ul id="autocomplete-results" class="list-group"
                                        style="position: absolute; z-index: 1000; cursor: pointer;"></ul>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="validationCustom01">Nama Pembeli:</label>
                                    <input class="form-control" id="v-nama" type="text" placeholder="Nama Pembeli"
                                        required="">
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="table-responsive">
                                    <table class="table table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Harga Satuan</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Stok</th>
                                                <th scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="f-product">
                                            <tr>
                                                <td class="text-center notice-non-prod" colspan="5">Tidak ada barang</td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 col-xl-6 mt-3">
                                    <div class="p-1">
                                        <label for="validationCustom01">Pilih Satuan:</label>
                                        <br>
                                        <span class="badge badge-pill badge-dark payment-unit" style="cursor: pointer;" data-unit="5000">Rp
                                            5.000</span>
                                        <span class="badge badge-pill badge-dark payment-unit" style="cursor: pointer;" data-unit="10000">Rp
                                            10.000</span>
                                        <span class="badge badge-pill badge-dark payment-unit" style="cursor: pointer;" data-unit="20000">Rp
                                            20.000</span>
                                        <span class="badge badge-pill badge-dark payment-unit" style="cursor: pointer;" data-unit="50000">Rp
                                            50.000</span>
                                        <span class="badge badge-pill badge-dark payment-unit" style="cursor: pointer;" data-unit="100000">Rp
                                            100.000</span>
                                        <span class="badge badge-pill badge-dark payment-unit" id="exact-money" style="cursor: pointer;"
                                            data-unit="100000">Uang Pas</span>
                                    </div>
                                    <div class="p-1">
                                        <div class="col-sm-6 col-lg-6 col-xl-6 mt-3">
                                            <label for="validationCustom01">Jumlah Bayar:</label>
                                            <input class="form-control jumlah-bayar" type="text" value="Rp 0"
                                                placeholder="Jumlah Bayar">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6 col-lg-6 col-xl-6 p-3 mt-3 border border-gray">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="validationCustom01" class="mb-0">Grand Total:</label>
                                        <h5 class="text-end mb-0 grand-total">Rp 0</h5>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="validationCustom01" class="mb-0">Jumlah Bayar:</label>
                                        <h5 class="text-end mb-0 total-payment">Rp 0</h5>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="validationCustom01" class="mb-0">Kembalian:</label>
                                        <h5 class="text-end mb-0 exchange">Rp 0</h5>
                                    </div>
                                </div>

                            </div>




                            <div class="col-sm-4 col-lg-4 col-xl-4 mt-3 py-4">
                                <a class="btn btn-info" id="save-btn">Simpan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
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
@endpush
