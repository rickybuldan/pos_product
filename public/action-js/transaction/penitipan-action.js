// let dtpr;
let isObject = {}
let startDate, endDate, diffDays;

$(document).ready(function () {
    flatpickr("#datetime-local", {
        enableTime: false,
        minDate: "today",
        mode:"range",
        dateFormat: "Y-m-d",
        maxDate: new Date().fp_incr(7), 
        onClose: function (selectedDates) {
          if (selectedDates.length === 2) {
            startDate = selectedDates[0];
            endDate = selectedDates[1];
            const timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
            diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
            countTotal()
            // console.log("Selisih hari:", diffDays);
            $("#v-jml_hari").val(diffDays + ' Hari');
          }
        },
    });
});

counter = 0;
$("#add-btn").on("click", function (e) {
    e.preventDefault();

    counter++;

    el = ` <tr id="item${counter}">
    <td><input class="form-control form-control-lg v-pet pet-name" type="text"
            placeholder="Nama Pet" required=""></td>
    <td><select class="form-control pet-package" id="sel-package${counter}">
    </select></td>
    <td>
    <select class="form-control pet-house" id="sel-house${counter}">
    </select></td>
    <td>
    <select class="form-control form-control-lg v-pet pet-type" id="sel-petitem${counter}">
    </select></td>
    <td><a class="btn btn-danger" onclick="deleteItem(${counter})"><i
                class="fa fa-minus"></i></a></td>
    </tr>`;
    $("#f-pet").append(el);

    loadPackage(counter);
    loadHouse(counter);
    loadPet(counter)

});

$('#f-pet').on('change', '.pet-package', function () {
    if($(this).val()){
        countTotal();
    }
});

$("#save-btn").hide();
$(".jumlah-bayar").hide();
$(".sisa-bayar").hide();

function countTotal() {
    let total_price = 0;
    $('tr[id^="item"]').each(function (index) {
        
        val = $(this).find('.pet-package').val()
        if (val) { // check if elid is not null or undefined
            selectedOptionText=$(this).find('.pet-package :selected').text()
            arrPrice = selectedOptionText.split("-");
            total_price += parseInt(arrPrice[1]);
        }
      
    });

    
    $(".v-total").val(total_price)
    if(total_price > 0 ){
        // $("#save-btn").show();
        $(".jumlah-bayar").val(0).show();
        $(".sisa-bayar").val(0).show();
    }
}

$('.jumlah-bayar').on('input', function () {

    if( $(this).val() > 0){
        hasil = $(this).val() - parseInt($(".v-total").val()) 
        $(".sisa-bayar").val(hasil).show();
        if(hasil >= 0 ){
            $("#save-btn").show();
        }else{
            $("#save-btn").hide();
        }
    }else{
        $(".sisa-bayar").val(0).show();
        $("#save-btn").hide();
    }
});


function deleteItem(params) {
    $(`#item${params}`).remove()
}


$("#save-btn").on("click", function (e) {

    e.preventDefault();
    let dataPet = [];
    let total_price = 0;

    let uniqueHouses = new Set();
    $('tr[id^="item"]').each(function (index) {
        let name    = $(this).find(".pet-name").val();
        let package = $(this).find(".pet-package").val();
        let house   = $(this).find(".pet-house").val();
        let type    = $(this).find(".pet-type").val();
        var selectedOptionText = $('.pet-package :selected').text();
        var selectedOptionText2 = $('.pet-house :selected').text();

        arrPrice = selectedOptionText.split("-")
        total_price += parseInt(arrPrice[1]);

        arrHouse = selectedOptionText2.split("-")
        defineHouse = arrHouse[1]

        if (defineHouse =="Booked"){
            if (validationSwalFailed(null, "House Pets masih digunakan."))
			
            return false;
        }
        if(uniqueHouses.has(house)){
            if (validationSwalFailed(null, "House Pets harus berbeda."))
			
            return false;
        }

        if (name && package && type && house && !uniqueHouses.has(house) && defineHouse !="Booked") {
            let pet = {
                name: name,
                package: package,
                house: house,
                type: type,
            };
            dataPet.push(pet);
        }
    });

    isObject.transaction_type = "PN";
    isObject.price_total = total_price;
    isObject.date = startDate;
    isObject.end_date = endDate;
    console.log(isObject);
    checkValidation(dataPet);
});

function checkValidation(dataPet) {
    if (
        validationSwalFailed(
            (isObject["name"] = $("#v-nama").val()),
            "Nama tidak boleh kosong."
        )
    )
        return false;

    if (
        validationSwalFailed(
            (isObject["address"] = $("#v-alamat").val()),
            "Alamat tidak boleh kosong."
        )
    )
        return false;
    if (
        validationSwalFailed(
            (isObject["email"] = $("#v-email").val()),
            "Email tidak boleh kosong."
        )
    )
        return false;

    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(isObject["email"])) {
        validationSwalFailed(
            null,
            "Format email tidak valid. Gunakan format: example@example.com"
        );
        return false;
    }
    // if (
    //     validationSwalFailed(
    //         (isObject["phone"] = $("#v-phone").val()),
    //         "Nama tidak boleh kosong."
    //     )
    // )
    //     return false;
    isObject["phone"] = $("#v-phone").val();

    if (validationSwalFailed(dataPet.length, "Silakan periksa kembali form pets."))
        return false;


    isObject["data_pet"] = dataPet;

    saveData();
}

function saveData() {

    $.ajax({
        url: baseURL + "/saveTransactionPenitipan",
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
                    // location.reload();
                    location.href = baseURL + "/invoice?noinvoice=" + response.data.no_transaction
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

async function loadPackage(param) {
    try {

        const response = await $.ajax({
            url: baseURL + "/loadGlobal",
            type: "POST",
            data: JSON.stringify({ tableName: 'packages', where:"category = 'PN'" }),
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
                text: item.package_name + "-" + item.price,
            };
        });


        $(`#sel-package${param}`).select2({
            // theme: "bootstrap-5",
            // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',

            data: res,
            placeholder: "Pilih Paket/Layanan",
            // dropdownParent: $("#modal-data"),
        });
        $(`#sel-package${param}`).val("").trigger("change");

    } catch (error) {
        sweetAlert("Oops...", error.responseText, "error");
    }
}

async function loadHouse(param) {
    try {

        const response = await $.ajax({
            url: baseURL + "/loadStatusHouse",
            type: "POST",
            data: JSON.stringify({ tableName: 'houses'}),
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
                text: item.house_name + "-" + item.status,
            };
        
        });


        $(`#sel-house${param}`).select2({
            // theme: "bootstrap-5",
            // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',

            data: res,
            placeholder: "Pilih Pet House",
            // dropdownParent: $("#modal-data"),
        });
        $(`#sel-house${param}`).val("").trigger("change");

    } catch (error) {
        sweetAlert("Oops...", error.responseText, "error");
    }
}


async function loadPet(param) {
    try {

        const response = await $.ajax({
            url: baseURL + "/loadGlobal",
            type: "POST",
            data: JSON.stringify({ tableName: 'pets'}),
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
                id: item.pet_name,
                text: item.pet_name,
            };
        });



        $(`#sel-petitem${param}`).select2({
            // theme: "bootstrap-5",
            // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',

            data: res,
            placeholder: "Pilih Pet",
            // dropdownParent: $("#modal-data"),
        });
        $(`#sel-petitem${param}`).val("").trigger("change");

    } catch (error) {
        sweetAlert("Oops...", error.responseText, "error");
    }
}
