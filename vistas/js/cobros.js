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

	$("#modal-nuevo-cobro .modal-title").text("Nuevo Cobro");
	$("#modal-nuevo-cobro .modal-header").removeClass('bg-success');
	$("#modal-nuevo-cobro .modal-header").addClass('bg-primary');
	$(".selectrutaActivo").hide();
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


let tablaCobros = $('#tablaCobros').DataTable( {
    "ajax": "ajax/cobros.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": lenguajeTabla
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
			Swal.fire({
				title: 'Guardar Datos',
				text: "Datos Guardados Correctamente.",
				type: 'success',
				confirmButtonColor: '#3085d6',
				confirmButtonText: '! Cerrar ¡'
			}).then((result) => {
				if (result.value) {
					tablaCobros.ajax.reload();
				}
			})
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
			$("#modal-nuevo-cobro").modal("hide");
			tablaCobros.ajax.reload();
		})
		.fail(function(respuesta) {
			console.log("error ", respuesta);
		});

});