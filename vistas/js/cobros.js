/*=============================================
CARGAR LA TABLA DINÁMICA DE formapago
=============================================*/
/*
$.ajax({

	url: "ajax/cobros.ajax.php",
	success: function(respuesta) {

		console.log("respuesta", respuesta);

	}

})*/


/*=============================================
	LIMPIAR CAMPOS MODAL
=============================================*/


$("#btnmodalnuevocobro").on('click', function(event) {
	event.preventDefault();
	/* Act on the event */

		$("#cobroId").val("");
		$("#cobroCodigo").val("");
		$("#cobroNombre").val("");


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
	ACTUALIZAR CLIENTES
=============================================*/


$('#tablaCobros').on('click', '.btnupdcobro', function(event) {
	event.preventDefault();
	const cobid = $(this).attr('cobid');
	const cobcodigo = $(this).attr('cobcodigo');
	let datos = new FormData();
    datos.append("cobid", cobid);
    datos.append("acc", "traer");
	$.ajax({
		url:"ajax/cobros.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
	})
	.done(function(respuesta) {
		console.log("respuesta", respuesta);
		$("#cobroId").val(respuesta["cob_Id"]);
		$("#cobroCodigo").val(respuesta["cob_Codigo"]);
		$("#cobroNombre").val(respuesta["cob_Nombre"]);
		$("#modal-nuevo-cobro").modal("show");
	})
	.fail(function(respuesta) {
		console.log("error ",respuesta);
	});

});