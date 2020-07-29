/*=============================================
CARGAR LA TABLA DINÁMICA DE formapago
=============================================*/

$.ajax({

	url: "ajax/cobros.ajax.php",
	success: function(respuesta) {

		console.log("respuesta", respuesta);

	}

})


/*=============================================
	LIMPIAR CAMPOS MODAL
=============================================*/


$("#btnmodalnuevocobro").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$("#cobroId").val("");
	$("#cobroCodigo").val("");
	$("#cobroNombre").val("");

	$("#modal-nuevo-cobro .modal-title").text("Nuevo Cobro");
	$("#modal-nuevo-cobro .modal-header").removeClass('bg-success');
	$("#modal-nuevo-cobro .modal-header").addClass('bg-primary');
	let datos = new FormData();
	datos.append("acc", "consecutivo");
	$.ajax({
			url: "ajax/cobros.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			$("#cobroCodigo").val(respuesta);
			$("#modal-nuevo-cobro").modal("show");
		})
		.fail(function(respuesta) {
			console.log("respuesta", respuesta);
			console.log("error");
		});
});


/*=============================================
CARGAR LA TABLA DINÁMICA DE formapago
=============================================*/


$('#tablaCobros').DataTable( {
    "ajax": "ajax/cobros.ajax.php",
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
	TRAER DATOS COBROS
=============================================*/


$('#tablaCobros').on('click', '.btnupdcobro', function(event) {
	event.preventDefault();
	const cobid = $(this).attr('cobid');
	const cobcodigo = $(this).attr('cobcodigo');
	let datos = new FormData();
	datos.append("cobid", cobid);
	datos.append("acc", "traer");
	$.ajax({
			url: "ajax/cobros.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			$("#cobroId").val(respuesta["cob_Id"]);
			$("#cobroCodigo").val(respuesta["cob_Codigo"]);
			$("#cobroNombre").val(respuesta["cob_Nombre"]);
			$("#cobroActivo").val(respuesta["cob_Activo"]);
			$("#modal-nuevo-cobro .modal-title").text("Editar Cobro");
			$("#modal-nuevo-cobro .modal-header").addClass('bg-success');
			$("#modal-nuevo-cobro .modal-header").removeClass('bg-primary');
			$(".selectrutaActivo").show();
			$("#modal-nuevo-cobro").modal("show");
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});


/*=============================================
	GUARDAR DATOS COBROS
=============================================*/


$('#modal-nuevo-cobro').on('click', '.btn-guardar-cobro', function(event) {
	event.preventDefault();
	const cobid = $("#cobroId").val();
	console.log("cobid", cobid);
	const cobcodigo = $("#cobroCodigo").val();
	const cobnombre = $("#cobroNombre").val();
	const cobactivo = $("#cobroActivo").val();
	let datos = new FormData();
	datos.append("cob_Id", cobid);
	datos.append("cob_Codigo", cobcodigo);
	datos.append("cob_Nombre", cobnombre);
	datos.append("cob_Activo", cobactivo);
	datos.append("acc", "add");
	$.ajax({
			url: "ajax/cobros.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			console.log("respuesta", respuesta);
			$("#modal-nuevo-cobro").modal("hide");
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});



/*=============================================
	ELIMINAR DATOS COBROS
=============================================*/


$('#tablaCobros').on('click', '.btneliminarcobro', function(event) {
	event.preventDefault();
	const cobid = $(this).attr("cobid");
	console.log("cobid", cobid);
	let datos = new FormData();
	datos.append("cobid", cobid);
	datos.append("acc", "eliminarcobros");
	$.ajax({
			url: "ajax/cobros.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			console.log("respuesta", respuesta);
			$("#modal-nuevo-cobro").modal("hide");
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});