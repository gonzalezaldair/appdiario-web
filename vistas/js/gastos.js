/*=============================================
CARGAR LA TABLA DINÁMICA DE ABONOS
=============================================*/
/*
$.ajax({
  url: "ajax/gastos.ajax.php",
  success: function (respuesta) {
    console.log("respuesta", respuesta);
  },
});
*/
/*=============================================
LIMPIAR CAMPOS
=============================================*/

$("#btnmodalnuevogasto").on("click", function (event) {
  event.preventDefault();
  /* Act on the event */

  $("#gastoPrestamo").val("");
  $("#gastoMonto").val("");
  $("#gastoMonto").prop("readonly", false);
  $("#gastoPrestamo").prop("readonly", false);
  $("#gastoCliente").prop("readonly", false);
  $("#modal-nuevo-gasto .modal-title").text("Nuevo gasto");
  $("#modal-nuevo-gasto .modal-header").removeClass("bg-success");
  $("#modal-nuevo-gasto .modal-header").addClass("bg-primary");
  $(".inputpersona-gasto").show();
});

/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/

$("#tablagastos").DataTable({
  order: [[2, "desc"]],
  ajax: "ajax/gastos.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  language: lenguajeTabla,
});
