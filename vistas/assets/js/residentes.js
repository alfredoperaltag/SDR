//FECHA DEL SISTEMA
var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
var f = new Date();
var fecha = f.getDate() + "/" + meses[f.getMonth()] + "/" + f.getFullYear();
var fecha2 = f.getDate() + "/" + meses[f.getMonth()] + "/" + f.getFullYear();
var fecha2 = f.getFullYear() + "-" + meses[f.getMonth()] + "-" + f.getDate();

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
            if (respuesta["revisionOK"] == 0) {
                document.getElementById("customCheck4").checked = false;
                document.getElementById("customCheck5").checked = false;
                document.getElementById("customCheck6").checked = false;
            } else if (respuesta["revisionOK"] == 1) {
                document.getElementById("customCheck4").checked = true;
                document.getElementById("customCheck5").checked = false;
                document.getElementById("customCheck6").checked = false;
            } else if (respuesta["revisionOK"] == 2) {
                document.getElementById("customCheck4").checked = true;
                document.getElementById("customCheck5").checked = true;
                document.getElementById("customCheck6").checked = false;
            } else if (respuesta["revisionOK"] == 3) {
                document.getElementById("customCheck4").checked = true;
                document.getElementById("customCheck5").checked = true;
                document.getElementById("customCheck6").checked = true;
            }
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
IMPRIMIR INFORMACION RESIDENTE PARA DOCUMENTOS
======================================-->*/
$(document).on("click", ".btnImprimirDoc", function () {
    idResidente = $(this).attr("idResidenteImp");
    // console.log("R: ", idResidente);
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

            document.getElementById("btnImprimirAsesores").disabled = true;
            document.getElementById("btnImprimirLiberacion").disabled = true;
            document.getElementById("btnImprimirJurado").disabled = true;
            document.getElementById("btnImprimirComisionT").disabled = true;
            document.getElementById("btnImprimirSinodales").disabled = true;

            $("#impNoControl").val(respuesta["noControl"]);
            $("#impNoControlT").val(respuesta["noControl"]);
            $("#impNombre").val(respuesta["nombre"]);
            $("#impNombreT").val(respuesta["nombre"]);
            if (respuesta["revisionOK"] == 0) {
                document.getElementById("customCheck7").checked = false;
                document.getElementById("customCheck8").checked = false;
                document.getElementById("customCheck9").checked = false;
            } else if (respuesta["revisionOK"] == 1) {
                document.getElementById("customCheck7").checked = true;
                document.getElementById("customCheck8").checked = false;
                document.getElementById("customCheck9").checked = false;
            } else if (respuesta["revisionOK"] == 2) {
                document.getElementById("customCheck7").checked = true;
                document.getElementById("customCheck8").checked = true;
                document.getElementById("customCheck9").checked = false;
            } else if (respuesta["revisionOK"] == 3) {
                document.getElementById("customCheck7").checked = true;
                document.getElementById("customCheck8").checked = true;
                document.getElementById("customCheck9").checked = true;

                document.getElementById("btnImprimirAsesores").disabled = false;
                document.getElementById("btnImprimirLiberacion").disabled = false;
                document.getElementById("btnImprimirJurado").disabled = false;
                document.getElementById("btnImprimirComisionT").disabled = false;
                document.getElementById("btnImprimirSinodales").disabled = false;
            }
        }
    });
});

/*<!--=====================================
IMPRIMIR DICTAMEN
======================================-->*/
$(document).on("click", "#btnImprimirDictamen", function () {
    console.log("idResidenteDic: " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1', '2']
    }).queue([{
            input: 'text',
            inputValue: fecha,
            title: 'Fecha',
            text: 'Introduzca una fecha valida'
        },
        {
            title: 'Estado del dictamen',
            text: 'Seleccione "Aceptado" ó "Rechazado"',
            input: 'radio',
            inputOptions: {
                'Aceptado': 'Aceptado',
                'Rechazado': 'Rechazado'
            },
            inputValidator: function (result) {
                if (!result) {
                    return 'Necesita seleccionar una opción!';
                }
            }
        }
    ]).then((result) => {
        if (result.value) {
            window.open("pdf/residencias/dictamen.php?id=" + idResidente + "&fecha=" + result.value[0] + "&estado=" + result.value[1], "_blank");
            /* window.open("pdf/residencias/dictamen.php"); */
        }
    })
});


/*<!--=====================================
IMPRIMIR JURADO SELECCIONADO
======================================-->*/
$(document).on("click", "#btnImpJurado", function () {
    // console.log("J=  " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1', '2']
    }).queue([{
            input: 'text',
            inputValue: fecha2,
            title: 'Fecha',
            text: 'Introduzca una fecha valida'
        },
        {
            title: 'Documento',
            text: 'Introduzca el numero de documento',
            input: 'text'
        }
    ]).then((result) => {
        if (result.value) {
            window.open("pdf/tesis/jurado.php?id=" + idResidente + "&fecha=" + result.value[0] + "&numero=" + result.value[1], "_blank");
        }
    })
});


/*<!--=====================================
IMPRIMIR LIBERACION
======================================-->*/
$(document).on("click", "#btnImpLiberacionR", function () {
    // console.log("J=  " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1', '2']
    }).queue([{
            input: 'text',
            inputValue: fecha2,
            title: 'Fecha',
            text: 'Introduzca una fecha valida'
        },
        {
            title: 'Documento',
            text: 'Introduzca el numero de documento',
            input: 'text'
        }
    ]).then((result) => {
        if (result.value) {
            window.open("pdf/tesis/liberacion.php?id=" + idResidente + "&fecha=" + result.value[0] + "&numero=" + result.value[1], "_blank");
        }
    })
});