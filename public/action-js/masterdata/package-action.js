let dtpr;

$(document).ready(function () {
    $(".js-example-basic-single").select2({
        dropdownParent: $("#modal-data"),
        placeholder: "Pilih Kategori",
    });
    getListData();
});

function getListData() {
    dtpr = $("#table-list").DataTable({
        ajax: {
            url: baseURL + "/loadGlobal",
            type: "POST",
            contentType: "application/json", // Set content type to JSON
            data: function (d) {
                return JSON.stringify({
                    tableName: "packages",
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
            { data: "file_path" },
            { data: "package_name" },
            { data: "category" },
            { data: "price" },
            { data: "desc" },
            { data: "id" },
        ],
        columnDefs: [
            {
                mRender: function (data, type, row) {
                    $rowData = `<img src="/template/admin2/assets/images/lightgallry/01.jpg" style="width:50px">`;
                    if(row.file_path){
                        $rowData = `<img src="/storage/${row.file_path}" style="width:50px">`;
                    }
                   
                    return $rowData;
                },
                visible: true,
                targets: 1,
                className: "text-center",
            },
            {
                mRender: function (data, type, row) {
                    $rowData = "";
                    if (row.category == "GR") {
                        $rowData = "Grooming";
                    }
                    if (row.category == "PN") {
                        $rowData = "Penitipan";
                    }
                    return $rowData;
                },
                visible: true,
                targets: 3,
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

function setImagePackage(urlFile){
    console.log(urlFile);
    $(".img-paket").prop("src",null)
    if(urlFile){
        $(".img-paket").prop("src","/storage/"+urlFile);
    }else{
        urlFile = '/template/admin2/assets/images/lightgallry/01.jpg'
        $(".img-paket").prop("src", urlFile);
    }
}

$("#form-img").change(function(){
    var file = $(this).prop('files')[0]; // Use $(this) to refer to the element that triggered the event
    if (file) {
        if (file) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
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
            imageUrl = '/template/admin2/assets/images/lightgallry/01.jpg'
            img.attr("src", imageUrl);
    }
});

let isObject = {};

function editdata(rowData) {
    isObject = rowData;

    setImagePackage(rowData.file_path)
    $("#form-name").val(rowData.package_name);
    $("#form-price").val(rowData.price);
    $("#form-desc").text(rowData.desc);
    $(".js-example-basic-single").val(rowData.category).trigger("change");

    $("#modal-data").modal("show");
}

$("#add-btn").on("click", function (e) {
    e.preventDefault();

    isObject = {};
    isObject["id"] = null;
    $("#form-name").val("");
    $("#form-price").val("");
    $("#form-desc").text("");
    setImagePackage(null);
    $(".js-example-basic-single").val("").trigger("change");

    $("#modal-data").modal("show");
});

$("#save-btn").on("click", function (e) {
    e.preventDefault();
    checkValidation();
});

function checkValidation() {
    // console.log($el);
    if($("#form-img").val == null){
        setImagePackage();
    }

    if (
        validationSwalFailed(
            (isObject["package_name"] = $("#form-name").val()),
            "Nama paket tidak boleh kosong."
        )
    )
        return false;
    if (
        validationSwalFailed(
            (isObject["category"] = $(".js-example-basic-single").val()),
            "Kategori tidak boleh kosong"
        )
    )
        return false;
    if (
        validationSwalFailed(
            (isObject["price"] = $("#form-price").val()),
            "Harga tidak boleh kosong."
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
                data: JSON.stringify({ id: data.id, tableName: "packages" }),
                dataType: "json",
                contentType: "application/json",
                beforeSend: function () {
                    Swal.fire({
                        title: "Loading",
                        text: "Please wait...",
                    });
                },
                complete: function () {},
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

function saveData() {

    // formdata
    console.log(isObject);
    var formData = new FormData();
    var file = $("#form-img")[0].files[0];
    formData.append('image', file);
    formData.append('data', JSON.stringify(isObject));

    $.ajax({
        url: baseURL + "/savePackage",
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
        complete: function () {},
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
