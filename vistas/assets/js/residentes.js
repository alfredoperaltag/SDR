/*<!--=====================================
INFORMACION RESIDENTE
======================================-->*/

$(document).on("click", ".btnInfoResidente", function () {
    var idInfo = $(this).attr("idResidente");
      console.log("idResidente =", idInfo);
    var datos = new FormData();
    datos.append("idResidente", idInfo);
    $.ajax({
        url: "ajax/residentes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("respuesta", respuesta);
            $("#InfoNombre").val(respuesta["nombre"]);
        }
    });
})