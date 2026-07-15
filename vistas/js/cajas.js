/*=============================================
CARGAR LA TABLA DINÁMICA DE formapago
=============================================*/
/*
$.ajax({

    url: "ajax/cajas.ajax.php",
    success: function(respuesta) {

        console.log("respuesta", respuesta);

    }

})*/

let tablacudreCaja = $('#tablaCuadreCajas').DataTable({
    "ajax": "ajax/cajas.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "language": lenguajeTabla
});

$("#modal-nueva-apertura-caja").on('click', '.btn-guardar-aperturacaja', function (event) {
    event.preventDefault();
    /* Act on the event */
    //const frmid = $("#FormaPagoid").val();
    const cuc_Id = ($("#cuc_Id").val() != "") ? $("#cuc_Id").val() : 0;
    const cuc_MontoInicial = $("#cuc_MontoInicial").val();
    let datos = new FormData();
    datos.append("cuc_Id", cuc_Id);
    datos.append("cuc_MontoInicial", cuc_MontoInicial);
    datos.append("acc", "add");
    $.ajax({
        url: "ajax/cajas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
    })
        .done(function (respuesta) {

            if (respuesta.mensaje === 'ok') {
                Swal.fire({
                    title: 'Guardar Datos',
                    text: "Datos Guardados Correctamente.",
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '! Cerrar ¡'
                }).then((result) => {
                    if (result.value) {
                        tablacudreCaja.ajax.reload();
                    }
                })
                $("#modal-nueva-apertura-caja").modal("hide");
            } else {
                Swal.fire({
                    title: 'Advertencia',
                    text: "Error: " + respuesta.mensaje,
                    type: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '! Cerrar ¡'
                });
            }
        })
        .fail(function (respuesta) {
            console.log("error ", respuesta);
        });
});

$('#tablaCuadreCajas').on('click', '.btn-cerrar-caja', function (event) {
    event.preventDefault();
    const cuc_Id = $(this).attr('cuc_Id');
    const cuc_MontoInicial = $(this).attr('cuc_MontoInicial');
    let datos = new FormData();
    datos.append("cuc_Id", cuc_Id);
    datos.append("cuc_MontoInicial", cuc_MontoInicial);
    datos.append("acc", "cerrar-caja");
    $.ajax({
        url: "ajax/cajas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
    })
        .done(function (respuesta) {

            //console.log(respuesta);
            if (respuesta.mensaje === 'ok') {
                Swal.fire({
                    title: 'Guardar Datos',
                    text: "Datos Guardados Correctamente.",
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '! Cerrar ¡'
                }).then((result) => {
                    if (result.value) {
                        tablacudreCaja.ajax.reload();
                    }
                })
            } else {
                Swal.fire({
                    title: 'Advertencia',
                    text: "Error: " + respuesta.mensaje,
                    type: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '! Cerrar ¡'
                });
            }
        })
        .fail(function (respuesta) {
            console.log("error ", respuesta);
        });

});


$("#modal-nuevo-gasto").on('click', '.btn-guardar-gasto', function (event) {
    event.preventDefault();
    const gas_Monto = $("#gas_Monto").val();
    const gas_Tipo = $("#gas_Tipo").val();
    let datos = new FormData();
    datos.append("gas_Monto", gas_Monto);
    datos.append("gas_Tipo", gas_Tipo);
    datos.append("acc", "add");
    $.ajax({
        url: "ajax/gastos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
    })
        .done(function (respuesta) {

            console.log("respuesta ", respuesta);

            if (respuesta.mensaje === 'ok') {
                Swal.fire({
                    title: 'Guardar Datos',
                    text: "Datos Guardados Correctamente.",
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '! Cerrar ¡'
                }).then((result) => {
                    if (result.value) {
                        tablacudreCaja.ajax.reload();
                    }
                })
                $("#modal-nuevo-gasto").modal("hide");
            } else {
                Swal.fire({
                    title: 'Advertencia',
                    text: "Error: " + respuesta.mensaje,
                    type: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '! Cerrar ¡'
                });
            }
        })
        .fail(function (respuesta) {
            console.log("error ", respuesta);
        });
});