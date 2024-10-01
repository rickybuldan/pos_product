
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
                                <a class="btn btn-dark" id="add-btn"><i class="fa fa-plus"></i> Tambah</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive  theme-scrollbar">
                            <table id="table-list" class="dataTables_wrapper">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email Address</th>
                                        <th>Role</th>
                                        <th>Status</th>
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
        <div class="modal fade" id="modal-data" tabindex="-1" aria-labelledby="exampleModalCenter1"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">View Data</h5>
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                    <div class="modal-body">
                        <div class="basic-form">
                            <form>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input id="form-name" type="text" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input id="form-email" type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input id="form-password" type="password" class="form-control"
                                            placeholder="Password">
                                    </div>
                                </div>
                                <fieldset class="mb-3">
                                    <div class="row">
                                        <label class="col-form-label col-sm-3 pt-0">Status</label>
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="form-status"
                                                    value="1">
                                                <label class="form-check-label">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="form-status"
                                                    value="0">
                                                <label class="form-check-label">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9 mb-0">
                                        <select class="form-select form-select-sm" id="form-role">

                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="save-btn" class="btn btn-primary">Simpan</button>
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
