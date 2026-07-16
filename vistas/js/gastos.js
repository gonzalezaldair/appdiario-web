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

let tablaGastos = $("#tablagastos").DataTable({
  order: [[2, "desc"]],
  ajax: "ajax/gastos.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  language: lenguajeTabla,
});

$("#modal-nuevo-gasto").on("click", ".btn-guardar-gasto", function (event) {
  event.preventDefault();
  const gas_Monto = $("#gas_Monto").val();
  const gas_Tipo = $("#gas_Tipo").val();
  let datos = new FormData();
  datos.append("gas_Monto", gas_Monto);
  datos.append("gas_Tipo", gas_Tipo);
  datos.append("acc", "add");
  $.ajax({
    url: "ajax/gastos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
  })
    .done(function (respuesta) {
      if (respuesta.mensaje === "ok") {
        Swal.fire({
          title: "Guardar Datos",
          text: "Datos Guardados Correctamente.",
          type: "success",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "! Cerrar ¡",
        }).then((result) => {
          if (result.value) {
            tablaGastos.ajax.reload();
          }
        });
        $("#modal-nuevo-gasto").modal("hide");
      } else {
        Swal.fire({
          title: "Advertencia",
          text: "Error: " + respuesta.mensaje,
          type: "warning",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "! Cerrar ¡",
        });
      }
    })
    .fail(function (respuesta) {
      console.log("error ", respuesta);
    });
});
