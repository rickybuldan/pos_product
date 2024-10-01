@extends('layout.default')
@push('after-style')
    @foreach ($cssFiles as $file)
        <link rel="stylesheet" href="{{ $file }}">
    @endforeach
@endpush
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header mt-2 flex-wrap d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Menu Role Access</h4>
                        <p class="m-0 subtitle">Setting Permission</p>
                    </div>
                    <ul class="nav nav-pills justify-content-end mb-4">
                        <li class=" nav-item">
                            <a href="#navpills2-1" class="nav-link active permission-btn" data-bs-toggle="tab"
                                aria-expanded="false">Permission Menu</a>
                        </li>
                        <li class="nav-item">
                            <a href="#navpills2-2" class="nav-link jsondata-btn" data-bs-toggle="tab"
                                aria-expanded="false">Permission JSON data</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div id="navpills2-1" class="tab-pane active">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="table-list" class="datatables">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Header Name</th>
                                                    <th>Menu Name</th>
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
                        <div id="navpills2-2" class="tab-pane">
                            <div class="row">
                                <div class="col-md-12">
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
        </div>
    </div>
    <div class="modal fade" id="modal-data" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Setting Menu Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form p-1">
                        <form id="base-form">
                            {{-- <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Name</label>
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
                                    <input id="form-password" type="password" class="form-control" placeholder="Password">
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
                                <div class="col-sm-9">
                                    <select id="form-role">

                                    </select>
                                </div>
                            </div> --}}

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="save-btn" class="btn btn-primary" onclick="saveConfirm(1)">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="basic-form p-1">
                        <form id="base-form2">
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Header Name</label>
                                <div class="col-sm-9">
                                    <input id="form-mid" type="hidden" class="form-control" placeholder="">
                                    <input id="form-header" type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Menu Name</label>
                                <div class="col-sm-9">
                                    <input id="form-menu" type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="save-btn" class="btn btn-primary" onclick="saveConfirm(2)">Save</button>
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
@endpush

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
                                <li class="nav-item"><a class="nav-link active" id="pills-aboutus-tab" data-bs-toggle="pill"
                                        href="#pills-aboutus" role="tab" aria-controls="pills-aboutus"
                                        aria-selected="true">Permission Menu</a></li>
                                <li class="nav-item"><a class="nav-link" id="pills-contactus-tab" data-bs-toggle="pill"
                                        href="#pills-contactus" role="tab" aria-controls="pills-contactus"
                                        aria-selected="false">Permission JSON</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-aboutus" role="tabpanel"
                                aria-labelledby="pills-aboutus-tab">
                                <div class="table-responsive  theme-scrollbar">
                                    <table id="table-list" class="dataTables_wrapper">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Header Name</th>
                                                <th>Menu Name</th>
                                                <th>URL</th>
                                                <th>Action</th>
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
                                    <label class="col-sm-3 col-form-label">Header Name</label>
                                    <div class="col-sm-9">
                                        <input id="form-mid" type="hidden" class="form-control" placeholder="">
                                        <input id="form-header" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Menu Name</label>
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
                            onclick="saveConfirm(2)">Save</button>

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
