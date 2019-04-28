/*<!--=====================================
EDITAR Jerarquia
======================================-->*/
function btnEditarJerarquia(idJerarquia) {
    var datos = new FormData();
    datos.append("idJerarquia", idJerarquia);
    $.ajax({
        url: "ajax/Jerarquia.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarJerarquia").val(respuesta["cargo"]);
        }
    });
}

$(document).on("click", ".btnEditarJerarquia", function () {
    var idJerarquia = $(this).attr("idJerarquia");
    btnEditarJerarquia(idJerarquia);
})