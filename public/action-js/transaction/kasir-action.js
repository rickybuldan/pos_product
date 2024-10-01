
let isObject = {};
isObject.all_product = [];

$(document).ready(function () {
    $("#v-kd-barang").focus();
    $(".select2").select2();
});

$("#form-type-search").on("change", function (e) {

    $("#label-type-search").html("Kode Barang")
    $("#v-kd-barang").attr("placeholder", "Kode Barang")

    if ($(this).val() == "NAME") {
        $("#label-type-search").html("Nama Barang")
        $("#v-kd-barang").attr("placeholder", "Nama Barang")
    }

})

function addProduct(arr, code, name, price , stock) {
    let productExists = false;

    for (let item of arr) {
        if (item.kd_product === code) {
            // Jika produk sudah ada, tingkatkan jumlah dan hitung subtotal
            item.jml = parseInt(item.jml) + 1;
            item.subtotal = parseFloat(price) * parseInt(item.jml);
            productExists = true;
            break;
        }
    }

    if (!productExists) {
        arr.push({
            kd_product: code,
            nm_product: name,
            price_one: price,
            stock: stock,
            jml: 1,
            subtotal: parseFloat(price) * 1
        });
    }

    isObject.all_product = arr
    console.log(isObject.all_product,"addproduct");
    noticeIsExist()

}

function updateProductInTable(code, name, price, stock) {
    let row = $(`#f-product tr`)
        .filter(function () {
            return $(this).data('code') === code;
        })
        .first();

    if (row.length > 0) {
        let qtyInput = row.find('input[id^="product-jml"]');
        let subtotalInput = row.find('input[id^="product-subtotal"]');

        let currentQty = parseInt(qtyInput.val(), 10) || 0;
        let newQty = currentQty + 1;

        if (newQty > stock) {
            sweetAlert("Oops...", "Jumlah melebihi stok yang tersedia.", "error");
            return;
        } else {
            addProduct(isObject.all_product, code, name, price , stock); // Pastikan addProduct dipanggil di sini
        }

        qtyInput.val(newQty);
        let newSubtotal = price * newQty;
        subtotalInput.val(formatRupiah(newSubtotal));
    } else {
        let counter = $("#f-product tr").length + 1;
        let el = `
            <tr id="item${counter}" data-code="${code}">
                <td>
                    <input class="form-control form-control-lg v-prod" type="text"
                    placeholder="Nama Product" required="" value="${name}">
                </td>
                <td>
                    <input class="form-control form-control-lg v-prod" id="product-price${counter}" type="text"
                    placeholder="Price" readonly required="" value="${formatRupiah(price)}">
                </td>
                <td>
                    <input class="form-control form-control-lg v-prod" id="product-jml${counter}" type="number"
                    placeholder="Jumlah" required="" value="1" onchange="countQtyProduct(this,'${code}')">
                </td>
                <td>
                    <input class="form-control form-control-lg v-prod" id="product-stok${counter}" type="number"
                    placeholder="Stok" required="" value="${stock}" readonly>
                </td>
                <td>
                    <input class="form-control form-control-lg v-prod" id="product-subtotal${counter}" type="text"
                    placeholder="Subtotal" readonly value="${formatRupiah(price)}">
                </td>
                <td>
                    <a class="btn btn-danger" onclick="deleteItem(${counter})"><i class="fa fa-minus"></i></a>
                </td>
            </tr>`;
        $("#f-product").append(el);

        addProduct(isObject.all_product, code, name, price ,stock);
    }

    $("#v-kd-barang").val("");
}

$("#v-kd-barang").on("input", function () {
    var query = $(this).val();
    var typeSearch = $("#form-type-search").val()

    var whereQuery = "product_name LIKE '%" + query + "%'"

    if (typeSearch == "CODE") {
        whereQuery = "prod_code = '" + query + "'"
    }
    if (query.length > 2) {
        $.ajax({
            url: baseURL + "/loadGlobal",
            type: "POST",
            data: JSON.stringify({
                tableName: "products",
                where: whereQuery
            }),
            dataType: "json",
            contentType: "application/json",
            success: function (response) {
                $("#autocomplete-results").hide();
                if (response.code == 0 && response.data.length > 0) {
                    if (typeSearch == "CODE") {
                        var product = response.data[0];
                        
                        var code_product = product.prod_code;
                        var nm_product = product.product_name;
                        var price_one = product.price;
                        var stocks = product.stock;

                        updateProductInTable(code_product, nm_product, price_one, stocks);
                        $("#v-kd-barang").val("");
                    } else {
                        var resultList = "";

                        response.data.forEach(function (item) {
                            resultList += `
                                    <li class="list-group-item" 
                                        data-code="${item.prod_code}" 
                                        data-name="${item.product_name}" 
                                        data-price="${item.price}" 
                                        data-stock="${item.stock}">
                                        ${item.product_name} (${item.prod_code})
                                    </li>`;
                        });

                        $("#autocomplete-results").html(resultList).show();
                    }
                    
                } else {
                    $("#autocomplete-results").hide();
                }
                $("#v-kd-barang").focus();
            },
            error: function (xhr) {
                sweetAlert("Oops...", "Terjadi kesalahan: " + xhr.responseText, "error");
            }
        });
    } else {
        $("#autocomplete-results").hide();
    }
});

