$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

loadInvoice();

function loadInvoice() {
    data = { noinvoice: no_invoice };

    $.ajax({
        url: baseURL + "/invoice",
        type: "POST",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        beforeSend: function () {
            // Swal.fire({
            //     title: "Loading",
            //     text: "Please wait...",
            //     showConfirmButton: false, // Menyembunyikan tombol OK
            // });
        },
        complete: function () {
            // swal.close();
        },
        success: function (response) {
            console.log(response);

            if (response.code == 0) {
                console.log(response);
                data = response.data;
                console.log(data);
                $(".customer_name").text(data[0].customer_name);
                $(".customer_address").text(data[0].address);
                $(".customer_phone").text(data[0].phone);
                $(".no_invoice").text("#" + data[0].no_transaction);
                $(".date_invoice").text(data[0].created_date_formatted);
                $(".kasir-name").text("Kasir: "+data[0].kasir);
                
                $(".v-total-payment").text(formatRupiah(parseFloat(data[0].payment_amount)));
                $(".v-total-exchange").text(formatRupiah(parseFloat(data[0].exchange)));
                
                $(".v-total-amount").html(formatRupiah(data[0].price_total));
                $("#detail_invoice").empty();
                el =""
                data.forEach(function (item) {
                    el += `<tr>
                            <td
                                style="font-size: 10px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:10px ">
                                ${item.product_name}
                            </td>
                            <td
                                style="font-size: 10px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:10px ">
                                ${item.quantity}
                            </td>
                            <td
                                style="font-size: 10px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:10px ">
                                ${formatRupiah(item.unit_price)}
                            </td>
                            <td
                                style="font-size: 10px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left;">
                                ${formatRupiah(item.sub_total)}
                            </td>
                        </tr>
                        `
                });
                el+=`<tr>
                        <td height="2" colspan="100" style=" border-bottom:1px solid #e4e4e4 "></td>
                    </tr>`;
                $("#detail_invoice").html(el);
            } else {
                // sweetAlert("Oops...", response.info, "error");
                console.log(response.info);
            }
        },
        error: function (xhr, status, error) {
            // Handle error response
            console.log(xhr.responseText);
            // sweetAlert("Oops...", xhr.responseText, "error");
        },
    });
}

function printElement() {
    window.print();
}