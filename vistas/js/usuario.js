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
	$("#usuarioId").val("");
	$("#usuarioUsuario").val("");
	$("#usuarioPassword").val("");
	$("#usuarioNombre").val("");
	$("#usuarioCelular").val("");
	$("#usuarioCorreo").val("");
	$("#usuarioDireccion").val("");
	$("#usuarioRUTA").val(1);
	$("#usuarioPERFIL").val(1);
	$("#usuarioActivo").val(1);
	$("#usuarioActivo").attr('disabled', true);


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
			$("#usuarioRUTA").append('<option value='+respuesta[i].rut_Id+'>'+respuesta[i].rut_Nombre+'</option>');
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
			$("#usuarioPERFIL").append('<option value='+respuesta[i].per_Id+'>'+respuesta[i].per_Nombre+'</option>');
		}
	})
	.fail(function(respuesta) {
		console.log("error ", respuesta);
	});




/*=============================================
CARGAR LA TABLA DINÁMICA DE CLIENTES
=============================================*/


$('#tablausuario').DataTable( {
    "ajax": "ajax/usuario.ajax.php",
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
	ACTUALIZAR USUARIO
=============================================*/


$('#tablausuario').on('click', '.btnupdusuario', function(event) {
	event.preventDefault();
	const usuarioid = $(this).attr('usuarioid');
	const usuariocedula = $(this).attr('usuariocedula');
	let datos = new FormData();
    datos.append("usuarioid", usuarioid);
    datos.append("acc", "traer");
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
		$("#usuarioCedula").val(respuesta["usu_Cedula"]);
		$("#usuarioCedula").attr('disabled', true);
		$("#usuarioId").val(respuesta["usu_Id"]);
		$("#usuarioUsuario").val(respuesta["usu_Login"]);
		$("#usuarioUsuario").attr('disabled', true);
		$("#usuarioPassword").val(respuesta["usu_Password"]);
		$("#usuarioNombre").val(respuesta["usu_Nombre"]);
		$("#usuarioCelular").val(respuesta["usu_Celular"]);
		$("#usuarioCorreo").val(respuesta["usu_Correo"]);
		$("#usuarioDireccion").val(respuesta["usu_Direccion"]);
		$("#usuarioRUTA").val(respuesta["usu_RUTA"]);
		$("#usuarioPERFIL").val(respuesta["usu_Perfil"]);
		$("#usuarioActivo").val(respuesta["usu_Activo"]);
		$("#usuarioActivo").attr('disabled', true);
		$("#modal-nuevo-usuario").modal("show");
	})
	.fail(function(respuesta) {
		console.log("error ",respuesta);
	});

});


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
		console.log("respuesta", respuesta);
		console.log("allpermisos", allpermisos);
		let tablapermisos = "";
		for (var i = 0; i < allpermisos.length; i++) {
			console.log("i", i);
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