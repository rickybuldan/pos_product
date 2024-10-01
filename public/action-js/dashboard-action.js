

// let dtpr;

$(document).ready(function () {
  getProfit();
  getThisMonth();
});

function getThisMonth() {
  var namaBulan = [
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];

  // Mendapatkan indeks bulan saat ini (dimulai dari 0)
  var bulanSaatIni = new Date().getMonth();

  // Mendapatkan nama bulan dalam bahasa Indonesia
  var namaBulanSaatIni = namaBulan[bulanSaatIni];
  $("#this-month").html(namaBulanSaatIni)
}

function updateChartProfit(data) {

  let grData = data.filter(item => item.transaction_category === 'Grooming');
  let pnData = data.filter(item => item.transaction_category === 'Penitipan');

  let TotalProfit = data.reduce((total, item) => total + parseFloat(item.total_price), 0);
  let chartData = {
    labels: ["Grooming", "Penitipan", "Other"],
    series: [grData[0]['transaction_count'], pnData[0]['transaction_count'], 0],
  };

  let formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(TotalProfit);

  var optionsprofit = {
    labels: chartData.labels,
    series: chartData.series,
    chart: {
      type: "donut",
      height: 300,
    },
    dataLabels: {
      enabled: false,
    },
    legend: {
      position: "bottom",
      fontSize: "14px",
      fontFamily: "Rubik, sans-serif",
      fontWeight: 500,
      labels: {
        colors: ["var(--chart-text-color)"],
      },
      markers: {
        width: 6,
        height: 6,
      },
      itemMargin: {
        horizontal: 7,
        vertical: 0,
      },
    },
    stroke: {
      width: 10,
      colors: ["var(--light2)"],
    },
    plotOptions: {
      pie: {
        expandOnClick: false,
        donut: {
          size: "83%",
          labels: {
            show: true,
            name: {
              offsetY: 4,
            },
            total: {
              show: true,
              fontSize: "20px",
              fontFamily: "Rubik, sans-serif",
              fontWeight: 500,
              label: formattedPrice,
              formatter: () => "Total Profit",
            },
          },
        },
      },
    },
    states: {
      normal: {
        filter: {
          type: "none",
        },
      },
      hover: {
        filter: {
          type: "none",
        },
      },
      active: {
        allowMultipleDataPointsSelection: false,
        filter: {
          type: "none",
        },
      },
    },
    colors: ["#54BA4A", "var(--theme-deafult)", "#FFA941"],
    responsive: [
      {
        breakpoint: 1630,
        options: {
          chart: {
            height: 360,
          },
        },
      },
      {
        breakpoint: 1584,
        options: {
          chart: {
            height: 400,
          },
        },
      },
      {
        breakpoint: 1473,
        options: {
          chart: {
            height: 250,
          },
        },
      },
      {
        breakpoint: 1425,
        options: {
          chart: {
            height: 270,
          },
        },
      },
      {
        breakpoint: 1400,
        options: {
          chart: {
            height: 320,
          },
        },
      },
      {
        breakpoint: 480,
        options: {
          chart: {
            height: 250,
          },
        },
      },
    ],
  };

  var chartprofit = new ApexCharts(document.querySelector("#profitmonthly"), optionsprofit);
  chartprofit.render();

  // chartprofit.updateOptions(optionsprofit);
  // chartprofit.updateSeries(chartData.series);
}

