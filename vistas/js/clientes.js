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
	$("#modal-nuevo-cliente .modal-title").text("Nuevo Cliente");
	$("#modal-nuevo-cliente .modal-header").removeClass('bg-success');
	$("#modal-nuevo-cliente .modal-header").addClass('bg-primary');
	$(".selectactivo").hide();


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


$("#modal-nuevo-cliente").on('click', '.btn-guardar-cliente', function(event) {
	event.preventDefault();
	/* Act on the event */
	const cli_Cedula = $("#clienteCedula").val();
	const cli_Id = ($("#clienteid").val() != "") ? $("#clienteid").val() : 0;
	const cli_Nombre = $("#clienteNombre").val();
	const cli_Celular = $("#clienteCelular").val();
	const cli_Direccion = $("#clienteDireccion").val();
	const cli_Correo = $("#clienteCorreo").val();
	//const cli_Posicion = $("#clientePosicion").val();
	const cli_Ruta = $("#clienteRUTA").val();
	const cli_DiaCobro = $("#clienteDiaCobro").val();
	const cli_Activo = $("#clienteActivo").val();
	let datos = new FormData();
	datos.append("cli_Id", cli_Id);
	datos.append("cli_Cedula", cli_Cedula);
	datos.append("cli_Nombre", cli_Nombre);
	datos.append("cli_Celular", cli_Celular);
	datos.append("cli_Direccion", cli_Direccion);
	datos.append("cli_Correo", cli_Correo);
	//datos.append("cli_Posicion", cli_Posicion);
	datos.append("cli_RUTA", cli_Ruta);
	datos.append("cli_DiaCobro", cli_DiaCobro);
	datos.append("cli_Activo", cli_Activo);
	datos.append("acc", "add");
	$.ajax({
			url: "ajax/clientes.ajax.php",
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
			url: "ajax/clientes.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
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
			$(".selectactivo").show();
			$("#modal-nuevo-cliente .modal-title").text("Editar Cliente");
			$("#modal-nuevo-cliente .modal-header").addClass('bg-success');
			$("#modal-nuevo-cliente .modal-header").removeClass('bg-primary');
			$("#modal-nuevo-cliente").modal("show");
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});


/*=============================================
	NUEVO PRESTAMO
=============================================*/


$('#tablaclientes').on('click', '.btnnuevoprestamo', function(event) {
	event.preventDefault();
	const clienteid = $(this).attr('clienteid');
	const clientecedula = $(this).attr('clientecedula');
	$("#clientePrestamo").val(clientecedula);
	$("#idPrestamo").val(clienteid);
	$("#modal-nuevo-prestamo").modal("show");
});