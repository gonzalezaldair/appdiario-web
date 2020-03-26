

/*=============================================
CORRECCIÓN BOTONERAS OCULTAS BACKEND
=============================================*/
/*
if(window.matchMedia("(max-width:767px)").matches){

	$("body").removeClass('sidebar-collapse');

}else{

	$("body").addClass('sidebar-collapse');
}*/


$("#buscarmenu").on('keyup', function(event) {
	event.preventDefault();
	/* Act on the event */
	let value = $(this).val().toLowerCase();
	console.log("value", value);

	$(".nav-sidebar li a").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });

});


/*=============================================
Data Table
=============================================*/

$(".tablas").DataTable({

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

});


/*=============================================
ACTIVAR SIDEBAR
=============================================*/
/*
$(document).on("click", ".nav-sidebar li", function(){

	localStorage.setItem("botonera", $(this).children().attr("href"));

})

if(localStorage.getItem("botonera") == null){

	$(".nav-sidebar li").removeClass("active");

	$(".nav-sidebar li a[href='inicio']").parent().addClass("active")

}else{

	$(".nav-sidebar li").removeClass("active");

	$("a[href='"+localStorage.getItem("botonera")+"']").parent().addClass("active")

}*/