$(document).on("click", "#autocomplete-results li", function () {
    var selectedCode = $(this).data("code");
    var selectedName = $(this).data("name");
    var selectedPrice = $(this).data("price");
    var selectedStock = $(this).data("stock");

    updateProductInTable(selectedCode, selectedName, selectedPrice, selectedStock);

    $("#v-kd-barang").val("");
    $("#v-kd-barang").focus();
    $("#autocomplete-results").hide();
});

function deleteItem(params) {
    codeProduct = $(`#item${params}`).data("code");
    arr = isObject.all_product.filter(function (item) {
        return item.kd_product != codeProduct;
    });
    isObject.all_product = arr
    console.log(isObject,'delete');
    $(`#item${params}`).remove();

    noticeIsExist()
}

function countQtyProduct(element, params) {
    let qty = parseInt(element.value, 10);
    if (isNaN(qty) || qty < 1) {
        qty = 1;
        element.value = 1; 
    }
    for (let item of isObject.all_product) {

        if (item.kd_product === params) {
            
            let row = $(`#f-product tr`)
                .filter(function () {
                    return $(this).data('code') === params;
                })
                .first();

            if (row.length > 0) {
                let subtotalInput = row.find('input[id^="product-subtotal"]');
                let qtyInput = row.find('input[id^="product-jml"]');
                
                if (qty > item.stock) {
                    sweetAlert("Oops...", "Jumlah melebihi stok yang tersedia.", "error");
                    qtyInput.val(item.stock)
                    return;
                } 

                item.jml = qty;
                item.subtotal = parseFloat(item.price_one) * parseInt(item.jml);
                subtotalInput.val(formatRupiah(item.subtotal))
            }
            break;
        }
    }
    noticeIsExist()
}

function noticeIsExist() {
    el = `<tr>
            <td class="text-center notice-non-prod" colspan="5">Tidak ada barang</td>
        </tr>`
    if (isObject.all_product.length <= 0) {
        $("#f-product").html(el)
        $(".total-payment").html(formatRupiah(0))
        $(".jumlah-bayar").val(formatRupiah(0))
        $(".exchange").val(formatRupiah(0));
    } else {
        $(".notice-non-prod").remove()
    }
    countGrandTotal()
    exchangePayment()
}

$(".total-payment").html(formatRupiah(0))
$(".exchange").html(formatRupiah(0))

function countGrandTotal() {
    let grandTotal = 0;

    for (let item of isObject.all_product) {
        grandTotal += parseFloat(item.subtotal);
    }
    jml_bayar = unformatRupiah($(".jumlah-bayar").val())
    $(".grand-total").html(formatRupiah(grandTotal))
    $("#exact-money").data("unit",grandTotal)
    $("#exact-money").html(formatRupiah(grandTotal))

    isObject.price_total = grandTotal

    exchangePayment()
}

$(".payment-unit").on("click",function (e) {
    payment_tot     = unformatRupiah($(".total-payment").text())
    value           = parseFloat($(this).data("unit"))
    payment_tot     += value

    $(".total-payment").html(formatRupiah(payment_tot))
    $(".jumlah-bayar").val(formatRupiah(payment_tot))

    exchangePayment()
})


$(".jumlah-bayar").on("input", function () {
    if (isNaN(unformatRupiah($(this).val()))) {
        $(this).val(formatRupiah(0))
    }
    bayar = unformatRupiah($(this).val());

    $(this).val(formatRupiah(bayar))
    $(".total-payment").html(formatRupiah(bayar))
    exchangePayment()

});

$("#save-btn").hide();
function exchangePayment() {
    bayar       = $(".total-payment").text()
    grandTotal  = $(".grand-total").text()
    result_total = unformatRupiah(bayar) - unformatRupiah(grandTotal)
    if (unformatRupiah(grandTotal) > 0 && result_total >= 0) {    
        $("#save-btn").show();
    } else {
        $("#save-btn").hide();
    }
    $(".exchange").html(formatRupiah(result_total))
}


$("#save-btn").on("click", function (e) {
    e.preventDefault();
    checkValidation();
});

function checkValidation() {
    
    isObject["cust_nama"] = $("#v-nama").val()
    isObject["exchange"] = unformatRupiah($(".exchange").text())
    isObject["payment_amount"] = unformatRupiah($(".jumlah-bayar").val())
    
    saveData();
}

function saveData() {
    $.ajax({
        url: baseURL + "/saveTransaction",
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
        complete: function () { },
        success: function (response) {
            // Handle response sukses
            if (response.code == 0) {
                swal("Saved !", response.message, "success").then(function () {
                    
                    window.open(baseURL + "/invoice?noinvoice=" + response.data.no_transaction, '_blank');
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

