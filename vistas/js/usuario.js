/*=============================================
CARGAR LA TABLA DINÁMICA DE USUARIO
=============================================*/
/*
$.ajax({

	url: "ajax/usuario.ajax.php",
	success: function(respuesta) {

		console.log("respuesta", respuesta);

	}

})*/

var allpermisos ;
let datospermisos = new FormData();
datospermisos.append("acc", "allpermisos");
$.ajax({
		url: "ajax/usuario.ajax.php",
		method: "POST",
		data: datospermisos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
	})
	.done(function(respuesta) {
		allpermisos = respuesta;
	})
	.fail(function(respuesta) {
		console.log("error ", respuesta);
	});


$("#btnmodalnuevousuario").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */

	$("#usuarioCedula").val("");
	$("#usuarioCedula").attr('readonly', false);
	$("#usuarioId").val("");
	$("#usuarioUsuario").val("");
	$("#usuarioUsuario").attr('readonly', true);
	$("#usuarioPassword").val("");
	$("#usuarioPassword").attr('readonly', false);
	$("#usuarioNombre").val("");
	$("#usuarioCelular").val("");
	$("#usuarioCorreo").val("");
	$("#usuarioDireccion").val("");
	$("#usuarioRUTA").val(1);
	$("#usuarioActivo").val(1);
	$(".selectrutaActivo").hide();
	$(".divusuarioPassword").show();
	$("#modal-nuevo-usuario .modal-title").text("Nuevo Usuario");
	$("#modal-nuevo-usuario .modal-header").removeClass('bg-success');
	$("#modal-nuevo-usuario .modal-header").addClass('bg-primary');


});


/*=============================================
CARGAR COMBO RUTAS
=============================================*/


$("#usuarioRUTA").html("");
let combousuarioruta = new FormData();
combousuarioruta.append("acc", "comborutas");
$.ajax({
		url: "ajax/rutas.ajax.php",
		method: "POST",
		data: combousuarioruta,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
	})
	.done(function(respuesta) {
		//console.log("respuesta", respuesta);
		for (var i = 0; i < respuesta.length; i++) {
			if (respuesta[i].rut_Activo == 1) {
				$("#usuarioRUTA").append('<option value=' + respuesta[i].rut_Id + '>' + respuesta[i].rut_Nombre + '</option>');
			}
		}
	})
	.fail(function(respuesta) {
		console.log("error ", respuesta);
	});


/*=============================================
CARGAR COMBO RUTAS
=============================================*/


$("#usuarioPERFIL").html("");
let combousuarioPerfil = new FormData();
combousuarioPerfil.append("acc", "comboperfil");
$.ajax({
		url: "ajax/perfil.ajax.php",
		method: "POST",
		data: combousuarioPerfil,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
	})
	.done(function(respuesta) {
		//console.log("respuesta", respuesta);
		for (var i = 0; i < respuesta.length; i++) {
			if (respuesta[i].per_Activo == 1) {
				$("#usuarioPERFIL").append('<option value='+respuesta[i].per_Id+'>'+respuesta[i].per_Nombre+'</option>');
			}
		}
	})
	.fail(function(respuesta) {
		console.log("error ", respuesta);
	});




/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/


let tablaUsuario = $('#tablausuario').DataTable( {
    "ajax": "ajax/usuario.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": lenguajeTabla
} );

/*=============================================
	ACTUALIZAR USUARIO
=============================================*/


