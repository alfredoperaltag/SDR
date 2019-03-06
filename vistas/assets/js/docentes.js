/*<!--=====================================
EDITAR DOCENTE
======================================-->*/
$(document).on("click", ".btnEditarDocente", function () {
    var idDocente = $(this).attr("idDocente");
    console.log("idDocente", idDocente);
    var datos = new FormData();
    datos.append("idDocente", idDocente);
    $.ajax({
        url: "ajax/docentes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("respuesta", respuesta);
            $("#editarNombre").val(respuesta["nombre"]);
            $("#idDocente").val(respuesta["id"]);
        }
    });
})
/*<!--=====================================
ACTIVAR DOCENTE
======================================-->*/
$(document).on("click", ".btnActivarDocente", function () {
    var idDocente = $(this).attr("idDocente");
    var estadoDocente = $(this).attr("estadoDocente");

    var datos = new FormData();
    datos.append("activarId", idDocente);
    datos.append("activarDocente", estadoDocente);

    $.ajax({
        url: "ajax/docentes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (window.matchMedia("(max-width:767px)").matches) {
                Swal.fire({
                    type: "success",
                    title: "¡Actualizado Correctamente",
                    showConfirmButton: true,
                    confirmButtontext: "Cerrar",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        window.location = "Docentes";
                    }
                });
            }
        }
    })
    if (estadoDocente == 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoDocente', 1);
    } else {
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoDocente', 0);
    }
})
/*<!--=====================================
ELIMINAR DOCENTE
======================================-->*/
$(document).on("click", ".btnEliminarDocente", function () {
    var idDocente = $(this).attr("idDocente");
    Swal.fire({
        title: '¿Esta seguro de eliminarlo?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: "#d33",
        cancelButtonText: 'Cancelar',
        confirmButtontext: '¡Eliminar!'
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=Docentes&idDocente=" + idDocente;
        }
    })
})