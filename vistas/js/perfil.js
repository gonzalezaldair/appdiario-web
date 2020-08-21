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


/**
 * MODAL PERMISOS
 */



$("#tablaperfil").on('click', '.btnpermisosperfil', function(event) {
	event.preventDefault();

	/* Act on the event */
	const perfilid = $(this).attr('perfilid');
	$('.btn-guardar-permisosperfil').attr('perfilid', perfilid);
	let permisos = [];
	let modulos = JSON.parse($(".modulos").val());
	let datos = new FormData();
	datos.append("perid", perfilid);
	datos.append("acc", "traerpermisos");
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
			$("#bodytabpermisos").html('');
			for (var i = 0; i <  respuesta.length; i++) {
				permisos[i] = respuesta[i].po_OPERACION
			}
			for (var j = 0; j < modulos.length; j++) {

				let permisosperfil = '<tr><td>'+modulos[j].mod_Nombre+'</td>';
				if(jQuery.inArray(modulos[j].Crear, permisos) !== -1)
				{
					permisosperfil += '<td><input id="'+modulos[j].Crear+'_Crear" type="checkbox" class="crear" name="Crear" value="'+modulos[j].Crear+'" checked></td>';
				}else{
					permisosperfil += '<td><input id="'+modulos[j].Crear+'_Crear" type="checkbox" class="crear" name="Crear" value="'+modulos[j].Crear+'"></td>';
				}

				if(jQuery.inArray(modulos[j].Leer, permisos) !== -1)
				{
					permisosperfil += '<td><input id="'+modulos[j].Leer+'_Leer" type="checkbox" class="leer" name="Leer" value="'+modulos[j].Leer+'" checked></td>';
				}else{
					permisosperfil += '<td><input id="'+modulos[j].Leer+'_Leer" type="checkbox" class="leer" name="Leer" value="'+modulos[j].Leer+'"></td>';
				}

				if(jQuery.inArray(modulos[j].Actualizar, permisos) !== -1)
				{
					permisosperfil += '<td><input id="'+modulos[j].Actualizar+'_Actualizar" type="checkbox" class="actualizar" name="Actualizar" value="'+modulos[j].Actualizar+'" checked></td>';
				}else{
					permisosperfil += '<td><input id="'+modulos[j].Actualizar+'_Actualizar" type="checkbox" class="actualizar" name="Actualizar" value="'+modulos[j].Actualizar+'"></td>';
				}

				if(jQuery.inArray(modulos[j].Eliminar, permisos) !== -1)
				{
					permisosperfil += '<td><input id="'+modulos[j].Eliminar+'_Eliminar" type="checkbox" class="eliminar" name="Eliminar" value="'+modulos[j].Eliminar+'" checked></td>';
				}else{
					permisosperfil += '<td><input id="'+modulos[j].Eliminar+'_Eliminar" type="checkbox" class="eliminar" name="Eliminar" value="'+modulos[j].Eliminar+'"></td>';
				}

				permisosperfil += '</tr>';

				$("#bodytabpermisos").append(permisosperfil);
			}
			$("#modal-permisos").modal("show");
		})
		.fail(function(response) {
			console.log("error", response.responseText);
		});
});

/**
 * GUARDAR NUEVOS PERMISOS
 */


$("#modal-permisos").on('click', '.btn-guardar-permisosperfil', function(event) {
	event.preventDefault();
	/* Act on the event */
	let nuevosPermisos = [];
	$("#bodytabpermisos tr").each(function() {

		var modulos = $(this).find("td").eq(0).text();
		if (typeof $(this).find('input:checkbox[name=Crear]:checked').val() !== "undefined") {
			const crear = $(this).find('input:checkbox[name=Crear]:checked').val();
			nuevosPermisos.push(parseInt(crear));
		}

		if (typeof $(this).find('input:checkbox[name=Leer]:checked').val() !== "undefined") {
			const leer = $(this).find('input:checkbox[name=Leer]:checked').val();
			nuevosPermisos.push(parseInt(leer));
		}

		if (typeof $(this).find('input:checkbox[name=Actualizar]:checked').val() !== "undefined") {
			const actualizar = $(this).find('input:checkbox[name=Actualizar]:checked').val();
			nuevosPermisos.push(parseInt(actualizar));
		}

		if (typeof $(this).find('input:checkbox[name=Eliminar]:checked').val() !== "undefined") {
			const Eliminar = $(this).find('input:checkbox[name=Eliminar]:checked').val();
			nuevosPermisos.push(parseInt(Eliminar));
		}


	});

	const perfilid = $(this).attr('perfilid');
	let datos = new FormData();
	datos.append("perid", perfilid);
	datos.append("permisos", nuevosPermisos);
	datos.append("acc", "addnuevospermisos");
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
			if (respuesta.mensaje === 'ok') {
				Swal.fire({
					title: 'Asignar Permisos',
					text: "Permisos Asignados Correctamente.",
					type: 'success',
					confirmButtonColor: '#3085d6',
					confirmButtonText: '! Cerrar ¡'
				}).then((result) => {
					if (result.value) {
						$("#modal-permisos").modal("hide");
						location.reload();
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


/**
 * CHECK ALL
 */


$("#tablapermisosperfil").on('click', '.checkall', function(event) {
	event.preventDefault();
	/* Act on the event */

	const valor = $(this).val();
	$("#bodytabpermisos").each(function() {
		if ($("." + valor).attr('checked')) {
			$("." + valor).attr('checked', false);
		} else {
			$("." + valor).attr('checked', true);
		}
	});
});