$('#tablausuario').on('click', '.btnupdusuario', function(event) {
	event.preventDefault();
	$("#errorUsuario").html("");
	const usuarioid = $(this).attr('usuarioid');
	const usuariocedula = $(this).attr('usuariocedula');
	let datos = new FormData();
	datos.append("valor", usuarioid);
	datos.append("item", "usu_Id");
	datos.append("acc", "traer");
	$.ajax({
			url: "ajax/usuario.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(respuesta) {
			$("#usuarioCedula").val(respuesta["usu_Cedula"]);
			$("#usuarioCedula").attr('readonly', true);
			$("#usuarioId").val(respuesta["usu_Id"]);
			$("#usuarioUsuario").val(respuesta["usu_Login"]);
			$("#usuarioUsuario").attr('readonly', true);
			$("#usuarioPassword").val(respuesta["usu_Password"]);
			$("#usuarioPassword").attr('readonly', false);
			$("#usuarioNombre").val(respuesta["usu_Nombre"]);
			$("#usuarioCelular").val(respuesta["usu_Celular"]);
			$("#usuarioCorreo").val(respuesta["usu_Correo"]);
			$("#usuarioDireccion").val(respuesta["usu_Direccion"]);
			$("#usuarioRUTA").val(respuesta["usu_RUTA"]);
			$("#usuarioPERFIL").val(respuesta["usu_Perfil"]);
			$("#usuarioActivo").val(respuesta["usu_Activo"]);
			$(".selectrutaActivo").show();
			$(".divusuarioPassword").hide();
			$("#modal-nuevo-usuario .modal-title").text("Editar Usuario");
			$("#modal-nuevo-usuario .modal-header").addClass('bg-success');
			$("#modal-nuevo-usuario .modal-header").removeClass('bg-primary');
			$("#modal-nuevo-usuario").modal("show");
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});

/**
 * PERMISOS USUARIO
 */


$("#tablausuario").on('click', '.btnpermisosusuario', function(event) {
	$("#bodytabpermisos").html("");
	event.preventDefault();
	/* Act on the event */
	const usuarioid = $(this).attr('usuarioid');
	let datos = new FormData();
    datos.append("usuarioid", usuarioid);
    datos.append("acc", "permisos");
    $.ajax({
		url:"ajax/usuario.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
	})
	.done(function(respuesta) {
		let tablapermisos = "";
		for (var i = 0; i < allpermisos.length; i++) {

			tablapermisos += '<tr>';
			tablapermisos += '<td>'+allpermisos[i].mod_Nombre+'</td>';
			for (var j = 0; j < respuesta.length; j++) {
				console.log("respuesta[j].rolus_ROL", respuesta[j].rolus_ROL);
				if (respuesta[j].rolus_ROL == allpermisos[i].Crear)
				{
					console.log("entro en crear");
					crear ='<td><input type ="checkbox" checked value="'+respuesta[j].rolus_ROL+'"></td>';
				}
				else
				{
					crear ='<td><input type ="checkbox" value="'+allpermisos[i].Crear+'"></td>';
				}
				if (respuesta[j].rolus_ROL == allpermisos[i].Actualizar)
				{
					console.log("entro en Actualizar");
					actualizar ='<td><input type ="checkbox" checked value="'+respuesta[j].rolus_ROL+'"></td>';
				}
				else
				{
					actualizar ='<td><input type ="checkbox" value="'+allpermisos[i].Actualizar+'"></td>';
				}
				if (respuesta[j].rolus_ROL == allpermisos[i].Leer)
				{
					console.log("entro en Leer");
					leer ='<td><input type ="checkbox" checked value="'+respuesta[j].rolus_ROL+'"></td>';
				}
				else
				{
					leer ='<td><input type ="checkbox" value="'+allpermisos[i].Leer+'"></td>';
				}
				if (respuesta[j].rolus_ROL == allpermisos[i].Borrar)
				{
					console.log("entro en Borrar");
					borrar ='<td><input type ="checkbox" checked value="'+respuesta[j].rolus_ROL+'"></td>';
				}
				else
				{
					borrar ='<td><input type ="checkbox" value="'+allpermisos[i].Borrar+'"></td>';
				}
			}
			tablapermisos += '<td>'+crear+'</td>';
			tablapermisos += '<td>'+actualizar+'</td>';
			tablapermisos += '<td>'+leer+'</td>';
			tablapermisos += '<td>'+borrar+'</td>';
			tablapermisos += '</tr>';
		}

		$("#bodytabpermisos").html(tablapermisos);
	})
	.fail(function(respuesta) {
		console.log("error ",respuesta);
	});
	$("#modal-permisos-usuario").modal("show");
});



/**
 * COMPROBAR SI LA CEDULA YA EXISTE
 */


$("#modal-nuevo-usuario").on('change', '#usuarioCedula', function(event) {
	event.preventDefault();
	/* Act on the event */
	const valor = $(this).val();
	let datos = new FormData();
	datos.append("valor", valor);
	datos.append("item", "usu_Cedula");
	datos.append("acc", "traer");
	$.ajax({
			url: "ajax/usuario.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(response) {
			if (typeof response["usu_Cedula"] !== 'undefined') {
				Swal.fire({
					title: 'Advertencia',
					text: "Cedula Ya se encuentra registrada.",
					type: 'warning',
					confirmButtonColor: '#3085d6',
					confirmButtonText: '! Cerrar ¡'
				}).then((result) => {
					if (result.value) {
						$("#usuarioCedula").val("");
					}
				})
			} else {
				$("#usuarioUsuario").val(valor);
			}
		})
		.fail(function() {
			console.log("error");
		});
});


/**
 * COMPROBAR SI EL NUMERO DE CELULAR YA EXISTE
 */


$("#modal-nuevo-usuario").on('change', '#usuarioCelular', function(event) {
	event.preventDefault();
	/* Act on the event */
	const valor = $(this).val();
	let datos = new FormData();
	datos.append("valor", valor);
	datos.append("item", "usu_Celular");
	datos.append("acc", "traer");
	$.ajax({
			url: "ajax/usuario.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
		})
		.done(function(response) {
			if (typeof response["usu_Cedula"] !== 'undefined') {
				Swal.fire({
					title: 'Advertencia',
					text: "Celular Ya se encuentra registrada.",
					type: 'warning',
					confirmButtonColor: '#3085d6',
					confirmButtonText: '! Cerrar ¡'
				}).then((result) => {
					if (result.value) {

						$("#usuarioCelular").focus();
						$("#usuarioCelular").val("");
					}
				})
			}
		})
		.fail(function(response) {
			console.log("error: ", response.responseText);
		});
});


/**
 * GUARDAR USUARIO
 */


$("#modal-nuevo-usuario").on('click', '.btn-guardar-usuario', function(event) {
	event.preventDefault();
	/* Act on the event */

	$("#errorUsuario").html("error usuario");
	let mensajesError = [];

	const user_Cedula = $("#usuarioCedula").val();
	let expr = /^[0-9]+$/;
	if (user_Cedula === "" && !expr.test(user_Cedula)) {
		mensajesError.push('Error Cedula: Revisar Campo debe contener un caracter no permitido o esta vacio');
	}
	const user_Id = ($("#usuarioId").val() != "") ? $("#usuarioId").val() : 0;
	const user_Usuario = $("#usuarioUsuario").val();
	const user_Password = $("#usuarioPassword").val();
	expr = /^[a-zA-Z0-9ñÑ]+$/;
	if (user_Password === "" && !expr.test(user_Password)) {
		mensajesError.push('Error Contraseña: Revisar Campo debe contener un caracter no permitido o esta vacio');
	}
	const user_Nombre = $("#usuarioNombre").val();
	expr = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/;
	if (user_Nombre === "" && !expr.test(user_Nombre)) {
		mensajesError.push('Error Nombre: Revisar Campo debe contener un caracter no permitido o esta vacio');
	}
	const user_Celular = $("#usuarioCelular").val();
	expr = /^[0-9]+$/;
	if (user_Celular === "" && !expr.test(user_Celular)) {
		mensajesError.push('Error Celular: Revisar Campo debe contener un caracter no permitido o esta vacio');
	}
	const user_Correo = $("#usuarioCorreo").val();
	const user_Direccion = $("#usuarioDireccion").val();
	const user_Ruta = $("#usuarioRUTA").val();
	const user_Perfil = $("#usuarioPERFIL").val();
	const user_Activo = $("#usuarioActivo").val();
	if (mensajesError.length == 0) {
		let datos = new FormData();
		datos.append("usu_Id", user_Id);
		datos.append("usu_Cedula", user_Cedula);
		datos.append("usu_Login", user_Usuario);
		datos.append("usu_Password", user_Password);
		datos.append("usu_Nombre", user_Nombre);
		datos.append("usu_Celular", user_Celular);
		datos.append("usu_Correo", user_Correo);
		datos.append("usu_Direccion", user_Direccion);
		datos.append("usu_RUTA", user_Ruta);
		datos.append("usu_Perfil", user_Perfil);
		datos.append("usu_Activo", user_Activo);
		datos.append("acc", "add");
		$.ajax({
				url: "ajax/usuario.ajax.php",
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
							$("#modal-nuevo-usuario").modal("hide");
							tablaUsuario.ajax.reload();
						}
					})
				} else {
					Swal.fire({
						title: 'Advertencia',
						text: "Error: " + respuesta.codigo,
						type: 'warning',
						confirmButtonColor: '#3085d6',
						confirmButtonText: '! Cerrar ¡'
					}).then((result) => {
						if (result.value) {}
					})
				}

			})
			.fail(function(respuesta) {
				console.log("respuesta", respuesta.responseText);
				console.log("error");
			});
	} else {
		$("#errorUsuario").html(mensajesError.join('<br>'));
	}

});


/**
 * ELIMINAR USUARIO
 */

$("#tablausuario").on('click', '.btneliminarusuario', function(event) {
	event.preventDefault();
	/* Act on the event */
	const usuarioid = $(this).attr('usuarioid');
	const usuariocedula = $(this).attr('usuariocedula');
	let datos = new FormData();
	datos.append("valor", usuarioid);
	datos.append("item", "usu_Id");
	datos.append("acc", "eliminar");
	$.ajax({
			url: "ajax/usuario.ajax.php",
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
						tablaUsuario.ajax.reload();
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
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});