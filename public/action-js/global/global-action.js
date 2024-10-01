$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    // // Delay the execution of getMenuAccess() by 2 seconds
    // setTimeout(function() {
    //     getMenuAccess();
    // }, 1000); // 2000 milliseconds = 2 seconds
    getMenuAccess();
});

function getMenuAccess() {
    const elementMenu = localStorage.getItem('savedHTML');
    if (!elementMenu) {
        $.ajax({
            url: baseURL + "/getAccessMenu",
            type: "POST",
            data: JSON.stringify({ uid: 2 }),
            dataType: "json",
            contentType: "application/json",
            beforeSend: function () {
                // Swal.fire({
                //     title: "Loading",
                //     text: "Please wait...",
                //     showConfirmButton: false, 
                // });
            },
            complete: function () {
                // swal.close();
            },
            success: function (response) {
                // console.log(response);
                // Handle response sukses
                if (response.code == 0) {
                    // swal("Saved !", response.info, "success").then(function () {
                    //     location.reload();
                    // });
                    // Reset form
                    let data = response.data;
                    let groupedData = {};
                    let allGroupHTML = "";

                    data.forEach(function (item) {
                        let groupName = item.header_menu;

                        if (!groupedData[groupName]) {
                            groupedData[groupName] = [];
                        }

                        groupedData[groupName].push(item);
                    });

                    for (var groupName in groupedData) {
                        var groupItems = groupedData[groupName];
                        var groupHTML = `
                        <li class="sidebar-main-title">
                            <div>
                                <h6 class="lan-1">${groupName}</h6>
                            </div>
                        </li>`;

                        groupItems.forEach(function (item) {
                            groupHTML += `<li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="${item.url}">
                            <i class="fa fa-dot-circle-o"></i>
                            <span>${item.menu_name}</span>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div></a>
                        </li>`;
                        });

                        groupHTML += `</ul>`;

                        allGroupHTML += groupHTML; // Gabungkan semua grup
                    }

                    // Setelah loop selesai, append semua grup ke elemen dengan class "isSidebarMenu"
                    $('.simplebar-content .pin-title').after(allGroupHTML);
                    localStorage.setItem('savedHTML', allGroupHTML);
                } else {
                    sweetAlert("Oops...", response.info, "error");
                }
            },
            error: function (xhr, status, error) {
                // Handle error response
                console.log(xhr.responseText);
                sweetAlert("Oops...", xhr.responseText, "error");
            },
        });
    }
    else {
        $('.simplebar-content .pin-title').after(elementMenu);
    }

    const currentUrl = window.location.pathname;

    $(".simplebar-content").find('.sidebar-list a').each(function () {
        var menuItemUrl = $(this).attr('href');

        if (currentUrl === menuItemUrl) {

            $(this).addClass('active');
        }
    });


}

function validationSwalFailed(param, isText) {
    // console.log(param);
    if (param == "" || param == null) {
        sweetAlert("Oops...", isText, "warning");

        return 1;
    }
}


