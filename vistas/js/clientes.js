/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/
/*
$.ajax({

	url: "ajax/clientes.ajax.php",
	success: function(respuesta) {

		console.log("respuesta", respuesta);

	}

})*/

/*=============================================
	LIMPIAR CAMPOS MODAL
=============================================*/


$("#btn-modal-nuevo-cliente").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */

	$("#clienteCedula").val("");
	$("#clienteid").val("");
	$("#clienteNombre").val("");
	$("#clienteCelular").val("");
	$("#clienteDireccion").val("");
	$("#clienteCorreo").val("");
	$("#clientePosicion").val("");
	$("#clienteRUTA").val(1);
	$("#clienteDiaCobro").val(0);
	$("#clienteActivo").val(1);
	$("#clienteActivo").attr('disabled', true);


});


/*=============================================
CARGAR COMBO DIAS
=============================================*/
$.ajax({

	url: "vistas/js/diassemana.json",
	success: function(respuesta) {
		$("#clienteDiaCobro").html("");
		//console.log("respuesta", respuesta);
		for (var i = 0; i < respuesta.length; i++) {
			$("#clienteDiaCobro").append('<option value='+respuesta[i].code+'>'+respuesta[i].name+'</option>');
		}

	}

})


/*=============================================
CARGAR COMBO RUTAS
=============================================*/


$("#clienteRUTA").html("");
let datos = new FormData();
datos.append("acc", "comborutas");
$.ajax({
		url: "ajax/rutas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
	})
	.done(function(respuesta) {
		//console.log("respuesta", respuesta);
		for (var i = 0; i < respuesta.length; i++) {
			$("#clienteRUTA").append('<option value='+respuesta[i].rut_Id+'>'+respuesta[i].rut_Nombre+'</option>');
		}
	})
	.fail(function(respuesta) {
		console.log("error ", respuesta);
	});


/*=============================================
CARGAR COMBO FORMA PAGO
=============================================*/
$("#comboformapago").html("");
let formapago = new FormData();
formapago.append("acc", "comboFormaPago");
$.ajax({
		url: "ajax/formapago.ajax.php",
		method: "POST",
		data: formapago,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
	})
	.done(function(respuesta) {
		for (var i = 0; i < respuesta.length; i++) {
			$("#comboformapago").append('<option value='+respuesta[i].frm_Id+'>'+respuesta[i].frm_Nombre+'</option>');
		}
	})
	.fail(function(respuesta) {
		console.log("error ", respuesta);
	});



/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/


$('#tablaclientes').DataTable( {
    "ajax": "ajax/clientes.ajax.php",
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


$('#tablaclientes').on('click', '.btnupdcliente', function(event) {
	event.preventDefault();
	const clienteid = $(this).attr('clienteid');
	const clientecedula = $(this).attr('clientecedula');
	let datos = new FormData();
    datos.append("clienteid", clienteid);
    datos.append("acc", "traer");
	$.ajax({
		url:"ajax/clientes.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
	})
	.done(function(respuesta) {
		$("#clienteCedula").val(respuesta["cli_Cedula"]);
		$("#clienteid").val(respuesta["cli_Id"]);
		$("#clienteNombre").val(respuesta["cli_Nombre"]);
		$("#clienteCelular").val(respuesta["cli_Celular"]);
		$("#clienteDireccion").val(respuesta["cli_Direccion"]);
		$("#clienteCorreo").val(respuesta["cli_Correo"]);
		$("#clientePosicion").val(respuesta["cli_Posicion"]);
		$("#clienteRUTA").val(respuesta["cli_RUTA"]);
		$("#clienteDiaCobro").val(respuesta["cli_DiaCobro"]);
		$("#clienteActivo").val(respuesta["cli_Activo"]);
		$("#clienteCedula").prop('readonly', true);
		$("#modal-nuevo-cliente").modal("show");
	})
	.fail(function(respuesta) {
		console.log("error ",respuesta);
	});

});


/*=============================================
	ACTUALIZAR CLIENTES
=============================================*/


$('#tablaclientes').on('click', '.btnnuevoprestamo', function(event) {
	event.preventDefault();
	const clienteid = $(this).attr('clienteid');
	const clientecedula = $(this).attr('clientecedula');
	$("#clientePrestamo").val(clientecedula);
	$("#idPrestamo").val(clienteid);
	$("#modal-nuevo-prestamo").modal("show");
});