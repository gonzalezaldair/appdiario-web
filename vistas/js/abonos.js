/*=============================================
CARGAR LA TABLA DINÁMICA DE ABONOS
=============================================*/
/*
$.ajax({

	url: "ajax/abonos.ajax.php",
	success: function(respuesta) {

		console.log("respuesta", respuesta);

	}

})*/


/*=============================================
LIMPIAR CAMPOS
=============================================*/

$("#btnmodalnuevoabono").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */

	$("#abonoPrestamo").val("");
	$("#abonoMonto").val("");
	$("#abonoMonto").prop('readonly', false);
	$("#abonoPrestamo").prop('readonly', false);
	$("#abonoCliente").prop('readonly', false);
	$("#modal-nuevo-abono .modal-title").text("Nuevo Abono");
	$("#modal-nuevo-abono .modal-header").removeClass('bg-success');
	$("#modal-nuevo-abono .modal-header").addClass('bg-primary');
	$(".inputpersona-abono").show();
});


/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/


$('#tablaabonos').DataTable( {
	"order": [[ 2, "desc" ]],
    "ajax": "ajax/abonos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": lenguajeTabla
} );


/*=============================================
	ACTUALIZAR ABONO
=============================================*/

/*
$('#tablaabonos').on('click', '.btnupdabono', function(event) {
	event.preventDefault();
	const aboid = $(this).attr('aboid');
	const aboprestamo = $(this).attr('aboprestamo');
	let datos = new FormData();
	datos.append("aboid", aboid);
	datos.append("acc", "traer");
	$.ajax({
			url: "ajax/abonos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			$("#abonoPrestamo").val(respuesta["abo_PRESTAMO"]);
			$("#abonoMonto").val(respuesta["abo_Monto"]);
			$("#abonoMonto").prop('readonly', true);
			$("#abonoPrestamo").prop('readonly', true);
			$(".inputpersona-abono").hide();
			$("#modal-nuevo-abono .modal-title").text("Editar Abono");
			$("#modal-nuevo-abono .modal-header").addClass('bg-success');
			$("#modal-nuevo-abono .modal-header").removeClass('bg-primary');
			$("#modal-nuevo-abono").modal("show");
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});*/