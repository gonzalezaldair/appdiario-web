/*=============================================
CARGAR LA TABLA DINÁMICA DE formapago
=============================================*/
/*
$.ajax({

	url: "ajax/rutas.ajax.php",
	success: function(respuesta) {

		console.log("respuesta", respuesta);

	}

})*/


/*=============================================
CARGAR COMBO
=============================================*/


$("#rutaCobro").html("");
let combocobro = new FormData();
combocobro.append("acc", "comboCobros");
$.ajax({
		url: "ajax/cobros.ajax.php",
		method: "POST",
		data: combocobro,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
	})
	.done(function(respuesta) {
		//console.log("respuesta", respuesta);
		for (var i = 0; i < respuesta.length; i++) {
			$("#rutaCobro").append('<option value='+respuesta[i].cob_Id+'>'+respuesta[i].cob_Nombre+'</option>');
		}
	})
	.fail(function(respuesta) {
		console.log("error ", respuesta);
	});




/*=============================================
	LIMPIAR CAMPOS MODAL
=============================================*/


$("#btnmodalnuevaruta").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */

		$("#rutaId").val("");
		$("#rutaCodigo").val("");
		$("#rutaNombre").val("");
		$("#rutaCobro").val(1);


});


/*=============================================
CARGAR LA TABLA DINÁMICA DE formapago
=============================================*/


$('#tablarutas').DataTable( {
    "ajax": "ajax/rutas.ajax.php",
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
	ACTUALIZAR CLIENTES
=============================================*/


$('#tablarutas').on('click', '.btnupdruta', function(event) {
	event.preventDefault();
	const rutid = $(this).attr('rutid');
	console.log("rutid", rutid);
	const rutacodigo = $(this).attr('rutcodigo');
	let datos = new FormData();
    datos.append("rutid", rutid);
    datos.append("acc", "traer");
	$.ajax({
		url:"ajax/rutas.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
	})
	.done(function(respuesta) {
		console.log("respuesta", respuesta);
		$("#rutaId").val(respuesta["rut_Id"]);
		$("#rutaCodigo").val(respuesta["rut_Codigo"]);
		$("#rutaNombre").val(respuesta["rut_Nombre"]);
		$("#rutaCobro").val(respuesta["rut_COBRO"]);
		$("#modal-nueva-ruta").modal("show");
	})
	.fail(function(respuesta) {
		console.log("error ",respuesta);
	});

});