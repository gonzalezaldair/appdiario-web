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