function updateChartTransaction(data) {

  // let Monday = data.filter(item => item.day_of_week === 'Monday');
  // let Tuesday = data.filter(item => item.day_of_week === 'Tuesday');
  // let Wednesday = data.filter(item => item.day_of_week === 'Wednesday');
  // let Thursday = data.filter(item => item.day_of_week === 'Thursday');
  // let Friday = data.filter(item => item.day_of_week === 'Friday');
  // let Saturday = data.filter(item => item.day_of_week === 'Saturday');
  // let Sunday = data.filter(item => item.day_of_week === 'Sunday');


  var result = data.map(function (item) {
    return item.transaction_count;
  });

  var resultSuccess = data.map(function (item) {
    return item.success_count;
  });

  var resultFailed = data.map(function (item) {
    return item.failed_count;
  });

  var maxTransactionCount = 0;
  $.each(data, function (index, item) {
    if (item.transaction_count > maxTransactionCount) {
      maxTransactionCount = item.transaction_count;
    }
  });
  if (maxTransactionCount > 10) {
    maxLabel = maxTransactionCount
  } else {
    maxLabel = 25;
  }
  var optionsvisitor = {
    series: [
      {
        name: "Transaksi Selesai",
        data: resultSuccess,
      },
      {
        name: "Transaksi Batal",
        data: resultFailed,
      },
    ],
    chart: {
      type: "bar",
      height: 270,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "50%",
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 6,
      colors: ["transparent"],
    },
    grid: {
      show: true,
      borderColor: "var(--chart-border)",
      xaxis: {
        lines: {
          show: true,
        },
      },
    },
    colors: ["#1FD1B6", "#F73164"],
    xaxis: {
      categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
      tickAmount: 4,
      tickPlacement: "between",
      labels: {
        style: {
          fontFamily: "Rubik, sans-serif",
        },
      },
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
    },
    yaxis: {
      min: 0,
      max: maxLabel,
      tickAmount: 5,
      tickPlacement: "between",
      labels: {
        style: {
          fontFamily: "Rubik, sans-serif",
        },
      },
    },
    fill: {
      opacity: 1,
    },
    legend: {
      position: "top",
      horizontalAlign: "left",
      fontFamily: "Rubik, sans-serif",
      fontSize: "14px",
      fontWeight: 500,
      labels: {
        colors: "var(--chart-text-color)",
      },
      markers: {
        width: 6,
        height: 6,
        radius: 12,
      },
      itemMargin: {
        horizontal: 10,
      },
    },
    responsive: [
      {
        breakpoint: 1366,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "80%",
            },
          },
          grid: {
            padding: {
              right: 0,
            },
          },
        },
      },
      {
        breakpoint: 992,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "70%",
            },
          },
        },
      },
      {
        breakpoint: 576,
        options: {
          plotOptions: {
            bar: {
              columnWidth: "60%",
            },
          },
          grid: {
            padding: {
              right: 5,
            },
          },
        },
      },
    ],
  };

  var chartvisitor = new ApexCharts(
    document.querySelector("#visitor-chart"),
    optionsvisitor
  );
  chartvisitor.render();

  // chartprofit.updateOptions(optionsprofit);
  // chartprofit.updateSeries(chartData.series);
}



function getProfit() {
  $.ajax({
    url: baseURL + "/getOverviewProfit",
    type: "POST",
    data: JSON.stringify({ tableName: 'transactions' }),
    dataType: "json",
    contentType: "application/json",
    beforeSend: function () {

    },
    complete: function () { },
    success: function (response) {
      // Handle response sukses
      if (response.code == 0) {
        // updateChartProfit(response.data)
        getTransaction();
        $(".total-sales").html(formatRupiah(parseFloat(response.data[0].price_total)))
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

function getTransaction() {
  $.ajax({
    url: baseURL + "/getOverviewTransaction",
    type: "POST",
    data: JSON.stringify({ tableName: 'transactions' }),
    dataType: "json",
    contentType: "application/json",
    beforeSend: function () {

    },
    complete: function () { },
    success: function (response) {
      // Handle response sukses
      if (response.code == 0) {
        updateChartTransaction(response.data)
        getListView();
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


function getListView() {
  dtview = $("#table-list").DataTable({
    ajax: {
      url: baseURL + "/getOverviewLastTransaction",
      type: "POST",
      data: {
        param_type: "VIEW",
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
      { data: "product_name" },

      { data: "total_products_sold" },

    ],
    // rowGroup: {
    //   dataSrc: 'product_name'
    // },

    columnDefs: [

     

    ],
    drawCallback: function (settings) {
      var api = this.api();
      var rows = api.rows({ page: "current" }).nodes();
      var last = null;

    },
    initComplete: function () {

    },
  });
}