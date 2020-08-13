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
	$("#clienteCedula").prop('readonly', false);
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
			if (respuesta[i].rut_Activo == 1) {
				$("#clienteRUTA").append('<option value=' + respuesta[i].rut_Id + '>' + respuesta[i].rut_Nombre + '</option>');
			}
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
			if (respuesta[i].frm_Activo == 1) {
				$("#comboformapago").append('<option value=' + respuesta[i].frm_Id + '>' + respuesta[i].frm_Nombre + '</option>');
			}

		}
	})
	.fail(function(respuesta) {
		console.log("error ", respuesta);
	});



/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/
let tablaclientes = $('#tablaclientes').DataTable({
	"ajax": "ajax/clientes.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": lenguajeTabla
});

/**
 * GUARDAR CLIENTE
 */

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
	datos.append("cli_Posicion", 0);
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

			if (respuesta.mensaje === 'ok') {
				Swal.fire({
					title: 'Guardar Datos',
					text: "Datos Guardados Correctamente.",
					type: 'success',
					confirmButtonColor: '#3085d6',
					confirmButtonText: '! Cerrar ¡'
				}).then((result) => {
					if (result.value) {
						tablaclientes.ajax.reload();
					}
				})
				$("#modal-nuevo-cliente").modal("hide");
			} else {
				Swal.fire({
					title: 'Advertencia',
					text: "Error: " + respuesta.codigo,
					type: 'warning',
					confirmButtonColor: '#3085d6',
					confirmButtonText: '! Cerrar ¡'
				});
			}
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
	datos.append("valor", clienteid);
	datos.append("item", "cli_Id");
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
	VALIDAR QUE SOLO INGRESEN VALORES PERMITIDOS
=============================================*/


$("input.validarNumero").on("input", function() {
	this.value = this.value.replace(/[^0-9.]/g, '');
});


/*=============================================
	MOSTRAR EN FORMATO DINERO prestamoMontoPrestado
=============================================*/

$('#modal-nuevo-prestamo').on('change', '#sumaPrestamo', function(event) {
	event.preventDefault();
	/* Act on the event */

	$('#sumaPrestamo').attr('MontoReal', $('#sumaPrestamo').val());
	$('#sumaPrestamo').val($.number($('#sumaPrestamo').val(), 2,".",","));
});


/*=============================================
	NUEVO PRESTAMO
=============================================*/


$('#tablaclientes').on('click', '.btnnuevoprestamo', function(event) {
	event.preventDefault();
	const clienteid = $(this).attr('clienteid');
	const clientecedula = $(this).attr('clientecedula');
	$("#clientePrestamo").val(clientecedula);
	$("#idCliente").val(clienteid);
	$("#interesPrestamo").val("");
	$("#sumaPrestamo").attr('MontoReal',"");
	$("#sumaPrestamo").val("");
	$("#cuotasPrestamo").val("");
	$("#observacionesPrestamo").val("");
	$("#modal-nuevo-prestamo").modal("show");
});


/*=============================================
	GUARDAR PRESTAMO
=============================================*/

$("#modal-nuevo-prestamo").on('click', '.btn-guardar-prestamo', function(event) {
	event.preventDefault();
	/* Act on the event */
	const pre_Id = ($("#idPrestamo").val() != "") ? $("#idPrestamo").val() : 0;
	const pre_Cliente = $("#idCliente").val();
	const pre_FormaPago = $("#comboformapago").val();
	const pre_Interes = $("#interesPrestamo").val();
	const pre_MontoPrestado = $("#sumaPrestamo").attr('MontoReal');
	const pre_Cuotas = $("#cuotasPrestamo").val();
	const pre_Observaciones = $("#observacionesPrestamo").val();
	let datos = new FormData();
	datos.append("pre_Id", pre_Id);
	datos.append("pre_CLIENTE", pre_Cliente);
	datos.append("pre_FormaPago", pre_FormaPago);
	datos.append("pre_Interes", pre_Interes);
	//datos.append("pre_MontoInteres", 100000);
	datos.append("pre_MontoPrestado", pre_MontoPrestado);
	datos.append("pre_Cuotas", pre_Cuotas);
	datos.append("pre_Observaciones", pre_Observaciones);
	datos.append("pre_USUARIO", user_Id);
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
			if (respuesta.mensaje === 'ok') {
				Swal.fire(
					'Guardar Datos!',
					'Prestamo Guardado Correctamente.',
					'success'
				);
				$("#modal-nuevo-prestamo").modal("hide");
			} else {
				Swal.fire(
					'Advertencia !',
					'Error: ' + respuesta.codigo,
					'warning'
				)
			}
		})
		.fail(function(respuesta) {
			console.log("respuesta", respuesta.responseText);
			console.log("error");
		});
});


/*=============================================
			BUSCAR SI EXISTE CLIENTE
=============================================*/


$("#modal-nuevo-cliente").on('change', '#clienteCedula', function(event) {
	event.preventDefault();
	/* Act on the event */

	$(".alert").remove();

	const valor = $("#clienteCedula").val();
	let datos = new FormData();
	datos.append("valor", valor);
	datos.append("item", "cli_Cedula");
	datos.append("acc", "existe");
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
			//console.log("respuesta ", respuesta);
			if (respuesta) {
				$("#clienteCedula").parent().after('<div class="alert alert-warning">Este Cliente ya existe en la base de datos</div>');

				$("#clienteCedula").val("");

				/*Toast.fire({
					type: 'warning',
					title: ' Cedula Ya Esta Registrada'
				})*/
			}
		})
		.fail(function(respuesta) {
			console.log("respuesta.responseText ", respuesta.responseText);
			console.log("error");
		});

});

/*=============================================
			BUSCAR SI EXISTE # TELEFONO
=============================================*/


$("#modal-nuevo-cliente").on('change', '#clienteCelular', function(event) {
	event.preventDefault();
	/* Act on the event */

	$(".alert").remove();

	const valor = $("#clienteCelular").val();
	let datos = new FormData();
	datos.append("valor", valor);
	datos.append("item", "cli_Celular");
	datos.append("acc", "existe");
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
			//console.log("respuesta ", respuesta);
			if (respuesta) {
				$("#clienteCelular").parent().after('<div class="alert alert-warning">Este Telefono ya existe en la base de datos</div>');

				$("#clienteCelular").val("");

				/*Toast.fire({
					type: 'warning',
					title: ' Cedula Ya Esta Registrada'
				})*/
			}
		})
		.fail(function(respuesta) {
			console.log("respuesta.responseText ", respuesta.responseText);
			console.log("error");
		});

});