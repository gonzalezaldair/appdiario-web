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
	$(".selectrutaActivo").hide();
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


let tablaPerfil = $('#tablaperfil').DataTable({
	"ajax": "ajax/perfil.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": lenguajeTabla
});



/**
 * TRAER DATOS DE PERFIL
 */

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
			$("#per_Activo").val(respuesta["per_Activo"]);
			$("#modal-nuevo-perfil .modal-title").text("Editar Perfil");
			$("#modal-nuevo-perfil .modal-header").removeClass('bg-primary');
			$("#modal-nuevo-perfil .modal-header").addClass('bg-success');
			$(".selectrutaActivo").show();
			$("#modal-nuevo-perfil").modal("show");
		})
		.fail(function(response) {
			console.log("error", response.responseText);
		});
});



/**
 * GUARDAR PERFIL
 */


$("#modal-nuevo-perfil").on('click', '.btnguardar-datos-perfil', function(event) {
	event.preventDefault();
	/* Act on the event */
	const codigo = $("#per_Codigo").val();
	const id = ($("#per_Id").val() != "") ? $("#per_Id").val() : 0;
	const nombre = $("#per_Nombre").val();
	const per_Activo = $("#per_Activo").val();
	const expr = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/;
	if (nombre != "" && expr.test(nombre)) {
		let datos = new FormData();
		datos.append("per_Codigo", codigo);
		datos.append("per_Id", id);
		datos.append("per_Nombre", nombre);
		datos.append("per_Activo", per_Activo);
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
				if (respuesta.mensaje === 'ok') {
					Swal.fire({
						title: 'Guardar Datos',
						text: "Datos Guardados Correctamente.",
						type: 'success',
						confirmButtonColor: '#3085d6',
						confirmButtonText: '! Cerrar ¡'
					}).then((result) => {
						if (result.value) {
							tablaPerfil.ajax.reload();
						}
					})
					$("#modal-nuevo-perfil").modal("hide");
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
			.fail(function(response) {
				console.log("error", response.responseText);
			});
	} else {
		Swal.fire({
			title: 'Advertencia',
			text: "Error: Campo Nombre esta vacio o tiene caracteres no permitidos",
			type: 'warning',
			confirmButtonColor: '#3085d6',
			confirmButtonText: '! Cerrar ¡'
		});
	}
});



/**
 * ELIMINAR PEFIL
 */


$("#tablaperfil").on('click', '.btneliminarperfil', function(event) {
	event.preventDefault();
	/* Act on the event */
	const perfilid = $(this).attr('perfilid');
	let datos = new FormData();
	datos.append("perid", perfilid);
	datos.append("acc", "eliminar");
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
			if (respuesta.mensaje === 'ok') {
				Swal.fire({
					title: 'Eliminar Datos',
					text: "Datos Actualizados Correctamente.",
					type: 'success',
					confirmButtonColor: '#3085d6',
					confirmButtonText: '! Cerrar ¡'
				}).then((result) => {
					if (result.value) {
						tablaPerfil.ajax.reload();
					}
				})
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
		.fail(function(response) {
			console.log("error", response.responseText);
		});
});