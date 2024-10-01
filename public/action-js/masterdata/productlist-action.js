let dtpr;

$(document).ready(function () {
    // $(".js-example-basic-single").select2({
    //     dropdownParent: $("#modal-data"),
    //     placeholder: "Pilih Kategori",
    // });

    getListData();
});

function setImagePackage(urlFile, elementID) {
    console.log(urlFile);
    elementID.prop("src", null);
    if (urlFile) {
        elementID.prop("src", urlFile);
    } else {
        urlFile = "/template/admin2/assets/images/lightgallry/01.jpg";
        elementID.prop("src", urlFile);
    }
}

function getListData() {
    dtpr = $("#table-list").DataTable({
        ajax: {
            url: baseURL + "/loadGlobal",
            type: "POST",
            contentType: "application/json", // Set content type to JSON
            data: function (d) {
                return JSON.stringify({
                    tableName: "products",
                });
            },
            dataSrc: function (response) {
                if (response.code == 0) {
                    es = response.data;
                    // console.log(es);

                    return response.data;
                } else {
                    return response;
                }
            },
            complete: function () {
                // loaderPage(false);
            },
        },
        language: {
            oPaginate: {
                sFirst: "First",
                sLast: "Last",
                sNext: ">",
                sPrevious: "<",
            },
        },
        columns: [
            {
                data: "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            { data: "product_name" },
            { data: "price" },
            { data: "desc" },
            { data: "file_path" },
            { data: "weight" },
            { data: "id" },
        ],
        columnDefs: [
            // {
            //     mRender: function (data, type, row) {
            //         $rowData = "";
            //         if (row.category == "GR") {
            //             $rowData = "Grooming";
            //         }
            //         if (row.category == "PN") {
            //             $rowData = "Penitipan";
            //         }
            //         return $rowData;
            //     },
            //     visible: true,
            //     targets: 2,
            //     className: "text-center",
            // },
            {
                mRender: function (data, type, row) {

                    return formatRupiah(
                        row.price);
                },
                visible: true,
                targets: 2,
                className: "text-center",
            },
            {
                mRender: function (data, type, row) {
                    $rowData = `<img src="/template/admin2/assets/images/lightgallry/01.jpg" style="width:50px!important">`;
                    if (row.file_path) {
                        $rowData = `<img src="/storage/${row.file_path}" style="width:110px">`;
                    }

                    return $rowData;
                },
                visible: true,
                targets: 4,
                className: "text-center",
            },
            {
                mRender: function (data, type, row) {

                    return row.weight + "gr";
                },
                visible: true,
                targets: 5,
                className: "text-center",
            },
            {
                mRender: function (data, type, row) {
                    var $rowData = `<button type="button" class="btn btn-info btn-sm mx-2 edit-btn"><i class="fa fa-pencil"></i></button>`;
                    $rowData += `<button type="button" class="btn btn-danger btn-sm delete-btn"><i class="fa fa-trash"></i></button>`;
                    return $rowData;
                },
                visible: true,
                targets: 6,
                className: "text-center",
            },
        ],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: "current" }).nodes();
            var last = null;

            $(rows)
                .find(".edit-btn")
                .on("click", function () {
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                   
                    editdata(rowData);
                });
            $(rows)
                .find(".delete-btn")
                .on("click", function () {
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                    deleteData(rowData);
                });
        },
    });
}

let isObject = {};

function editdata(rowData) {
    isObject = rowData;
    rupiahprice= formatRupiah(rowData.price)
    
    setImagePackage("/storage/" + rowData.file_path, $(".img-paket"))
    $("#form-name").val(rowData.product_name);
    $("#form-price").val(rupiahprice);
    $("#form-desc").val(rowData.desc);
    $("#form-weight").val(rowData.weight);
    $("#form-max").val(rowData.stock_maximum);
    $("#form-min").val(rowData.stock_minimum);
    $("#form-init").val(rowData.stock);
    $("#form-code").val(rowData.prod_code)
    generateProdCode()
    $("#modal-data").modal("show");
}

$("#add-btn").on("click", function (e) {
    e.preventDefault();
    isObject = {};
    isObject["id"] = null;
    setImagePackage(null, $(".img-paket"))
    setImagePackage(null, $(".img-prod"))

    $("#form-name").val("");
    $("#form-price").val("");
    $("#form-desc").val("");
    $("#form-weight").val("");
    $("#form-max").val("");
    $("#form-min").val("");
    $("#form-init").val("");
    $("#form-code").val("")

    $("#modal-data").modal("show");
});

$("#save-btn").on("click", function (e) {
    e.preventDefault();
    checkValidation();
});

