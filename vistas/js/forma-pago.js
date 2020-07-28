/*=============================================
CARGAR LA TABLA DINÁMICA DE formapago
=============================================*/
/*
$.ajax({

	url: "ajax/formapago.ajax.php",
	success: function(respuesta) {

		console.log("respuesta", respuesta);

	}

})*/



/*=============================================
	LIMPIAR CAMPOS MODAL
=============================================*/


$("#btnmodalnuevaformapago").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */

	$("#FormaPagoid").val("");
	$("#FormaPagocodigo").val("");
	$("#FormaPagonombre").val("");
	$("#modal-nueva-forma-pago .modal-title").text("Nueva Forma de Pago");
	$("#modal-nueva-forma-pago .modal-header").removeClass('bg-success');
	$("#modal-nueva-forma-pago .modal-header").addClass('bg-primary');
	let datos = new FormData();
	datos.append("acc", "consecutivo");
	$.ajax({
			url: "ajax/formapago.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			$("#FormaPagocodigo").val(respuesta);
			$("#modal-nueva-forma-pago").modal("show");
		})
		.fail(function(respuesta) {
			console.log("respuesta", respuesta);
			console.log("error");
		});
});


/*=============================================
CARGAR LA TABLA DINÁMICA DE formapago
=============================================*/


$('#tablaformapago').DataTable( {
    "ajax": "ajax/formapago.ajax.php",
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
	GUARDAR FORMA PAGO
=============================================*/

$("#modal-nueva-forma-pago").on('click', '.btn-guardar-formapago', function(event) {
	event.preventDefault();
	/* Act on the event */
	//const frmid = $("#FormaPagoid").val();
	const frmid = ($("#FormaPagoid").val() != "") ? $("#FormaPagoid").val() : 0 ;
	const frmcodigo = $("#FormaPagocodigo").val();
	const frmnombre = $("#FormaPagonombre").val();
	const frmactivo = $("#FormaPagoActivo").val();
	let datos = new FormData();
	datos.append("frm_Id", frmid);
	datos.append("frm_Codigo", frmcodigo);
	datos.append("frm_Nombre", frmnombre);
	datos.append("frm_Activo", frmactivo);
	datos.append("acc", "add");
	$.ajax({
			url: "ajax/formapago.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			console.log("respuesta", respuesta);
			$("#modal-nueva-forma-pago").modal("hide");
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});
});


/*=============================================
	TRAER DATOS FORMA PAGO
=============================================*/


$('#tablaformapago').on('click', '.btnupdformapago', function(event) {
	event.preventDefault();
	const frmid = $(this).attr('frmid');
	const frmcodigo = $(this).attr('frmcodigo');
	let datos = new FormData();
	datos.append("frmid", frmid);
	datos.append("acc", "traer");
	$.ajax({
			url: "ajax/formapago.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			$("#FormaPagoid").val(respuesta["frm_Id"]);
			$("#FormaPagocodigo").val(respuesta["frm_Codigo"]);
			$("#FormaPagonombre").val(respuesta["frm_Nombre"]);
			$("#FormaPagoActivo").val(respuesta["frm_Activo"]);
			$(".selectrutaActivo").show();
			$("#modal-nueva-forma-pago .modal-title").text("Editar Forma de Pago");
			$("#modal-nueva-forma-pago .modal-header").addClass('bg-success');
			$("#modal-nueva-forma-pago .modal-header").removeClass('bg-primary');
			$("#modal-nueva-forma-pago").modal("show");
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});


/*=============================================
	ELIMINAR FORMA PAGO
=============================================*/


$('#tablaformapago').on('click', '.btneliminarformapago', function(event) {
	event.preventDefault();
	const frmid = $(this).attr('frmid');
	console.log("frmid", frmid);
	const frmcodigo = $(this).attr('frmcodigo');
	let datos = new FormData();
	datos.append("frm_Id", frmid);
	datos.append("acc", "eliminarfrmpago");
	$.ajax({
			url: "ajax/formapago.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			console.log("respuesta", respuesta);
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});