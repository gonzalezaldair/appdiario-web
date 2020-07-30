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
	$("#prestamoInteres").attr('readonly', false);
	$("#prestamoMontoPrestado").attr('readonly', false);
	$("#prestamoCliente").attr('readonly', false);

	$("#modal-nuevo-prestamo .modal-title").text("Nuevo Prestamo");
	$("#modal-nuevo-prestamo .modal-header").removeClass('bg-success');
	$("#modal-nuevo-prestamo .modal-header").addClass('bg-primary');
	$(".input-codigo").hide();


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


$("#modal-nuevo-prestamo").on('click', '.btn-guardar-prestamo', function(event) {
	event.preventDefault();
	/* Act on the event */
	const pre_Id = ($("#prestamoId").val() != "") ? $("#prestamoId").val() : 0;
	const pre_Cliente = $("#prestamoCliente").val();
	const pre_FormaPago = $("#prestamoFormaPago").val();
	const pre_Interes = $("#prestamoInteres").val();
	const pre_MontoPrestado = $("#prestamoMontoPrestado").val();
	const pre_Cuotas = $("#prestamoCuotas").val();
	const pre_Observaciones = $("#prestamoObservaciones").val();
	let datos = new FormData();
	datos.append("pre_Id", pre_Id);
	datos.append("pre_CLIENTE", pre_Cliente);
	datos.append("pre_FormaPago", pre_FormaPago);
	datos.append("pre_Interes", pre_Interes);
	datos.append("pre_MontoInteres", 100000);
	datos.append("pre_MontoPrestado", pre_MontoPrestado);
	datos.append("pre_Cuotas", pre_Cuotas);
	datos.append("pre_Observaciones", pre_Observaciones);
	datos.append("acc", "add");
	$.ajax({
			url: "ajax/prestamos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			console.log("respuesta", respuesta);
			console.log("success");
		})
		.fail(function(respuesta) {
			console.log("respuesta", respuesta.responseText);
			console.log("error");
		});
});


/*=============================================
	ACTUALIZAR PRESTAMOS
=============================================*/


$('#tablaPrestamos').on('click', '.btnupdprestamo', function(event) {
	event.preventDefault();
	const prestamoid = $(this).attr('prestamoid');
	let datos = new FormData();
	datos.append("prestamoid", prestamoid);
	datos.append("acc", "traer");
	$.ajax({
			url: "ajax/prestamos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			$("#prestamoId").val(respuesta["pre_Id"]);
			$("#prestamoCliente").val(respuesta["pre_CLIENTE"]);
			$("#prestamoFormaPago").val(respuesta["pre_FormaPago"]);
			$("#prestamoInteres").val(respuesta["pre_Interes"]);
			$("#prestamoInteres").attr('readonly', true);
			$("#prestamoMontoPrestado").attr('readonly', true);
			$("#prestamoCliente").attr('readonly', true);
			$("#prestamoMontoPrestado").val(respuesta["pre_MontoPrestado"]);
			$("#prestamoCuotas").val(respuesta["pre_Cuotas"]);
			$("#prestamoObservaciones").val(respuesta["pre_Observaciones"]);
			$("#prestamoUsuario").val(respuesta["pre_USUARIO"]);
			$(".input-codigo").show();
			$("#modal-nuevo-prestamo .modal-title").text("Editar Prestamo");
			$("#modal-nuevo-prestamo .modal-header").addClass('bg-success');
			$("#modal-nuevo-prestamo .modal-header").removeClass('bg-primary');
			$("#modal-nuevo-prestamo").modal("show");
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});

/*=============================================
	TRAER DATOS PARA HACER ABONO
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


/*=============================================
	GUARDAR NUEVO ABONO
=============================================*/


$('#modal-nuevo-abono').on('click', '.btn-guardar-abono', function(event) {
	event.preventDefault();
	const abo_Id = ($("#abo_Id").val() != "") ? $("#abo_Id").val() : 0;
	const abo_PRESTAMO = $("#prestamoabonoid").val();
	const abo_Monto = $("#prestamosabonoSuma").val();
	let datos = new FormData();
	datos.append("abo_Id", abo_Id);
	datos.append("abo_PRESTAMO", abo_PRESTAMO);
	datos.append("abo_Monto", abo_Monto);
	datos.append("acc", "add");
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
			console.log("respuesta", respuesta);
			console.info("success");
		})
		.fail(function(respuesta) {
			console.info("respuesta", respuesta.responseText);
			console.log("error");
		});

});


$("#prestamosabonoSuma").on('change', function(event) {
	event.preventDefault();
	/* Act on the event */
	const abono = $(this).val();
	const saldo = $(".btnabono").attr('saldo');

	$("#prestamosabonosaldo").val(saldo - abono);

});