/*=============================================
CARGAR LA TABLA DINÁMICA DE ABONOS
=============================================*/

$.ajax({
  url: "ajax/movimientos-caja.ajax.php",
  success: function (respuesta) {
    console.log("respuesta", respuesta);
  },
});

let tablaMovimientosCaja = $("#tablaMovimientosCaja").DataTable({
  order: [[2, "desc"]],
  ajax: "ajax/movimientos-caja.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  language: lenguajeTabla,
});

$("#btnmodalnuevomovimientocaja").on("click", function (event) {
  event.preventDefault();
  /* Act on the event */
  $("#cobroId").val("");
  $("#tipoMovimiento").val("0");
  $("#observacionMovimiento").val("");

  $("#modal-nuevo-movimiento-caja .modal-title").text("Nuevo Movimiento");
  $("#modal-nuevo-movimiento-caja .modal-header").removeClass("bg-success");
  $("#modal-nuevo-movimiento-caja .modal-header").addClass("bg-primary");
});

$("#modal-nuevo-movimiento-caja").on(
  "click",
  ".btn-guardar-movimiento",
  function (event) {
    event.preventDefault();
    const tipoMovimiento = $("#tipoMovimiento").val();
    const montoMovimiento = $("#montoMovimiento").val();
    const observacionMovimiento = $("#observacionMovimiento").val();
    let datos = new FormData();
    datos.append("tipoMovimiento", tipoMovimiento);
    datos.append("montoMovimiento", montoMovimiento);
    datos.append("observacionMovimiento", observacionMovimiento);
    datos.append("acc", "add");
    $.ajax({
      url: "ajax/movimientos-caja.ajax.php",
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
              tablaMovimientosCaja.ajax.reload();
            }
          });
          $("#modal-nuevo-movimiento-caja").modal("hide");
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
  },
);
