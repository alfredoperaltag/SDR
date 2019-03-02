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