/*=============================================
CARGAR LA TABLA DINÁMICA DE ABONOS
=============================================*/
/*
$.ajax({

	url: "ajax/perfil.ajax.php",
	success: function(respuesta) {

		console.log("respuesta", respuesta);

	}

})*/

$("#btn-nuevo-perfil").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	$("#modal-nuevo-perfil .modal-title").text("Nuevo Perfil");
	$("#modal-nuevo-perfil .modal-header").removeClass('bg-success');
	$("#modal-nuevo-perfil .modal-header").addClass('bg-primary');
	$("#per_Codigo").val("");
	$("#per_Id").val("");
	$("#per_Nombre").val("");
	let datos = new FormData();
	datos.append("acc", "consecutivo");
	$.ajax({
			url: "ajax/perfil.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			$("#per_Codigo").val(respuesta);
			$("#modal-nuevo-perfil").modal("show");
		})
		.fail(function(respuesta) {
			console.log("respuesta", respuesta);
			console.log("error");
		});
});

/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/


$('#tablaperfil').DataTable({
	"ajax": "ajax/perfil.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}
});

$("#tablaperfil").on('click', '.btnupdperfil', function(event) {
	event.preventDefault();
	/* Act on the event */
	const perfilid = $(this).attr('perfilid');
	let datos = new FormData();
	datos.append("perid", perfilid);
	datos.append("acc", "traer");
	$.ajax({
			url: "ajax/perfil.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			$("#per_Codigo").val(respuesta["per_Codigo"]);
			$("#per_Id").val(perfilid);
			$("#per_Nombre").val(respuesta["per_Nombre"]);
			$("#modal-nuevo-perfil .modal-title").text("Editar Perfil");
			$("#modal-nuevo-perfil .modal-header").removeClass('bg-primary');
			$("#modal-nuevo-perfil .modal-header").addClass('bg-success');
			$("#modal-nuevo-perfil").modal("show");
		})
		.fail(function() {
			console.log("error");
		});
});


$("#modal-nuevo-perfil").on('click', '.btnguardar-datos-perfil', function(event) {
	event.preventDefault();
	/* Act on the event */
	const codigo = $("#per_Codigo").val();
	const id = $("#per_Id").val();
	const nombre = $("#per_Nombre").val();
	let datos = new FormData();
	datos.append("per_Codigo", codigo);
	datos.append("per_Id", id);
	datos.append("per_Nombre", nombre);
	datos.append("acc", "add");
	$.ajax({
			url: "ajax/perfil.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			console.log("respuesta", respuesta);
			//$("#modal-nuevo-perfil").modal("show");
		})
		.fail(function() {
			console.log("error");
		});
});