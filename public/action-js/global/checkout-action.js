$(document).ready(function () {
    $(".sel-courier").select2({
        placeholder: "Pilih Kurir",
    })
    $(".sel-provinces").select2({
        placeholder: "Pilih Provinsi",
    })
    $(".sel-cities").select2({
        placeholder: "Pilih Kota",
    })
    $(".sel-courier-package").select2({
        placeholder: "Pilih Layanan",
    })

});



loadOrderCart()

let totalShipper = 0;
let totalWeight = 0;
let amountTotal = 0

function loadOrderCart() {
    xid = uid;
    if (uid == "") {
        xid = 0;
        // sweetAlert("Oops...", 'Silakan login terlebih dahulu.', "warning");
        // return false
    }
    $.ajax({
        url: baseURL + "/home/loadGlobal",
        type: "POST",
        data: JSON.stringify({
            tableName: "carts c LEFT JOIN products p ON p.id = c.id_product",
            where: "c.id_user = " + xid + "",
        }),
        dataType: "json",
        contentType: "application/json",
        beforeSend: function () {
            // Swal.fire({
            //     title: "Loading",
            //     text: "Please wait...",
            // });
            loadBlockUI()
        },
        complete: function () {
            unblockUI()
        },
        success: function (response) {
            // console.log(response);
            // Handle response sukses
            if (response.code == 0) {
                // swal("Saved !", response.message, "success").then(function () {
                //     // location.reload();
                //     location.href = baseURL+"/invoice?noinvoice="+response.data.no_transaction
                // });
                // Reset form
                data = response.data;

                $('.pro-count').text(data.length)

                imgslider = "";
                el = "";

                let totalPrice = 0;
                let grandTotal = 0;
                let totalQuantity = 0;
                totalWeight = 0;

                for (let index = 0; index < data.length; index++) {
                    // modal
                    price = parseFloat(data[index]["price"]);
                    quantity = parseInt(data[index]["qty"]);
                    weight = parseInt(data[index]["weight"]);

                    totalPrice += price * quantity;
                    totalQuantity += quantity;
                    totalWeight += weight;

                    imgslider = `<img src="public/template/frontend/imgs/shop/product-1-1.jpg" alt="#">`;

                    if (data[index]["file_path"]) {
                        imgslider = `<img alt="Evara" src="/storage/${data[index]["file_path"]}"></img>`;
                    }

                    el = `
                                <tr>
                                    <td class="image product-thumbnail">${imgslider}</td>
                                    <td>
                                        <h5><a href="#">${data[index]["product_name"]
                        }</a></h5> <span class="product-qty">x ${data[index]["qty"]
                        } (${weight} gram)</span>
                                    </td>
                                    <td>${formatRupiah(
                            parseInt(data[index]["price"] * quantity)
                        )}</td>
                                </tr>
                               `
                }

                grandTotal = totalPrice + totalShipper
                amountTotal = grandTotal
                elfooter = `    <tr>
                                    <th>SubTotal</th>
                                    <td class="product-subtotal" colspan="2">${formatRupiah(
                    totalPrice
                )}</td>
                                </tr>
                                <tr>
                                    <th>Total Berat</th>
                                    <td colspan="2"><em>${totalWeight
                    } gram</em></td>
                                <tr>
                                    <th>Ongkos Kirim</th>
                                    <td colspan="2"><em class="fw-bolder">${formatRupiah(
                        totalShipper
                    )} </em></td>
                                </tr>
                                <tr>
                                    <th>Grand Total</th>
                                    <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">${formatRupiah(
                        grandTotal
                    )}</span></td>
                                </tr>`;
                el += elfooter;



                $('.order_table tbody').html(el);
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

$('.sel-courier, .sel-cities').on('change', function () {
    objcekongkir = {}
    courier = $('.sel-courier').val();
    destination = $('.sel-cities').val();
    if (courier && destination) {
        origin = 168 // kapuas hulu
        weight = totalWeight
        objcekongkir.courier = courier
        objcekongkir.destination = destination
        objcekongkir.origin = origin
        objcekongkir.weight = weight
        checkCost(objcekongkir)
    }
});

arrserv = []
function checkCost(obj) {
    $(".detail-service").empty()
    $.ajax({
        url: baseURL + "/home/checkCost",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({ obj }),
        beforeSend: function () {
            // Swal.fire({
            //     title: "Loading",
            //     text: "Please wait...",
            // });
            loadBlockUI()
        },
        complete: function () {
            unblockUI()
        },
        success: function (response) {
            $(".sel-courier-package").empty()
            if (response.code == 0) {
                arrserv = []
                data = response.data[0].costs
                nameser = response.data[0].name
                for (let index = 0; index < data.length; index++) {
                    service = data[index]['service']
                    desc = data[index]['description']
                    price = data[index]['cost'][0]['value']
                    estim = data[index]['cost'][0]['etd'] + " Hari"
                    obj = {
                        nm_serv: nameser,
                        service: service,
                        desc: desc,
                        price: parseInt(price),
                        estim: estim,
                    }
                    arrserv.push(
                        obj
                    )
                }


                const res = arrserv.map(function (item) {
                    return {
                        id: item.service,
                        text: item.service + "-" + formatRupiah(item.price),
                    };
                });

                $(".sel-courier-package").select2({
                    // theme: "bootstrap-5",
                    // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                    data: res,
                    placeholder: "Pilih Layanan",
                    // dropdownParent: $("#modal-data"),
                });


                $(".sel-courier-package").val("").trigger("change");
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

loadProvinces()
function loadProvinces() {

    $.ajax({
        url: baseURL + "/home/loadProvinces",
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        beforeSend: function () {
            // Swal.fire({
            //     title: "Loading",
            //     text: "Please wait...",
            // });
            loadBlockUI()
        },
        complete: function () {
            unblockUI()
        },
        success: function (response) {
            // console.log(response);
            // Handle response sukses
            if (response.code == 0) {
                var provinces = response.data
                const res = response.data.map(function (item) {
                    return {
                        id: item.province_id,
                        text: item.province,
                    };
                });

                $(".sel-provinces").select2({
                    // theme: "bootstrap-5",
                    // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',

                    data: res,
                    placeholder: "Pilih Provinsi",
                    // dropdownParent: $("#modal-data"),
                });


                $(".sel-provinces").val("").trigger("change");


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

$(".sel-provinces").on('select2:select', function (e) {
    var selectedValue = e.params.data.id;
    loadCities(selectedValue)
});

$(".sel-courier-package").on('select2:select', function (e) {
    var selectedValue = e.params.data.id;
    el = ''
    totalShipper = 0
    for (let index = 0; index < arrserv.length; index++) {
        serv = arrserv[index]['service'];
        desc = arrserv[index]['desc'];
        cost = arrserv[index]['price'];
        estim = arrserv[index]['estim'];

        if (serv == selectedValue) {
            totalShipper = cost
            nm_serv = arrserv[index]['nm_serv'];
            el += `
                <div class="border p-3 border-3">
                    <b class="fw-bolder">${nm_serv} - ${serv}</b>
                    <p class="fw-light">Estimasi Kedatangan ${estim}</p>
                    <p>${formatRupiah(cost)}</p>
                    <p>${desc}</p>
                </div> `
        }
    }

    $(".detail-service").html(el)
    loadOrderCart()

});

function loadCities(id) {

    $.ajax({
        url: baseURL + "/home/loadCities",
        type: "POST",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({ province: id }),
        beforeSend: function () {
            // Swal.fire({
            //     title: "Loading",
            //     text: "Please wait...",
            // });
            loadBlockUI()
        },
        complete: function () {
            unblockUI()
        },
        success: function (response) {
            // console.log(response);
            if (response.code == 0) {
                $(".sel-cities").empty()
                var provinces = response.data
                const res = response.data.map(function (item) {
                    return {
                        id: item.city_id,
                        text: item.city_name,
                    };
                });

                $(".sel-cities").select2({
                    // theme: "bootstrap-5",
                    // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                    placeholder: "Pilih Kota",
                    data: res,
                    // dropdownParent: $("#modal-data"),
                });
                $(".sel-cities").show()

                $(".sel-cities").val("").trigger("change");

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

loadUserOrder()
function loadUserOrder() {
    xid = uid;
    if (uid == "") {
        xid = 0;
        // sweetAlert("Oops...", 'Silakan login terlebih dahulu.', "warning");
        // return false
    }
    $.ajax({
        url: baseURL + "/home/loadGlobal",
        type: "POST",
        data: JSON.stringify({
            tableName: "users u",
            where: "u.id = " + xid + "",
        }),
        dataType: "json",
        contentType: "application/json",
        beforeSend: function () {
            // Swal.fire({
            //     title: "Loading",
            //     text: "Please wait...",
            // });
            loadBlockUI()
        },
        complete: function () {
            unblockUI()
        },
        success: function (response) {
            // console.log(response);
            // Handle response sukses
            if (response.code == 0) {
                // swal("Saved !", response.message, "success").then(function () {
                //     // location.reload();
                //     location.href = baseURL+"/invoice?noinvoice="+response.data.no_transaction
                // });
                // Reset form
                data = response.data;
                $('#f-name').val(data[0].name)
                $('#f-phone').val(data[0].phone)
                $('#f-email').val(data[0].email)
                $('#f-address').val(data[0].address)
                $('#f-note-order').html()
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

isObject = {}
function checkValidation() {
    // console.log($el);
    if (
        validationSwalFailed(
            (isObject["name"] = $("#f-name").val()),
            "Nama tidak boleh kosong."
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["email"] = $("#f-phone").val()),
            "Phone tidak boleh kosong."
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["province"] = $(".sel-provinces").val()),
            "Provinsi tidak boleh kosong."
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["citie"] = $(".sel-cities").val()),
            "Kota tidak boleh kosong."
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["address"] = $("#f-address").val()),
            "Alamat tidak boleh kosong."
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["courier"] = $(".sel-courier").val()),
            "Kurir tidak boleh kosong."
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["service"] = $(".sel-courier-package").val()),
            "Layanan tidak boleh kosong."
        )
    )
        return false;

    isObject['notes'] = $("#f-note-order")

}

$('#payButton').click(function () {
    if (checkValidation != false) {
        $.ajax({
            url: '/createPayment',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                amount: amountTotal,
            }),
            
            success: function (response) {
                console.log('Payment creation response:', response);
                var snapToken = response.snap_token;
                snap.pay(snapToken, {
                    onSuccess: function(result){console.log('success');console.log(result);},
                    onPending: function(result){console.log('pending');console.log(result);},
                    onError: function(result){console.log('error');console.log(result);},
                    onClose: function(){console.log('customer closed the popup without finishing the payment');}
                  })
            },
            error: function (xhr, status, error) {
                console.error('Error creating payment:', error);
                console.error('XHR status:', status);
                console.error('XHR response:', xhr.responseText);
            }
        });
    }
});
