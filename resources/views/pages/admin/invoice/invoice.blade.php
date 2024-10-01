<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style type="text/css">
            @media print {
                body * {
                    visibility: hidden;
                }

                #printable-section,
                #printable-section * {
                    visibility: visible;
                }

                #printable-section {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
            }

            body {
                margin: 0;
                padding: 0;
                background: #ffffff;
            }

            div,
            p,
            a,
            li,
            td {
                -webkit-text-size-adjust: none;
            }

            body {
                width: 88mm;
                height: 100%;
                background-color: #ffffff;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;

            }

            p {
                padding: 0 !important;
                margin-top: 0 !important;
                margin-right: 0 !important;
                margin-bottom: 0 !important;
                margin- left: 0 !important;
            }

            .visibleMobile {
                display: none;
            }

            .hiddenMobile {
                display: block;
            }
        </style>
    </head>

    <body>
        <div id="printable-section">
            <table width="100%" border="0" cellpadding='2' cellspacing="2" align="center" bgcolor="#ffffff"
                style="padding-top:4px;">
                <tbody>
                    <tr>
                        <td
                            style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 

18px; vertical-align: bottom; text-align: center;">
                            <strong style="font-size:16px;">MF COLLECTION</strong>
                            <br>phone: 0403 - 247830 322

                            <br> Sri Agung, Tanjab Barat, Jambi
                        </td>
                    </tr>
                    <tr>
                        <td height="2" colspan="0" style="border-bottom:1px solid #e4e4e4 "></td>
                    </tr>
                </tbody>
            </table>

            <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                <tbody>
                    <tr>
                        <td colspan="100"
                            style="font-size: 14px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 

18px; vertical-align: bottom; text-align: center;">
                            <strong>Cash Receipt</strong>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height: 

18px; vertical-align: bottom; text-align: left;">
                            <b class="customer_name">Customer Name</b>

                        </td>
                        <td
                            style="font-size: 12px; color: #5b5b5b; font-family: 'Open Sans', sans-serif; line-height:18px; vertical-align: top; text-align: right;">
                            <br><b class="no_invoice">INVOICE: #32432432423</b>
                            <br><b class="date_invoice">Date: Feb 27, 2018</b>
                        </td>
                    </tr>
                    <tr>
                        <td height="2" colspan="100" style="padding-top:15px;border-bottom:1px solid #e4e4e4 ">
                        </td>
                    </tr>
                </tbody>
            </table>

            <table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
                <thead>
                    <tr>
                        <td
                            style="font-size: 10px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:center; ">
                            Barang
                        </td>
                        <td
                            style="font-size: 10px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:center; ">
                            Qty
                        </td>
                        <td
                            style="font-size: 10px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:center; ">
                            Satuan
                        </td>
                        <td
                            style="font-size: 10px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:center; ">
                            Subtotal
                        </td>
                    </tr>
                </thead>
                <tbody id="detail_invoice">
                    <tr>
                        <td
                            style="font-size: 10px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:16px ">
                            Grand Total:
                        </td>
                        <td style="font-size: 10px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; white-space:nowrap; "
                            width="100 ">
                            <b class="v-total-amount">150</b>
                        </td>
                    </tr>
                    <tr>
                        <td height="2" colspan="100" style=" border-bottom:1px solid #e4e4e4 "></td>
                    </tr>
                </tbody>
            </table>

            <!-- /Header -->

            <!-- Table Total -->
            <table width="100%" border="0 " cellpadding="0" cellspacing="2" align="center"
                style="padding: 12px 0px 5px 2px">
                <tbody>
                    <tr>
                        <td
                            style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:16px ">
                            Grand Total:
                        </td>
                        <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; white-space:nowrap; "
                            width="100 ">
                            <b class="v-total-amount">150</b>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:16px ">
                            Jumlah Bayar:
                        </td>
                        <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; white-space:nowrap; "
                            width="100 ">
                            <b class="v-total-payment">150</b>
                        </td>
                    </tr>

                    <tr>
                        <td height="2" colspan="100" style="padding-top:12px;border-bottom:1px solid #e4e4e4 "></td>
                    </tr>
                </tbody>
            </table>

            <table width="100%" border="0 " cellpadding="0" cellspacing="2" align="center"
                style="padding: 5px 0px 5px 2px">
                <tbody>
                    <tr>
                        <td
                            style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; padding-left:16px ">
                            Kembalian:
                        </td>
                        <td style="font-size: 11px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:left; white-space:nowrap; "
                            width="100 ">
                            <b class="v-total-exchange">150</b>
                        </td>
                    </tr>
                    <tr>
                        <td height="2" colspan="100" style="padding-top:12px;border-bottom:1px solid #e4e4e4 "></td>
                    </tr>
                </tbody>
            </table>
            <!-- /Table Total -->
            <!-- Customer sign -->
            <table width="100% " border="0 " cellpadding="0" cellspacing="2" align="center"
                style="padding: 12px 0px 5px 2px">
                <tbody>
                    <tr>
                    </tr>
                    <tr>
                        <td style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:right; padding-top:16px "
                            class="kasir-name">
                            Kasir:
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="font-size: 14px; font-family: 'Open Sans', sans-serif; color: #646a6e; line-height: 16px; vertical-align: top; text-align:center; padding-top:16px">

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="#" onclick="window.history.back();"> Kembali </a>
        <a style="margin-left:10px" href="#" onclick="printElement()"> Cetak </a>
        <script>
            @foreach ($varJs as $varjsi)
                {!! $varjsi !!}
            @endforeach
        </script>
        <script src="{{ asset('template/admin2/assets/js/jquery.min.js') }}"></script>
        @foreach ($javascriptFiles as $file)
            <script src="{{ $file }}"></script>
        @endforeach
    </body>

</html>