(function ($) {
    if (localStorage.getItem("color"))
        $("#color").attr(
            "href",
            "../assets/css/" + localStorage.getItem("color") + ".css"
        );
    if (localStorage.getItem("dark")) $("body").attr("class", "dark-only");
    // $(
    // ).appendTo($("body"));
    // (function () { })();
    //live customizer js
    $(document).ready(function () {
        setLayout();
        $(".customizer-color li").on("click", function () {
            $(".customizer-color li").removeClass("active");
            $(this).addClass("active");
            var color = $(this).attr("data-attr");
            var primary = $(this).attr("data-primary");
            var secondary = $(this).attr("data-secondary");
            localStorage.setItem("color", color);
            localStorage.setItem("primary", primary);
            localStorage.setItem("secondary", secondary);
            localStorage.removeItem("dark");
            $("#color").attr("href", "../assets/css/" + color + ".css");
            $(".dark-only").removeClass("dark-only");
            location.reload(true);
        });

        $(".customizer-color.dark li").on("click", function () {
            $(".customizer-color.dark li").removeClass("active");
            $(this).addClass("active");
            $("body").attr("class", "dark-only");
            localStorage.setItem("dark", "dark-only");
        });

        if (localStorage.getItem("primary") != null) {
            document.documentElement.style.setProperty(
                "--theme-deafult",
                localStorage.getItem("primary")
            );
        }
        if (localStorage.getItem("secondary") != null) {
            document.documentElement.style.setProperty(
                "--theme-secondary",
                localStorage.getItem("secondary")
            );
        }
        $(
            ".customizer-links #c-pills-home-tab, .customizer-links #c-pills-layouts-tab"
        ).click(function () {
            $(".customizer-contain").addClass("open");
            $(".customizer-links").addClass("open");
        });

        $(".close-customizer-btn").on("click", function () {
            $(".floated-customizer-panel").removeClass("active");
        });

        $(".customizer-contain .icon-close").on("click", function () {
            $(".customizer-contain").removeClass("open");
            $(".customizer-links").removeClass("open");
        });

        $(".color-apply-btn").click(function () {
            location.reload(true);
        });

        var primary = document.getElementById("ColorPicker1").value;
        document.getElementById("ColorPicker1").onchange = function () {
            primary = this.value;
            localStorage.setItem("primary", primary);
            document.documentElement.style.setProperty("--theme-primary", primary);
        };

        var secondary = document.getElementById("ColorPicker2").value;
        document.getElementById("ColorPicker2").onchange = function () {
            secondary = this.value;
            localStorage.setItem("secondary", secondary);
            document.documentElement.style.setProperty(
                "--theme-secondary",
                secondary
            );
        };

        $(".customizer-color.dark li").on("click", function () {
            $(".customizer-color.dark li").removeClass("active");
            $(this).addClass("active");
            $("body").attr("class", "dark-only");
            localStorage.setItem("dark", "dark-only");
        });

        $(".customizer-mix li").on("click", function () {
            $(".customizer-mix li").removeClass("active");
            $(this).addClass("active");
            var mixLayout = $(this).attr("data-attr");
            $("body").attr("class", mixLayout);
        });

        $(".sidebar-setting li").on("click", function () {
            $(".sidebar-setting li").removeClass("active");
            $(this).addClass("active");
            var sidebar = $(this).attr("data-attr");
            $(".sidebar-wrapper").attr("sidebar-layout", sidebar);
        });

        $(".sidebar-main-bg-setting li").on("click", function () {
            $(".sidebar-main-bg-setting li").removeClass("active");
            $(this).addClass("active");
            var bg = $(this).attr("data-attr");
            $(".sidebar-wrapper").attr("class", "sidebar-wrapper " + bg);
        });

        function setLayout(params) {
            $("body").append("");
            console.log("test");
            var type = "dark-sidebar";

            var boxed = "";
            if ($(".page-wrapper").hasClass("box-layout")) {
                boxed = "box-layout";
            }
            switch (type) {
                case "compact-sidebar": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper compact-wrapper " + boxed
                    );
                    $(this).addClass("active");

                    $(".logo-wrapper").html("KIMI SHOP")

                    localStorage.setItem("page-wrapper-cuba", "compact-wrapper");
                    break;
                }
                case "normal-sidebar": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper horizontal-wrapper " + boxed
                    );
                    // $(".logo-wrapper")
                    //     .find("img")
                    //     .attr("src", "../assets/images/logo/logo.png");
                    localStorage.setItem("page-wrapper-cuba", "horizontal-wrapper");
                    break;
                }
                case "default-body": {
                    $(".page-wrapper").attr("class", "page-wrapper  only-body" + boxed);
                    localStorage.setItem("page-wrapper-cuba", "only-body");
                    break;
                }
                case "dark-sidebar": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper compact-wrapper dark-sidebar" + boxed
                    );
                    $(".logo-wrapper").html("POS Application")
                    $(".logo-wrapper").addClass("text-white")
                    localStorage.setItem(
                        "page-wrapper-cuba",
                        "compact-wrapper dark-sidebar"
                    );
                    break;
                }
                case "compact-wrap": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper compact-sidebar" + boxed
                    );
                    localStorage.setItem("page-wrapper-cuba", "compact-sidebar");
                    break;
                }
                case "color-sidebar": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper compact-wrapper color-sidebar" + boxed
                    );
                    localStorage.setItem(
                        "page-wrapper-cuba",
                        "compact-wrapper color-sidebar"
                    );
                    break;
                }
                case "compact-small": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper compact-sidebar compact-small" + boxed
                    );
                    localStorage.setItem(
                        "page-wrapper-cuba",
                        "compact-sidebar compact-small"
                    );
                    break;
                }
                case "box-layout": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper compact-wrapper box-layout " + boxed
                    );
                    localStorage.setItem(
                        "page-wrapper-cuba",
                        "compact-wrapper box-layout"
                    );
                    break;
                }
                case "enterprice-type": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper horizontal-wrapper enterprice-type" + boxed
                    );
                    localStorage.setItem(
                        "page-wrapper-cuba",
                        "horizontal-wrapper enterprice-type"
                    );
                    break;
                }
                case "modern-layout": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper compact-wrapper modern-type" + boxed
                    );
                    localStorage.setItem(
                        "page-wrapper-cuba",
                        "compact-wrapper modern-type"
                    );
                    break;
                }
                case "material-layout": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper horizontal-wrapper material-type" + boxed
                    );
                    localStorage.setItem(
                        "page-wrapper-cuba",
                        "horizontal-wrapper material-type"
                    );

                    break;
                }
                case "material-icon": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper compact-sidebar compact-small material-icon" + boxed
                    );
                    localStorage.setItem(
                        "page-wrapper-cuba",
                        "compact-sidebar compact-small material-icon"
                    );

                    break;
                }
                case "advance-type": {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper horizontal-wrapper enterprice-type advance-layout" +
                        boxed
                    );
                    localStorage.setItem(
                        "page-wrapper-cuba",
                        "horizontal-wrapper enterprice-type advance-layout"
                    );

                    break;
                }
                default: {
                    $(".page-wrapper").attr(
                        "class",
                        "page-wrapper compact-wrapper " + boxed
                    );
                    localStorage.setItem("page-wrapper-cuba", "compact-wrapper");
                    break;
                }
            }
        }

        $(".main-layout li").on("click", function () {
            $(".main-layout li").removeClass("active");
            $(this).addClass("active");
            var layout = $(this).attr("data-attr");
            $("body").attr("class", layout);
            $("html").attr("dir", layout);
        });

        $(".main-layout .box-layout").on("click", function () {
            $(".main-layout .box-layout").removeClass("active");
            $(this).addClass("active");
            var layout = $(this).attr("data-attr");
            $("body").attr("class", "box-layout");
            $("html").attr("dir", layout);
        });
    });
})(jQuery);

function formatRupiah(value) {
    // Convert the input to a number
    const number = parseFloat(value);

    // Check if the number is valid
    if (isNaN(number)) {
        return 'Invalid number';
    }

    // Format the number as Indonesian Rupiah
    return number.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });
}

function formatRupiahByElement(el) {
    let value = el.value;
    value = value.replace(/[^0-9]/g, '');
    const number = parseFloat(value);
    if (isNaN(number)) {
        el.value = '';
        return;
    }

    const formattedValue = number.toLocaleString('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });

    el.value = formattedValue;
}


function unformatRupiah(el) {
    
    let value = el;
    value = value.replace(/[^0-9]/g, '');
    number = parseFloat(value);
    
    return number
}