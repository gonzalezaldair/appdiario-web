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
    "ajax": "ajax/abonos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}
} );


/*=============================================
	ACTUALIZAR ABONO
=============================================*/


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

});