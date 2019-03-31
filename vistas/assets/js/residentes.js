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
            // console.log("respuesta::", respuesta);
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
    var idResidente = $(this).attr("idResidenteEdit");
    // console.log("idResidenteEdit Edit =", idResidente);
    var datos = new FormData();
    datos.append("idResidenteEdit", idResidente);
    $.ajax({
        url: "ajax/residentes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#idResidenteEdit").val(null);
            $("#editNoControlEdit").val(null);
            $("#editCarrera").val(null);
            $("#editPeriodo").val(null);
            $("#editPeriodoAnio").val(null);
            $("#editNombre").val(null);
            $("#editApellidoP").val(null);
            $("#editApellidoM").val(null);
            $("#editSexo").val(null);
            $("#editTelefono").val(null);
            document.getElementById("customCheck1").checked = false;
            document.getElementById("customCheck2").checked = false;
            document.getElementById("customCheck3").checked = false;

            $("#editTipo").val(null);
            $("#editTipo").attr("readonly", "readonly");
            $("#idProyectoEdit").val(null);
            $("#editNombreProyecto").val(null);
            $("#editNombreEmpresa").val(null);
            $("#editAsesorInt").val(null);
            $("#editAsesorExt").val(null);
            $("#editAsesorExt").removeAttr("readonly");
            $("#editRevisor1").val(null);
            $("#editRevisor2").val(null);
            $("#editRevisor3").val(null);
            $("#editRevisor3").attr("disabled", false);
            $("#editSuplente").val(null);

            if (respuesta["asesorExt"] == 0) {
                // console.log("respuesta::", respuesta);
                $("#idResidenteEdit").val(respuesta["idR"]);
                $("#editNoControlEdit").val(respuesta["noControl"]);
                $("#editCarrera").val(respuesta["carrera"]);
                $("#editPeriodo").val(respuesta["periodo"]);
                $("#editPeriodoAnio").val(respuesta["anio"]);
                $("#editNombre").val(respuesta["nombre"]);
                $("#editApellidoP").val(respuesta["apellidoP"]);
                $("#editApellidoM").val(respuesta["apellidoM"]);
                $("#editSexo").val(respuesta["sexo"]);
                $("#editTelefono").val(respuesta["telefono"]);
                if (respuesta["revision"] == 1) {
                    document.getElementById("customCheck1").checked = true;
                } else if (respuesta["revision"] == 2) {
                    document.getElementById("customCheck1").checked = true;
                    document.getElementById("customCheck2").checked = true;
                } else if (respuesta["revision"] == 3) {
                    document.getElementById("customCheck1").checked = true;
                    document.getElementById("customCheck2").checked = true;
                    document.getElementById("customCheck3").checked = true;
                }
                $("#editTipo").val(respuesta["tipo"]);
                $("#idProyectoEdit").val(respuesta["idP"]);
                $("#editNombreProyecto").val(respuesta["nombreProyecto"]);
                $("#editNombreEmpresa").val(respuesta["nombreEmpresa"]);
                $("#editAsesorInt").val(respuesta["asesorInt"]);
                // $("#editAsesorExt").val(respuesta["asesorExt"]);
                $("#editAsesorExt").attr("readonly", "readonly");
                $("#editRevisor1").val(respuesta["revisor1"]);
                $("#editRevisor2").val(respuesta["revisor2"]);
                $("#editRevisor3").attr("disabled", false);
                $("#editRevisor3").val(respuesta["revisor3"]);
                $("#editSuplente").val(respuesta["suplente"]);
            } else {
                // console.log("respuesta::", respuesta);
                $("#idResidenteEdit").val(respuesta["idR"]);
                $("#editNoControlEdit").val(respuesta["noControl"]);
                $("#editCarrera").val(respuesta["carrera"]);
                $("#editPeriodo").val(respuesta["periodo"]);
                $("#editPeriodoAnio").val(respuesta["anio"]);
                $("#editNombre").val(respuesta["nombre"]);
                $("#editApellidoP").val(respuesta["apellidoP"]);
                $("#editApellidoM").val(respuesta["apellidoM"]);
                $("#editSexo").val(respuesta["sexo"]);
                $("#editTelefono").val(respuesta["telefono"]);
                if (respuesta["revision"] == 1) {
                    document.getElementById("customCheck1").checked = true;
                } else if (respuesta["revision"] == 2) {
                    document.getElementById("customCheck1").checked = true;
                    document.getElementById("customCheck2").checked = true;
                } else if (respuesta["revision"] == 3) {
                    document.getElementById("customCheck1").checked = true;
                    document.getElementById("customCheck2").checked = true;
                    document.getElementById("customCheck3").checked = true;
                }
                $("#editTipo").val(respuesta["tipo"]);
                $("#idProyectoEdit").val(respuesta["idP"]);
                $("#editNombreProyecto").val(respuesta["nombreProyecto"]);
                $("#editNombreEmpresa").val(respuesta["nombreEmpresa"]);
                $("#editAsesorInt").val(respuesta["asesorInt"]);
                $("#editAsesorExt").removeAttr("readonly");
                $("#editAsesorExt").val(respuesta["asesorExt"]);
                $("#editRevisor1").val(respuesta["revisor1"]);
                $("#editRevisor2").val(respuesta["revisor2"]);
                $("#editRevisor3").attr("disabled", true);
                $("#editRevisor3").val(respuesta["revisor3"]);
                $("#editSuplente").val(respuesta["suplente"]);
            }

            // $("#"+id).attr("readonly","readonly");
        }
    });
});

/*<!--=====================================
IMPRIMIR INFORMACION RESIDENTE
======================================-->*/
$(document).on("click", ".btnImprimirDoc", function () {
    idResidente = $(this).attr("idResidenteImp");
    console.log("idResidenteImp =", idResidente);
    var datos = new FormData();
    datos.append("idResidenteImp", idResidente);
    $.ajax({
        url: "ajax/residentes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log("respuesta::", respuesta);
            $("#impId").val(idResidente);
            $("idprueba").val(idResidente);
            $("#impNoControl").val(respuesta["noControl"]);
            $("#impNombre").val(respuesta["nombre"]);
            /*<!--=====================================
            IMPRIMIR DICTAMEN
            ======================================-->*/
            $(document).on("click", "#btnImprimirDictamen", function () {
                /* var idResidente = $(.val).attr("impId"); */
                console.log("idResidenteDic: " + idResidente);
                window.open("dictamen.php", "_blank");
            });
        }
    });
});