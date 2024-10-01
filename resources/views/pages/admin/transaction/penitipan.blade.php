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
                        <h5>Form Penitipan</h5><span>Pastikan pet house ditiap pet berbeda dan status pet house yang dipilih adalah open.</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="validationCustom01">Nama:</label>
                                    <input class="form-control" id="v-nama" type="text" placeholder="Nama"
                                        required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="validationCustom01">Alamat:</label>
                                    <input class="form-control" id="v-alamat" type="text" placeholder="Alamat"
                                        required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
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
                                    <label for="validationCustom01">Tanggal Penitipan:</label>
                                    <input class="form-control" id="datetime-local" type="date" value=""
                                        placeholder="Select a date">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    <label for="validationCustom01">Jumlah Hari:</label>
                                     <input class="form-control" id="v-jml_hari" type="text" placeholder="0 Hari"
                                        required="" readonly>
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
                                                <th scope="col">Pet House</th>
                                                <th scope="col">Jenis Pet (ex: Dog)</th>
                                                <th scope="col"><a class="btn btn-primary" id="add-btn"><i
                                                            class="fa fa-plus"></i></a></th>
                                            </tr>
                                        </thead>
                                        <tbody id="f-pet">

                                        </tbody>
                                        <tfoot>
                                            <th class="text-end" colspan='2'>Total</th>
                                            <th colspan='3'> <input class="form-control v-total" type="number"
                                                    value="0" placeholder="Total" readonly></th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="col-sm-4 col-lg-4 col-xl-4 mt-3">
                                <label for="validationCustom01">Jumlah Bayar:</label>
                                <input class="form-control jumlah-bayar" type="number" value=""
                                    placeholder="Jumlah Bayar">
                            </div>
                            <div class="col-sm-4 col-lg-4 col-xl-4 mt-3">
                                <label for="validationCustom01">Kembalian:</label>
                                <input class="form-control sisa-bayar" type="number" value="" placeholder="Kembalian"
                                    readonly>
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