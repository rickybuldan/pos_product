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
                        <div class="d-flex justify-content-between">
                            <div class="p-2">
                                <h5>{{ $subtitle }}</h5>
                            </div>
                            <div class="p-2">
                                <a class="btn btn-primary" id="add-btn"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive  theme-scrollbar">
                            <table id="table-list" class="display nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Berat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-data" tabindex="-1" aria-labelledby="exampleModalCenter1" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Form Data</h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form">

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Nama Produk</label>
                                <div class="col-sm-9">
                                    <input id="form-name" type="text" class="form-control" placeholder="Nama">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Kode Produk</label>
                                <div class="col-sm-5">
                                    <input id="form-code" type="text" class="form-control" placeholder="Kode Produk">
                                </div>
                                <div class="col-sm-3">
                                    <div class="btn-group btn-group-square" role="group" aria-label="Basic example">
                                        <button class="btn btn-danger" type="button" onclick="setNullProd()"><i class="fa fa-eraser" aria-hidden="true"></i></button>
                                        <button class="btn btn-primary" type="button" onclick="generateProdCode()"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3 row d-flex justify-content-center">
                                <img src="/template/admin2/assets/images/lightgallry/01.jpg" style="width:50% "
                                    class="img-prod" itemprop="thumbnail" alt="Image description">
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-9">
                                    <input id="form-price" type="text" oninput="formatRupiahByElement(this)" class="form-control" placeholder="Harga">
                                </div>
                            </div>
                            <div class="mb-3 row d-flex justify-content-center">
                                <img src="/template/admin2/assets/images/lightgallry/01.jpg" style="width:30% "
                                    class="img-paket" itemprop="thumbnail" alt="Image description">
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Foto</label>
                                <div class="col-sm-9">
                                    <input id="form-img" type="file" accept="image/*" class="form-control"
                                        placeholder="Harga">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Berat</label>
                                <div class="col-sm-9">
                                    <input id="form-weight" type="number" class="form-control" placeholder="Gram">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Stok</label>
                                <div class="col-sm-3">
                                    <input id="form-min" type="number" class="form-control" placeholder="Minimum">
                                </div>
                                <div class="col-sm-3">
                                    <input id="form-max" type="number" class="form-control" placeholder="Maksimum">
                                </div>
                                <div class="col-sm-3">
                                    <input id="form-init" type="number" class="form-control" placeholder="Awal">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Deskripsi</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="form-desc" placeholder="Deskripsi" required=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="save-btn" class="btn btn-primary">Save</button>
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
