// let dtpr;
let isObject = {}
let startDate
$(document).ready(function () {
    flatpickr("#datetime-local", {
        enableTime: false,
        minDate: "today",
        // mode:"range",
        dateFormat: "Y-m-d",

        onClose: function (selectedDates) {
            // console.log(selectedDates);
            startDate = this.formatDate(selectedDates[0], "Y-m-d");
            var formattedDate = this.formatDate(selectedDates[0], "Y-m-d");
            loadLastTransaction(formattedDate)
            // if (selectedDates.length === 2) {
            // }
        },
    });
});

function loadLastTransaction(selectedDates) {
    valuedate = selectedDates
    $.ajax({
        url: baseURL + "/home/loadGlobal",
        type: "POST",
        data: JSON.stringify({ tableName: 'transactions', where: "DATE(transaction_start_date) = '" + selectedDates + "' AND transaction_end_date IS NULL" }),
        beforeSend: function () {
            // Swal.fire({
            //     title: "Loading",
            //     text: "Please wait...",
            // });
        },
        complete: function () { },
        success: function (response) {
            // Handle response sukses
            el = `<option value="09:00-09:30">09:00-09:30</option>
            <option value="10:00-10:30">10:00-10:30</option>
            <option value="11:00-11:30">11:00-11:30</option>
            <option value="12:00-12:30">12:00-12:30</option>
            <option value="13:00-13:30">13:00-13:30</option>
            <option value="14:00-14:30">14:00-14:30</option>
            <option value="15:00-15:30">15:00-15:30</option>
            <option value="16:00-16:30">16:00-16:00</option>
            <option value="17:00-17:30">17:00-17:30</option>
           `
            $('.tipebayar').html(el)

            if (response.code == 0) {
                arrtime = response.data
                for (let index = 0; index < arrtime.length; index++) {
                    datetimeString = arrtime[index].transaction_start_date;
                    var timeWithoutSeconds = datetimeString.split(' ')[1].split(':').slice(0, 2).join(':');
                    if (timeWithoutSeconds === '09:00') {
                        $('.tipebayar option[value="09:00-09:30"]').remove();
                    } else if (timeWithoutSeconds === '10:00') {
                        $('.tipebayar option[value="10:00-10:30"]').remove();
                    } else if (timeWithoutSeconds === '11:00') {
                        $('.tipebayar option[value="11:00-11:30"]').remove();
                    } else if (timeWithoutSeconds === '12:00') {
                        $('.tipebayar option[value="12:00-12:30"]').remove();
                    } else if (timeWithoutSeconds === '13:00') {
                        $('.tipebayar option[value="13:00-13:30"]').remove();
                    } else if (timeWithoutSeconds === '14:00') {
                        $('.tipebayar option[value="14:00-14:30"]').remove();
                    } else if (timeWithoutSeconds === '15:00') {
                        $('.tipebayar option[value="15:00-15:30"]').remove();
                    } else if (timeWithoutSeconds === '16:00') {
                        $('.tipebayar option[value="16:00-16:30"]').remove();
                    } else if (timeWithoutSeconds === '17:00') {
                        $('.tipebayar option[value="17:00-17:30"]').remove();
                    }
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

counter = 0;
$("#add-btn").on("click", function (e) {
    e.preventDefault();

    counter++;

    el = ` <tr id="item${counter}">
    <td>
    <input class="form-control form-control-lg v-pet pet-name" type="text"
            placeholder="Nama Pet" required=""></td>
    <td><select class="form-control pet-package" id="sel-package${counter}">
    </select></td>
    <td><select class="form-control pet-karyawan" id="sel-karyawan${counter}">
    </select></td>
    <td><select class="form-control form-control-lg v-pet pet-type" id="sel-petitem${counter}">
    </select></td>
    <td><a class="btn btn-danger" onclick="deleteItem(${counter})"><i
                class="fa fa-minus"></i></a></td>
    </tr>`;
    $("#f-pet").append(el);
{/* <input class="form-control form-control-lg v-pet pet-type"  type="text"
            placeholder="Jenis Pet" required=""></input> */}
    loadPackage(counter);
    loadKaryawan(counter);
    loadPet(counter);
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

    $('tr[id^="item"]').each(function (index) {

        let name = $(this).find(".pet-name").val();
        let package = $(this).find(".pet-package").val();
        let karyawan = $(this).find(".pet-karyawan").val();
        let type = $(this).find(".pet-type").val();
        var selectedOptionText = $('.pet-package :selected').text();

        arrPrice = selectedOptionText.split("-")
        total_price += parseInt(arrPrice[1]);

        if (name && package && type && karyawan) {
            let pet = {
                name: name,
                package: package,
                karyawan_id: karyawan,
                type: type,
            };

            dataPet.push(pet);
        }
    });

    isObject.transaction_type = "GR";
    isObject.price_total = total_price;
    timex = $(".tipebayar").val()
    arrtime = timex.split('-')
    startDate = new Date(startDate + 'T' + arrtime[0] + ':00');
    // Membuat tanggal lengkap untuk endDate
    var formattedDate1 = startDate.getFullYear() + '-' + ('0' + (startDate.getMonth() + 1)).slice(-2) + '-' + ('0' + startDate.getDate()).slice(-2) + ' ' + ('0' + startDate.getHours()).slice(-2) + ':' + ('0' + startDate.getMinutes()).slice(-2) + ':' + ('0' + startDate.getSeconds()).slice(-2);
  
    isObject.date = formattedDate1;


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

    if (validationSwalFailed(dataPet.length, "Pets tidak boleh kosong."))
        return false;


    isObject["data_pet"] = dataPet;

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
            data: JSON.stringify({ tableName: 'packages' , where:"category = 'GR'"}),
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

async function loadKaryawan(param) {
    try {

        const response = await $.ajax({
            url: baseURL + "/loadGlobal",
            type: "POST",
            data: JSON.stringify({ tableName: 'users' , where:"role_id = 8"}),
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



        $(`#sel-karyawan${param}`).select2({
            // theme: "bootstrap-5",
            // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',

            data: res,
            placeholder: "Pilih Karyawan",
            // dropdownParent: $("#modal-data"),
        });
        $(`#sel-karyawan${param}`).val("").trigger("change");

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
                id: item.id,
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


