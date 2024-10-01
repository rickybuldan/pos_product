let dtpr;

$(document).ready(function () {
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
                    tableName: "transactions",
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
            { data: "created_at" },
            { data: "no_transaction" },
            { data: "customer_name", defaultContent: "-" },
            { data: "price_total" },
            { data: "status" },
            { data: "id" },
        ],
        columnDefs: [
            {
                mRender: function (data, type, row) {
                    return formatRupiah(row.price_total);
                },
                visible: true,
                targets: 4,
                className: "text-center",
            },
            {
                mRender: function (data, type, row) {
                    $rowData = ``;
                    if (row.transaction_type == "GR") {
                        $rowData = `<span class="badge rounded-pill badge-primary">Grooming</span>`;
                    }
                    if (row.transaction_type == "PN") {
                        $rowData = `<span class="badge rounded-pill badge-success">Penitipan</span>`;
                    }

                    if (row.status == 10) {
                        $rowData += `<span class="badge rounded-pill badge-primary">Selesai</span>`;
                    }
                    if (row.status == 20) {
                        $rowData += `<span class="badge rounded-pill badge-warning">Booked/Paid</span>`;
                    }
                    if (row.status == 30) {
                        $rowData += `<span class="badge rounded-pill badge-info">Proses</span>`;
                    }
                    if (row.status == 40) {
                        $rowData += `<span class="badge rounded-pill badge-danger">Unpaid</span>`;
                    }
                    if (row.status == 50) {
                        $rowData += `<span class="badge rounded-pill badge-secondary">Cancel</span>`;
                    }
                    return $rowData;
                },
                visible: true,
                targets: 5,
                className: "text-center",
            },

            {
                mRender: function (data, type, row) {
                    $rowData = "";
                    $rowData += `<button type="button" class="btn btn-info btn-sm invoice-btn"><i class="fa fa-list-alt"></i> Invoice</button>`;
                    // if (row.bukti) {
                    //     $rowData += ` <a href="/storage/${row.bukti}" class="btn btn-warning btn-sm"><i class="fa fa-list-alt"></i> Lihat Bukti</a>`;
                    // }
                    if (row.status == 10) {
                        // $rowData += ` <button type="button" class="btn btn-info btn-sm process-btn"><i class="fa fa-check"></i> Proses</button>`;
                        $rowData += ` <button type="button" class="btn btn-secondary btn-sm cancel-btn"><i class="fa fa-ban"></i> Batal</button>`;
                    }

                    // if (row.status == 30) {
                    //     $rowData += ` <button type="button" class="btn btn-primary btn-sm done-btn"><i class="fa fa-file-text-o"></i> Selesai</button>`;
                    // }

                    // if (row.status == 40) {
                    //     $rowData += ` <button type="button" class="btn btn-danger btn-sm paid-btn"><i class="fa fa-clock-o"></i> Bayar</button>`;
                    //     $rowData += ` <button type="button" class="btn btn-secondary btn-sm cancel-btn"><i class="fa fa-ban"></i> Batal</button>`;
                    // }

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
                .find(".done-btn")
                .on("click", function () {
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                    saveChangeStatus(rowData, 10);
                });

            $(rows)
                .find(".paid-btn")
                .on("click", function () {
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                    saveChangeStatus(rowData, 20);
                });

            $(rows)
                .find(".process-btn")
                .on("click", function () {
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                    // if (rowData.karyawan_id == null && rowData.transaction_type == "GR") {
                    //     showModalKaryawan(rowData)
                    // } else {
                    //     saveChangeStatus(rowData, 30);
                    // }

                    saveChangeStatus(rowData, 30);
                });

            $(rows)
                .find(".cancel-btn")
                .on("click", function () {
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                    saveChangeStatus(rowData, 50);
                });

            $(rows)
                .find(".invoice-btn")
                .on("click", function () {
                    var tr = $(this).closest("tr");
                    var rowData = dtpr.row(tr).data();
                    getinvoice(rowData);
                });
        },
    });
}

function getinvoice(params) {
    location.href = baseURL + "/invoice?noinvoice=" + params.no_transaction;
}

function saveChangeStatus(param, status) {
    data = {};
    data.status = status;
    data.id = param.id;
    $.ajax({
        url: baseURL + "/changeStatusTransaction",
        type: "POST",
        data: JSON.stringify(data),
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

let isObject = {};
function showModalKaryawan(params) {
    isObject = {};
    isObject.id = params.id;
    isObject.status = 30;
    $("#setassign-karyawan").modal("show");
    loadKaryawan();
}

async function loadKaryawan() {
    try {
        const response = await $.ajax({
            url: baseURL + "/loadGlobal",
            type: "POST",
            data: JSON.stringify({ tableName: "users", where: "role_id = 8" }),
            dataType: "json",
            contentType: "application/json",
            beforeSend: function () {
                // Swal.fire({
                //     title: "Loading",
                //     text: "Please wait...",
                // });
            },
        });

        const res = response.data.map(function (item) {
            return {
                id: item.id,
                text: item.name,
            };
        });

        $(`#sel-karyawan`).select2({
            // theme: "bootstrap-5",
            // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',

            data: res,
            placeholder: "Pilih Karyawan",
            // dropdownParent: $("#modal-data"),
        });
        $(`#sel-karyawan`).val("").trigger("change");
    } catch (error) {
        sweetAlert("Oops...", error.responseText, "error");
    }
}

$("#save-btn").on("click", function (e) {
    e.preventDefault();
    checkValidation();
});

function checkValidation() {
    // console.log($el);
    if (
        validationSwalFailed(
            (isObject["karyawan_id"] = $("#sel-karyawan").val()),
            "Karyawan harus dipilih."
        )
    )
        return false;

    saveData();
}

function saveData() {
    swal({
        title: "Are you sure to save data ?",
        text: "You will not be able to recover this imaginary file !!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, save it !!",
        cancelButtonText: "No, cancel it !!",
        closeOnConfirm: !1,
        closeOnCancel: !1,
    }).then(function (e) {
        console.log(e);
        if (e.value) {
            $.ajax({
                url: baseURL + "/assignKaryawanTransaction",
                type: "POST",
                data: JSON.stringify(isObject),
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
                        swal("Saved !", response.message, "success").then(
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
