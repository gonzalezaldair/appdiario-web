/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/
/*
$.ajax({

	url: "ajax/prestamos.ajax.php",
	success: function(respuesta) {

		console.log("respuesta", respuesta);

	}

})*/


/*=============================================
CARGAR COMBO
=============================================*/


$("#prestamoFormaPago").html("");
let comboFormapago = new FormData();
comboFormapago.append("acc", "comboFormaPago");
$.ajax({
		url: "ajax/formapago.ajax.php",
		method: "POST",
		data: comboFormapago,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
	})
	.done(function(respuesta) {
		//console.log("respuesta", respuesta);
		for (var i = 0; i < respuesta.length; i++) {
			$("#prestamoFormaPago").append('<option value='+respuesta[i].frm_Id+'>'+respuesta[i].frm_Nombre+'</option>');
		}
	})
	.fail(function(respuesta) {
		console.log("error ", respuesta);
	});

/*=============================================
	LIMPIAR CAMPOS MODAL
=============================================*/


$("#btnmodalnuevoprestamo").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */

	$("#prestamoId").val("");
	$("#prestamoFormaPago").val(1);
	$("#prestamoCliente").val("");
	$("#prestamoInteres").val("");
	$("#prestamoMontoPrestado").val("");
	$("#prestamoCuotas").val("");
	$("#prestamoObservaciones").val("");
	$("#prestamoUsuario").val("");


});



/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/


$('#tablaPrestamos').DataTable( {
    "ajax": "ajax/prestamos.ajax.php",
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
	ACTUALIZAR CLIENTES
=============================================*/


$('#tablaPrestamos').on('click', '.btnupdprestamo', function(event) {
	event.preventDefault();
	const prestamoid = $(this).attr('prestamoid');
	let datos = new FormData();
    datos.append("prestamoid", prestamoid);
    datos.append("acc", "traer");
	$.ajax({
		url:"ajax/prestamos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
	})
	.done(function(respuesta) {
		$("#prestamoId").val(respuesta["pre_Id"]);
		$("#prestamoCliente").val(respuesta["pre_CLIENTE"]);
		$("#prestamoFormaPago").val(respuesta["pre_FormaPago"]);
		$("#prestamoInteres").val(respuesta["pre_Interes"]);
		$("#prestamoMontoPrestado").val(respuesta["pre_MontoPrestado"]);
		$("#prestamoCuotas").val(respuesta["pre_Cuotas"]);
		$("#prestamoObservaciones").val(respuesta["pre_Observaciones"]);
		$("#prestamoUsuario").val(respuesta["pre_USUARIO"]);
		$("#modal-nuevo-prestamo").modal("show");
	})
	.fail(function(respuesta) {
		console.log("error ",respuesta);
	});

});

/*=============================================
	ACTUALIZAR CLIENTES
=============================================*/

$('#tablaPrestamos').on('click', '.btnabono', function(event) {
	event.preventDefault();
	$("#prestamosabonoSuma").val(0);
	const prestamoid = $(this).attr('prestamoid');
	const saldo = $(this).attr('saldo');
	$("#prestamoabonoid").val(prestamoid);
	$("#prestamosabonosaldo").val(saldo);
	$("#modal-nuevo-abono").modal("show");
});

$("#prestamosabonoSuma").on('change', function(event) {
	event.preventDefault();
	/* Act on the event */
	const abono = $(this).val();
	const saldo = $(".btnabono").attr('saldo');

	$("#prestamosabonosaldo").val(saldo - abono);

});