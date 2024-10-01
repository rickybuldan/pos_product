// $(document).ready(function () {

// });
loadProduct("featured");
loadCart()

function loadProduct(x) {
    $.ajax({
        url: baseURL + "/home/loadGlobal",
        type: "POST",
        data: JSON.stringify({ tableName: "products", type: x }),
        dataType: "json",
        contentType: "application/json",
        beforeSend: function () {
            // Swal.fire({
            //     title: "Loading",
            //     text: "Please wait...",
            // });
        },

        complete: function () {},
        success: function (response) {
            console.log(response);
            // Handle response sukses
            if (response.code == 0) {
                // swal("Saved !", response.message, "success").then(function () {
                //     // location.reload();
                //     location.href = baseURL+"/invoice?noinvoice="+response.data.no_transaction
                // });
                // Reset form
                data = response.data;

                imgslider = "";
                el = "";

                for (let index = 0; index < data.length; index++) {
                    // modal
                    // imgslider += `<figure class="border-radius-10">
                    //                 <img src="/storage/${data[index]['file_path']}" alt="product image">
                    //             </figure>`
                    console.log(data[index]);
                    el += ` <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img"
                                                    src="/storage/${
                                                        data[index]["file_path"]
                                                    }"
                                                    alt="">
                                                <img class="hover-img"
                                                    src="/storage/${
                                                        data[index]["file_path"]
                                                    }"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1 d-none">
                                            <a aria-label="Quick view" class="action-btn hover-up" onclick="selectedProduct(${
                                                data[index]["id"]
                                            })" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i>
                                            </a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">Kacamata</a>
                                        </div>
                                        <h2><a href="shop-product-right.html">${
                                            data[index]["product_name"]
                                        }</a></h2>
                                        
                                        <div class="product-price">
                                            <span>${formatRupiah(
                                                data[index]["price"]
                                            )}</span>
                                        </div>
                                        <div class="product-action-1 show">
                                            <a aria-label="Add To Cart" class="action-btn hover-up" onclick="saveCart(${
                                                data[index]["id"]
                                            },1)"><i
                                                    class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                }
                if (x == "featured") {
                    $(".product-featured").html(el);
                } else {
                    $(".product-new-added").html(el);
                }
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

function selectedProduct(params) {
    id = params;

    $.ajax({
        url: baseURL + "/home/loadGlobal",
        type: "POST",
        data: JSON.stringify({ tableName: "products", where: "id = " + id }),
        dataType: "json",
        contentType: "application/json",
        beforeSend: function () {
            // Swal.fire({
            //     title: "Loading",
            //     text: "Please wait...",
            // });
        },

        complete: function () {},
        success: function (response) {
            console.log(response);
            // Handle response sukses
            if (response.code == 0) {
                data = response.data;

                $(".product-name").html(data[0]["product_name"]);
                $(".product-brands").html(data[0]["brands"]);
                $(".product-price span").html(formatRupiah(data[0]["price"]));
                $(".product-desc").html(data[0]["desc"]);

                imgpath = data[0]["file_path"];
                console.log(imgpath);
                if (imgpath) {
                    img = `  <figure class="border-radius-10">
                                <img src="storage/${imgpath}" alt="product image">
                            </figure>`;

                    $(".product-image-slider").html(img);
                }
            } else {
                sweetAlert("Oops...", response.message, "error");
            }
        },
        error: function (xhr, status, error) {
            sweetAlert("Oops...", xhr.responseText, "error");
        },
    });
}

// function checkValidation() {
//     // console.log($el);
//     if (
//         validationSwalFailed(
//             (isObject["pet_name"] = $("#form-name").val()),
//             "Nama pet tidak boleh kosong."
//         )
//     )
//         return false;

//     // if (
//     //     validationSwalFailed(
//     //         (isObject["desc"] = $("#form-desc").val()),
//     //         "Deskripsi tidak boleh kosong"
//     //     )
//     // )
//     //     return false;
//     saveData();
// }

function deleteCart(id_product) {
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
                url: baseURL + "/home/deleteGlobal",
                type: "POST",
                data: JSON.stringify({ id: id_product, tableName: "carts" }),
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
                                // location.reload();
                                loadCart()
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

function saveCart(id_product, qty) {
    isObject = {};

    if (uid == "") {
        sweetAlert("Oops...", "Silakan login terlebih dahulu.", "warning");
        return false;
    }

    isObject.id_product = id_product;
    isObject.id_user = uid;
    isObject.qty = qty;

    $.ajax({
        url: baseURL + "/home/saveCart",
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
                swal("Saved !", response.message, "success").then(function () {
                    // location.reload();
                    loadCart()
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

// $(".mini-cart-icon" ).hover(
//     loadCart()
// );
$("a.mini-cart-icon").mouseenter(function () {
    loadCart();
});


