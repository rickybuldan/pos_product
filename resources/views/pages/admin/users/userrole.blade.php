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
                            <ul class="nav nav-pills nav-primary" id="pills-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active permission-btn btn btn-dark" id="pills-aboutus-tab" data-bs-toggle="pill"
                                        href="#pills-aboutus" role="tab" aria-controls="pills-aboutus"
                                        aria-selected="true">Hak Akses Menu</a></li>
                                <li class="nav-item d-none"><a class="nav-link  jsondata-btn" id="pills-contactus-tab" data-bs-toggle="pill"
                                        href="#pills-contactus" role="tab" aria-controls="pills-contactus"
                                        aria-selected="false">Permission JSON</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="list-role" class="row">
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-aboutus" role="tabpanel"
                                aria-labelledby="pills-aboutus-tab">
                                <div class="table-responsive theme-scrollbar">
                                    <table id="table-list" class="dataTables_wrapper">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Header</th>
                                                <th>Nama Menu</th>
                                                <th>URL</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contactus" role="tabpanel"
                                aria-labelledby="pills-contactus-tab">
                                <div class="table-responsive">
                                    <table id="table-list-json" class="datatables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>URL</th>
                                                <th>Action</th>
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
            </div>
        </div>
        <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalCenter1"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">View Data</h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form p-1">
                            <form id="base-form2">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nama Header</label>
                                    <div class="col-sm-9">
                                        <input id="form-mid" type="hidden" class="form-control" placeholder="">
                                        <input id="form-header" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nama Menu</label>
                                    <div class="col-sm-9">
                                        <input id="form-menu" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="save-btn" class="btn btn-primary"
                            onclick="saveConfirm(2)">Simpan</button>

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
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form p-1">
                            <form id="base-form">
                               
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="save-btn" class="btn btn-primary"
                            onclick="saveConfirm(1)">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-edit-role" tabindex="-1" aria-labelledby="exampleModalCenter1"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">View Data</h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="basic-form p-1">
                            <form id="base-formx">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nama Role</label>
                                    <div class="col-sm-9">
                                        <input id="form-rid" type="hidden" class="form-control" placeholder="">
                                        <input id="form-role-name" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="save-btn" class="btn btn-primary"
                            onclick="saveConfirm(3)">Simpan</button>
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
