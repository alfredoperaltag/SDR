/*<!--=====================================
INFORMACION RESIDENTE
======================================-->*/

$(document).on("click", ".btnInfoResidente", function () {
    var idResidente = $(this).attr("idResidente");
    /* console.log("idResidente =", idResidente); */
    var datos = new FormData();
    datos.append("idResidente", idResidente);
    $.ajax({
        url: "ajax/residentes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("respuesta::", respuesta);
            $("#InfoControl").val(respuesta["noControl"]);
            $("#InfoNombre").val(respuesta["nombre"]);
            $("#InfoCarrera").val(respuesta["carrera"]);
            $("#InfoPeriodo").val(respuesta["periodo"]);
            $("#InfoSexo").val(respuesta["sexo"]);
            $("#InfoTelefono").val(respuesta["telefono"]);
            $("#InfoTipo").val(respuesta["tipo_registro"]);
            $("#InfoProyecto").val(respuesta["nombreProyecto"]);
            $("#InfoEmpresa").val(respuesta["nombreEmpresa"]);
            $("#InfoAsesorExt").val(respuesta["asesorExt"]);
            $("#InfoAsesorInt").val(respuesta["asesorInt"]);
            $("#InfoRevisor1").val(respuesta["revisor1"]);
            $("#InfoRevisor2").val(respuesta["revisor2"]);
            $("#InfoRevisor3").val(respuesta["revisor3"]);
            $("#InfoSuplente").val(respuesta["suplente"]);
        }
    });
});



/*<!--=====================================
    EDITAR RESIDENTE
======================================-->*/

$(document).on("click", ".btnEditResidente", function () {
    var idResidente = $(this).attr("idResidente");
    console.log("idResidente Edit =", idResidente);
    var datos = new FormData();
    datos.append("idResidente", idResidente);
    $.ajax({
        url: "ajax/residentes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("respuesta::", respuesta);
            // $("#editNoControlEdit").val(respuesta["noControl"]);
            // $("#InfoNombre").val(respuesta["nombre"]);
            // $("#editCarrera").val(respuesta["carrera"]);
            // $("#editPeriodo").val(respuesta["periodo"]);
            // $("#InfoSexo").val(respuesta["sexo"]);
            // $("#InfoTelefono").val(respuesta["telefono"]);
            // $("#InfoTipo").val(respuesta["tipo_registro"]);
            // $("#InfoProyecto").val(respuesta["nombreProyecto"]);
            // $("#InfoEmpresa").val(respuesta["nombreEmpresa"]);
            // $("#InfoAsesorExt").val(respuesta["asesorExt"]);
            // $("#InfoAsesorInt").val(respuesta["asesorInt"]);
            // $("#InfoRevisor1").val(respuesta["revisor1"]);
            // $("#InfoRevisor2").val(respuesta["revisor2"]);
            // $("#InfoRevisor3").val(respuesta["revisor3"]);
            // $("#InfoSuplente").val(respuesta["suplente"]);
        }
    });
});