function checkValidation() {
    // console.log($el);
    if (
        validationSwalFailed(
            (isObject["product_name"] = $("#form-name").val()),
            "Nama produk tidak boleh kosong."
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["prod_code"] = $("#form-code").val()),
            "Kode produk tidak boleh kosong."
        )
    )
        return false;
    pricexx = unformatRupiah($("#form-price").val());
    if (
        validationSwalFailed(
            (isObject["price"] = pricexx),
            "Harga tidak boleh kosong"
        )
    )
        return false;

    if ($("#form-img").val == null) {
        setImagePackage();
    }

    if (
        validationSwalFailed(
            (isObject["weight"] = $("#form-weight").val()),
            "Berat tidak boleh kosong"
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["min"] = $("#form-min").val()),
            "Stok minimun tidak boleh kosong"
        )
    )
        return false;
    if (
        validationSwalFailed(
            (isObject["max"] = $("#form-max").val()),
            "Stok maksimum tidak boleh kosong"
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["init"] = $("#form-init").val()),
            "Stok awal tidak boleh kosong"
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["desc"] = $("#form-desc").val()),
            "Deskripsi tidak boleh kosong"
        )
    )
        return false;
    saveData();
}

function deleteData(data) {
    swal({
        title: "Are you sure to delete ?",
        text: "You will not be able to recover this imaginary file !!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it !!",
        cancelButtonText: "No, cancel it !!",
        closeOnConfirm: !1,
        closeOnCancel: !1,
    }).then(function (e) {
        console.log(e);
        if (e.value) {
            $.ajax({
                url: baseURL + "/deleteGlobal",
                type: "POST",
                data: JSON.stringify({ id: data.id, tableName: "products" }),
                dataType: "json",
                contentType: "application/json",
                beforeSend: function () {
                    Swal.fire({
                        title: "Loading",
                        text: "Please wait...",
                    });
                },
                complete: function () { },
                success: function (response) {
                    // Handle response sukses
                    if (response.code == 0) {
                        swal("Deleted !", response.message, "success").then(
                            function () {
                                location.reload();
                            }
                        );
                    } else {
                        sweetAlert("Oops...", response.message, "error");
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    // console.log(xhr.responseText);
                    sweetAlert("Oops...", xhr.responseText, "error");
                },
            });
        } else {
            swal(
                "Cancelled !!",
                "Hey, your imaginary file is safe !!",
                "error"
            );
        }
    });
}

$("#form-img").change(function () {
    var file = $(this).prop("files")[0]; // Use $(this) to refer to the element that triggered the event
    if (file) {
        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var imageUrl = e.target.result;

                var img = $("<img>");
                img.attr("class", "img-paket");
                img.attr("src", imageUrl);
                img.attr("style", "width:30%");

                $(".img-paket").replaceWith(img);
            };

            reader.readAsDataURL(file);
        }
    } else {
        var img = $("<img>");
        img.attr("class", "img-paket");
        imageUrl = "/template/admin2/assets/images/lightgallry/01.jpg";
        img.attr("src", imageUrl);
    }
});

function saveData() {
    // formdata
    console.log(isObject);
    var formData = new FormData();
    var file = $("#form-img")[0].files[0];
    formData.append("image", file);
    formData.append("data", JSON.stringify(isObject));

    $.ajax({
        url: baseURL + "/saveProduct",
        type: "POST",
        data: formData,
        dataType: "json",
        processData: false, // Important: prevent jQuery from automatically processing the data
        contentType: false,
        beforeSend: function () {
            Swal.fire({
                title: "Loading",
                text: "Please wait...",
            });
        },
        complete: function () { },
        success: function (response) {
            // Handle response sukses
            if (response.code == 0) {
                swal("Saved !", response.message, "success").then(function () {
                    location.reload();
                });
                // Reset form
            } else {
                sweetAlert("Oops...", response.message, "error");
            }
        },
        error: function (xhr, status, error) {
            // Handle error response
            // console.log(xhr.responseText);
            sweetAlert("Oops...", xhr.responseText, "error");
        },
    });
}

function generateProdCode() {
    // formdata
    
    $.ajax({
        url: baseURL + "/getRandomCode",
        type: "POST",
        data: {},
        dataType: "json",
        data: JSON.stringify({ barcode_code: $("#form-code").val() }),
        // processData: false, // Important: prevent jQuery from automatically processing the data
        // contentType: false,
        beforeSend: function () {
            // Swal.fire({
            //     title: "Loading",
            //     text: "Please wait...",
            // });
        },
        complete: function () { },
        success: function (response) {
            // Handle response sukses
            if (response.code == 0) {
                $("#img-prod").attr("src", response.data.img_url)
                setImagePackage(response.data.img_url, $(".img-prod"))
                $("#form-code").val(response.data.prod_code)
            } else {
                sweetAlert("Oops...", response.message, "error");
            }
        },
        error: function (xhr, status, error) {
            // Handle error response
            // console.log(xhr.responseText);
            sweetAlert("Oops...", xhr.responseText, "error");
        },
    });
}

function setNullProd() {
    $("#form-code").val("")
    setImagePackage(null, $(".img-prod"))
}