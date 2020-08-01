let user_Id = $("#user_Id").val();
console.log("user_Id", user_Id);


let lenguajeTabla = {

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

const Toast = Swal.mixin({
	toast: true,
	position: 'top-center',
	showConfirmButton: false,
	timer: 6000,
	timerProgressBar: true
});

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

	$(".nav-sidebar li a").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });

});


/*=============================================
ACTIVAR SIDEBAR
=============================================*/

$(document).on("click", ".sidebar li", function(){

	localStorage.setItem("botonera", $(this).children().attr("href"));

})

if(localStorage.getItem("botonera") == null){

	$(".sidebar li").removeClass("active");
	$(".sidebar li a[href='inicio']").addClass("active")

}else{

	$(".sidebar li").removeClass("active");

	$("a[href='"+localStorage.getItem("botonera")+"']").addClass("active")

}
