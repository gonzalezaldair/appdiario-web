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
	$("#prestamoMontoInteres").val("");

	$("#modal-nuevo-prestamo .modal-title").text("Nuevo Prestamo");
	$("#modal-nuevo-prestamo .modal-header").removeClass('bg-success');
	$("#modal-nuevo-prestamo .modal-header").addClass('bg-primary');
	$(".input-codigo").hide();


});



/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/


let tablaPrestamos = $('#tablaPrestamos').DataTable( {
	"order": [[ 0, "desc" ]],
    "ajax": "ajax/prestamos.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": lenguajeTabla
} );


$("#modal-nuevo-prestamo").on('click', '.btn-guardar-prestamo', function(event) {
	event.preventDefault();
	/* Act on the event */
	const pre_Id = ($("#prestamoId").val() != "") ? $("#prestamoId").val() : 0;
	const pre_Cliente = $("#prestamoCliente").val();
	const pre_FormaPago = $("#prestamoFormaPago").val();
	const pre_Interes = $("#prestamoInteres").val();
	const pre_MontoPrestado = $("#prestamoMontoPrestado").attr('MontoReal');
	const pre_Cuotas = $("#prestamoCuotas").val();
	const pre_Observaciones = $("#prestamoObservaciones").val();
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
			Swal.fire({
				title: 'Guardar Datos',
				text: "Datos Guardados Correctamente.",
				type: 'success',
				confirmButtonColor: '#3085d6',
				confirmButtonText: '! Cerrar ¡'
			}).then((result) => {
				if (result.value) {
					tablaPrestamos.ajax.reload();
				}
			})
			$("#modal-nuevo-prestamo").modal("hide");
		})
		.fail(function(respuesta) {
			console.log("respuesta", respuesta.responseText);
			console.log("error");
		});
});



/*=============================================
	VALIDAR QUE SOLO INGRESEN VALORES PERMITIDOS
=============================================*/


$("input.validarNumero").on("input", function() {
	this.value = this.value.replace(/[^0-9.]/g, '');
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
			$("#prestamoInteres").val(respuesta["pre_Interes"]+" %");
			$("#prestamoInteres").attr('readonly', true);
			$("#prestamoMontoPrestado").attr('readonly', true);
			$("#prestamoCliente").attr('readonly', true);
			$("#prestamoMontoPrestado").val($.number(respuesta["pre_MontoPrestado"], 2,".",","));
			$("#prestamoMontoPrestado").attr('MontoReal',respuesta["pre_MontoPrestado"]);
			$("#prestamoCuotas").val(respuesta["pre_Cuotas"]);
			$("#prestamoObservaciones").val(respuesta["pre_Observaciones"]);
			$("#prestamoUsuario").val(respuesta["pre_USUARIO"]);
			$("#prestamoMontoInteres").val(respuesta["pre_MontoInteres"]);
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
	$("#prestamosabonosaldo").val($.number(saldo, 2,".",","));
	$("#prestamosabonosaldo").attr("saldo",saldo);

	$("#modal-nuevo-abono").modal("show");
});


/*=============================================
	GUARDAR NUEVO ABONO
=============================================*/


$('#modal-nuevo-abono').on('click', '.btn-guardar-abono', function(event) {
	event.preventDefault();
	const abo_Id = ($("#abo_Id").val() != "") ? $("#abo_Id").val() : 0;
	const abo_PRESTAMO = $("#prestamoabonoid").val();
	const abo_Monto = $("#prestamosabonoSuma").attr('AbonoReal');
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
			Swal.fire({
				title: 'Guardar Datos',
				text: "Datos Guardados Correctamente.",
				type: 'success',
				confirmButtonColor: '#3085d6',
				confirmButtonText: '! Cerrar ¡'
			}).then((result) => {
				if (result.value) {
					tablaPrestamos.ajax.reload();
				}
			})
			$('#modal-nuevo-abono').modal("hide");
		})
		.fail(function(respuesta) {
			console.info("respuesta", respuesta.responseText);
			console.log("error");
		});

});


/*=============================================
	MOSTRAR EN FORMATO DINERO prestamoMontoPrestado
=============================================*/

$('#modal-nuevo-prestamo').on('change', '#prestamoMontoPrestado', function(event) {
	event.preventDefault();
	/* Act on the event */

	$('#prestamoMontoPrestado').attr('MontoReal', $('#prestamoMontoPrestado').val());
	$('#prestamoMontoPrestado').val($.number($('#prestamoMontoPrestado').val(), 2,".",","));
});


/*=============================================
	MOSTRAR EN FORMATO DINERO prestamosabonoSuma
=============================================*/

$("#prestamosabonoSuma").on('change', function(event) {
	event.preventDefault();
	/* Act on the event */

	$(this).attr('AbonoReal', $(this).val());
	$(this).val($.number($(this).val(), 2,".",","));
	const saldo = $("#prestamosabonosaldo").attr("saldo");
	const abonoReal = $(this).attr("AbonoReal")
	$("#prestamosabonosaldo").val(saldo - abonoReal);
	$("#prestamosabonosaldo").val($.number($('#prestamosabonosaldo').val(), 2,".",","));

});



/*=============================================
	SUMA CON INTERES
=============================================*/


/*$('#modal-nuevo-prestamo').on('keyup', '#prestamoInteres', function(event) {
	event.preventDefault();

	const pre_Interes = ( $("#prestamoInteres").val() > 9) ? $("#prestamoInteres").val() : "1.0"+$("#prestamoInteres").val();
	const pre_Suma = $("#prestamoMontoPrestado").val();
	$("#prestamoMontoInteres").val(pre_Suma*pre_Interes);

});*/



/*=============================================
				LIVE SEARCH
=============================================*/


$('#modal-nuevo-prestamo').on('keyup', '#prestamoCliente', function(event) {
	event.preventDefault();
	/* Act on the event */
	$('#livesearchPersonaPrestamos').html('');
	const valorbusqueda = $(this).val();
	const expresion = /^[0-9]*$/;

	if (valorbusqueda.length > 4 && expresion.test(valorbusqueda)) {
		let datos = new FormData();
		datos.append("clienteid", valorbusqueda);
		datos.append("acc", "livesearch");
		$.ajax({
				url: 'ajax/clientes.ajax.php',
				type: 'post',
				cache: false,
				contentType: false,
				processData: false,
				data: datos,
			})
			.done(function(data) {
				const obj = JSON.parse(data);
				$.each(obj, function(index, value) {
					$('#livesearchPersonaPrestamos').append('<li class="list-group-item link-class"> ' + value.cli_Nombre + ' | <span> ' + value.cli_Celular + '</span> | <span> ' + value.cli_Id + '</span></li>');
				});
				console.log("success");
			})
			.fail(function(respuesta) {
				console.log("respuesta", respuesta.responseText);
				console.log("error");
			});

	}
});


/*===============================================================
					CAPTURAR VALOR DE LIVE SEARCH
================================================================*/


$('#livesearchPersonaPrestamos').on('click', 'li', function() {
	const click_text = $(this).text().split('|');
	$('#prestamoCliente').val($.trim(click_text[2]));
	$("#livesearchPersonaPrestamos").html('');
});