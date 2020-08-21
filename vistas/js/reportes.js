

$("#tablaReportes").DataTable({
  "language": lenguajeTabla,
  "searching": false,
  "paging":   false,
  "info":   false,
  "ordering": false,
});


/*=============================================
constIABLE LOCAL STORAGE
=============================================*/

if (localStorage.getItem("capturarRango") != null) {

  $("#daterange-btn span").html(localStorage.getItem("capturarRango"));


} else {

  $("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn').daterangepicker({
    ranges: {
      'Hoy': [moment(), moment()],
      'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes': [moment().startOf('month'), moment().endOf('month')],
      'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate: moment(),
    "locale": {
      "applyLabel": "Aplicar",
      "cancelLabel": "Cancelar",
      "customRangeLabel": "Personalizado",
      "daysOfWeek": [
        "Do",
        "Lu",
        "Ma",
        "Mi",
        "Ju",
        "Vi",
        "Sa"
      ],
      "monthNames": [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
      ],
    }
  },
  function(start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    const fechaInicial = start.format('YYYY-MM-DD');

    const fechaFinal = end.format('YYYY-MM-DD');

    const capturarRango = $("#daterange-btn span").html();

    localStorage.setItem("capturarRango", capturarRango);

    window.location = "index.php?action=reportes&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .cancelBtn").on("click", function() {

  localStorage.removeItem("capturarRango");
  localStorage.clear();
  window.location = "reportes";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensright .ranges li").on("click", function() {

  const textoHoy = $(this).attr("data-range-key");

  if (textoHoy == "Hoy") {

    const d = new Date();

    const dia = d.getDate();
    const mes = d.getMonth() + 1;
    const año = d.getFullYear();

    let fechaInicial ="";
    let fechaFinal  = "";

    if (mes < 10) {

      fechaInicial = año + "-0" + mes + "-" + dia;
      fechaFinal = año + "-0" + mes + "-" + dia;

    } else if (dia < 10) {

      fechaInicial = año + "-" + mes + "-0" + dia;
      fechaFinal = año + "-" + mes + "-0" + dia;

    } else if (mes < 10 && dia < 10) {

      fechaInicial = año + "-0" + mes + "-0" + dia;
      fechaFinal = año + "-0" + mes + "-0" + dia;

    } else {

      fechaInicial = año + "-" + mes + "-" + dia;
      fechaFinal = año + "-" + mes + "-" + dia;

    }

    localStorage.setItem("capturarRango", "Hoy");

    window.location = "index.php?action=reportes&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal;

  }

})