//FECHA DEL SISTEMA
var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
var mesesNumero = new Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");

var f = new Date();
var fecha = f.getDate() + "/" + meses[f.getMonth()] + "/" + f.getFullYear();
// FECHA CON CERO INICIAL "02/Mayo/2019"
var MyDate = new Date();
MyDate.setDate(MyDate.getDate());
var fechaR = ('0' + MyDate.getDate()).slice(-2) + "/" + meses[f.getMonth()] + "/" + f.getFullYear();
//FIN
var fechaTesis = f.getDate() + "/" + meses[f.getMonth()] + "/" + f.getFullYear();
var fecha2 = f.getFullYear() + "-" + meses[f.getMonth()] + "-" + f.getDate();
var fecha3 = f.getDate() + "/" + mesesNumero[f.getMonth()] + "/" + f.getFullYear();
var fecha4 = f.getDate() + " De " + meses[f.getMonth()];

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
            // console.table(respuesta);
            // console.log("Tipo: ", respuesta["tipo_registro"]);

            if (respuesta["tipo_registro"] == "Residencias Profesionales") { //residensias
                // console.table(respuesta);
                document.getElementById('CheckResidenciasView1').style.display = 'block'; //muestra chc de residencias
                document.getElementById('CheckTesisView1').style.display = 'none'; //oculta check de tesis

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
                document.getElementById('ViewRevisor32').style.display = 'none';
                document.getElementById('ViewSuplente2').style.display = 'block';


            } else { //Tesis
                // console.table(respuesta);
                document.getElementById('CheckResidenciasView1').style.display = 'none'; //oculta check de residencias
                document.getElementById('CheckTesisView1').style.display = 'block'; //muestra chc de tesis
                if (respuesta["revisionOK"] == 3) {
                    document.getElementById("CheckTesis1").checked = true;
                    document.querySelector('#StatusTesis1').innerText = 'Liberado';
                } else {
                    document.getElementById("CheckTesis1").checked = false;
                    document.querySelector('#StatusTesis1').innerText = 'No liberado';
                }


                document.getElementById('ViewRevisor32').style.display = 'block';
                document.getElementById('ViewSuplente2').style.display = 'none';

            }

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
            $("#editTipo").val(null);
            $("#editTipo").attr("readonly", "readonly");
            document.getElementById("customCheck1").checked = false;
            document.getElementById("customCheck2").checked = false;
            document.getElementById("customCheck3").checked = false;
            // console.log("Tipo: ", respuesta["tipo"]);
            if (respuesta["tipo"] == "Residencias Profesionales") { //residensias
                document.getElementById('CheckResidenciasView').style.display = 'block'; //muestra chc de residencias
                document.getElementById('CheckTesisView').style.display = 'none'; //oculta check de tesis
            } else { //Tesis
                document.getElementById('CheckResidenciasView').style.display = 'none'; //oculta check de residencias
                document.getElementById('CheckTesisView').style.display = 'block'; //muestra chc de tesis
            }

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

            if (respuesta["asesorExt"] == 0) { //TESIS
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

                // if (respuesta["revision"] == 1) {
                //     document.getElementById("customCheck1").checked = true;
                // } else if (respuesta["revision"] == 2) {
                //     document.getElementById("customCheck1").checked = true;
                //     document.getElementById("customCheck2").checked = true;
                // } else if (respuesta["revision"] == 3) {
                //     document.getElementById("customCheck1").checked = true;
                //     document.getElementById("customCheck2").checked = true;
                //     document.getElementById("customCheck3").checked = true;
                // }
                if (respuesta["revision"] == 3) {
                    document.getElementById("CheckTesis").checked = true;
                    document.querySelector('#StatusTesis').innerText = 'Liberado';
                } else {
                    document.getElementById("CheckTesis").checked = false;
                    document.querySelector('#StatusTesis').innerText = 'No liberado';
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


                document.getElementById('ViewRevisor3').style.display = 'block';
                document.getElementById('ViewSuplente').style.display = 'none';
                $("#editRevisor3").attr("disabled", false);
                $("#editRevisor3").val(respuesta["revisor3"]);
                $("#editSuplente").attr("disabled", true);
                $("#editSuplente").val(respuesta["suplente"]);
            } else { //RESIDENCIAS
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
                } else
                if (respuesta["revision"] == 3) {
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

                document.getElementById('ViewRevisor3').style.display = 'none';
                document.getElementById('ViewSuplente').style.display = 'block';
                $("#editRevisor3").attr("disabled", true);
                $("#editRevisor3").val(respuesta["revisor3"]);
                $("#editSuplente").attr("disabled", false);
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

            // document.getElementById("btnImprimirAsesores").disabled = true;
            document.getElementById("btnImprimirLiberacion").disabled = true;
            document.getElementById("btnImprimirRevision").disabled = true;
            document.getElementById("btnImprimirComisionT").disabled = true;
            document.getElementById("btnImprimirJuradoSeleccionado").disabled = true;

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
                document.getElementById("btnImprimirRevision").disabled = false;
                document.getElementById("btnImprimirComisionT").disabled = false;
                document.getElementById("btnImprimirJuradoSeleccionado").disabled = false;
            }

            // document.getElementById('CheckResidenciasView1').style.display='none'; //oculta check de residencias
            // document.getElementById('CheckTesisView1').style.display='block'; //muestra chc de tesis
            document.getElementById("btnImpJurado").disabled = true;
            document.getElementById("btnImpComisionT").disabled = true;
            document.getElementById("btnImpLiberacionR").disabled = true;
            // document.getElementById("btnImpLiberacion").disabled = true;
            if (respuesta["revisionOK"] == 3) {
                document.getElementById("CheckTesis2").checked = true;
                document.querySelector('#StatusTesis2').innerText = 'Liberado';
                document.getElementById("btnImpJurado").disabled = false;
                document.getElementById("btnImpComisionT").disabled = false;
                document.getElementById("btnImpLiberacionR").disabled = false;
                // document.getElementById("btnImpLiberacion").disabled = false;
            } else {
                document.getElementById("CheckTesis2").checked = false;
                document.querySelector('#StatusTesis2').innerText = 'No liberado';
            }
        }
    });
});

/*<!--=====================================
IMPRIMIR DICTAMEN
======================================-->*/
$(document).on("click", "#btnImprimirDictamen", function () {
    // console.log("idResidenteDic: " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1', '2']
    }).queue([{
            input: 'text',
            inputValue: fechaR,
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
IMPRIMIR ASESORES
======================================-->*/
$(document).on("click", "#btnImprimirAsesores", function () {
    // console.log("idResidenteDic: " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1', '2']
    }).queue([{
            input: 'text',
            inputValue: fechaR,
            title: 'Fecha',
            text: 'Introduzca una fecha valida'
        },
        {
            title: '# Oficio',
            text: 'Introduzca el numero de Oficio',
            input: 'text',
            inputValidator: (value) => {
                if (!value) {
                    return '¡Necesita llenar la información!'
                }
            }
        }
    ]).then((result) => {
        if (result.value) {
            window.open("pdf/residencias/asesor.php?id=" + idResidente + "&fecha=" + result.value[0] + "&numero=" + result.value[1], "_blank");
            /* window.open("pdf/residencias/dictamen.php"); */
        }
    })
});


/*<!--=====================================
IMPRIMIR LIBERACION
======================================-->*/
$(document).on("click", "#btnImprimirLiberacion", function () {
    // console.log("idResidenteDic: " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1']
    }).queue([{
        input: 'text',
        inputValue: fechaR,
        title: 'Fecha',
        text: 'Introduzca una fecha valida'
    }]).then((result) => {
        if (result.value) {
            window.open("pdf/residencias/liberacion.php?id=" + idResidente + "&fecha=" + result.value[0], "_blank");
            /* window.open("pdf/residencias/dictamen.php"); */
        }
    })
});


/*<!--=====================================
IMPRIMIR Revision
======================================-->*/
$(document).on("click", "#btnImprimirRevision", function () {
    console.log("idResidenteDic: " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1', '2']
    }).queue([{
            input: 'text',
            inputValue: fechaR,
            title: 'Fecha',
            text: 'Introduzca una fecha valida'
        },
        {
            title: '# Oficio',
            text: 'Introduzca el numero de Oficio',
            input: 'text',
            inputValidator: (value) => {
                if (!value) {
                    return '¡Necesita llenar la información!'
                }
            }
        }
    ]).then((result) => {
        if (result.value) {
            window.open("pdf/residencias/revision.php?id=" + idResidente + "&fecha=" + result.value[0] + "&numero=" + result.value[1], "_blank");
            /* window.open("pdf/residencias/dictamen.php"); */
        }
    })
});
/*<!--=====================================
COMISION PARA TITULACION RESIDENCIAS
======================================-->*/
$(document).on("click", "#btnImprimirComisionT", function () {
    // console.log("J=  " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1', '2', '3', '4', '5']
    }).queue([{
            input: 'text',
            inputValue: fechaR,
            title: 'Fecha',
            text: 'Introduzca una fecha valida para el documento'
        },
        {
            title: 'Documento',
            text: 'Introduzca el numero de documento',
            input: 'text',
            inputValidator: (value) => {
                if (!value) {
                    return '¡Necesita llenar la información!'
                }
            }
        },
        {
            input: 'text',
            inputValue: fecha4,
            title: 'Fecha de Titulación',
            text: 'Introduzca una fecha valida'
        },
        {
            input: 'text',
            inputValue: "10:00",
            title: 'Hora de la Titulación',
            text: 'Introduzca una hora valida'
        },
        {
            title: 'Tipo de documento',
            text: '¿El residente defiende su proyecto?',
            input: 'radio',
            inputOptions: {
                'si': 'SI',
                'no': 'NO'
            },
            inputValidator: function (result) {
                if (!result) {
                    return '¡Necesita seleccionar una opción!';
                }
            }
        }
    ]).then((result) => {
        if (result.value) {
            if (result.value[4] == 'si') {
                PreguntarPromedio(result.value);
            } else {
                window.open("pdf/residencias/comision.php?id=" + idResidente + "&fecha=" + result.value[0] + "&numero=" + result.value[1] + "&fechaT=" + result.value[2] + "&horaT=" + result.value[3] + "&defiende=" + result.value[4] + "&pro=0", "_blank");
            }
        }
    })
});

async function PreguntarPromedio(resulte) {
    // console.table(resulte);
    const {
        value: promedio
    } = await Swal.fire({
        title: 'Promedio',
        text: '¿Cual es el promedio del residente?',
        input: 'text',
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return '¡Necesita escribir el propmedio!'
            }
        }
    })
    if (promedio) {
        // Swal.fire(`Your IP address is ${promedio}`)
        window.open("pdf/residencias/comision.php?id=" + idResidente + "&fecha=" + resulte[0] + "&numero=" + resulte[1] + "&fechaT=" + resulte[2] + "&horaT=" + resulte[3] + "&defiende=" + resulte[4] + "&pro=" + `${promedio}`, "_blank");
    }
}


/*<!--=====================================
IMPRIMIR JuradoSeleccionado
======================================-->*/
$(document).on("click", "#btnImprimirJuradoSeleccionado", function () {
    console.log("idResidenteDic: " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1', '2', '3', '4']
    }).queue([{
            input: 'text',
            inputValue: fechaR,
            title: 'Fecha',
            text: 'Introduzca una fecha valida'
        },
        {
            title: '# Oficio',
            text: 'Introduzca el numero de Oficio',
            input: 'text',
            inputValidator: (value) => {
                if (!value) {
                    return '¡Necesita llenar la información!'
                }
            }
        },
        {
            input: 'text',
            inputValue: fecha4,
            title: 'Fecha de la Titulación',
            text: 'Introduzca una fecha valida'
        },
        {
            input: 'text',
            inputValue: "10:00",
            title: 'Hora de la Titulación',
            text: 'Introduzca una hora valida'
        }
    ]).then((result) => {
        if (result.value) {
            window.open("pdf/residencias/juradoSeleccionado.php?id=" + idResidente + "&fecha=" + result.value[0] + "&numero=" + result.value[1] + "&fechaTitulacion=" + result.value[2] + "&hora=" + result.value[3], "_blank");
            /* window.open("pdf/residencias/dictamen.php"); */
        }
    })
});

/*<!--=====================================
IMPRIMIR OFICIO DE ASIGNACION DE ASESOR TESIS
======================================-->*/
$(document).on("click", "#btnImpAsesorT", function () {
    // console.log("J=  " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1', '2']
    }).queue([{
            input: 'text',
            // inputValue: fechaTesis,
            inputValue: fechaR,
            title: 'Fecha',
            text: 'Introduzca una fecha valida'
        },
        {
            title: 'Documento',
            text: 'Introduzca el numero de documento',
            input: 'text',
            inputValidator: (value) => {
                if (!value) {
                    return '¡Necesita llenar la información!'
                }
            }
        }
    ]).then((result) => {
        if (result.value) {
            window.open("pdf/tesis/asesor.php?id=" + idResidente + "&fecha=" + result.value[0] + "&numero=" + result.value[1], "_blank");
        }
    })
});

/*<!--=====================================
IMPRIMIR JURADO SELECCIONADO TESIS
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
            // inputValue: fechaTesis,
            inputValue: fechaR,
            title: 'Fecha',
            text: 'Introduzca una fecha valida'
        },
        {
            title: 'Documento',
            text: 'Introduzca el numero de documento',
            input: 'text',
            inputValidator: (value) => {
                if (!value) {
                    return '¡Necesita llenar la información!'
                }
            }
        }
    ]).then((result) => {
        if (result.value) {
            window.open("pdf/tesis/revision.php?id=" + idResidente + "&fecha=" + result.value[0] + "&numero=" + result.value[1], "_blank");
        }
    })
});


/*<!--=====================================
IMPRIMIR LIBERACION TESIS
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
            // inputValue: fechaTesis,
            inputValue: fechaR,
            title: 'Fecha',
            text: 'Introduzca una fecha valida'
        },
        {
            title: 'Documento',
            text: 'Introduzca el numero de documento',
            input: 'text',
            inputValidator: (value) => {
                if (!value) {
                    return '¡Necesita llenar la información!'
                }
            }
        }
    ]).then((result) => {
        if (result.value) {
            window.open("pdf/tesis/liberacion.php?id=" + idResidente + "&fecha=" + result.value[0] + "&numero=" + result.value[1], "_blank");
        }
    })
});
/*<!--=====================================
COMISION PARA TITULACION TESIS
======================================-->*/
$(document).on("click", "#btnImpComisionT", function () {
    // console.log("J=  " + idResidente);
    Swal.mixin({
        confirmButtonText: 'Siguiente &rarr;',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        progressSteps: ['1', '2', '3', '4', '5']
    }).queue([{
            input: 'text',
            inputValue: fechaR,
            title: 'Fecha',
            text: 'Introduzca una fecha valida para el documento'
        },
        {
            title: 'Documento',
            text: 'Introduzca el numero de documento',
            input: 'text',
            inputValidator: (value) => {
                if (!value) {
                    return '¡Necesita llenar la información!'
                }
            }
        },
        {
            input: 'text',
            inputValue: fecha4,
            title: 'Fecha de Titulación',
            text: 'Introduzca una fecha valida'
        },
        {
            input: 'text',
            inputValue: "10:00",
            title: 'Hora de la Titulación',
            text: 'Introduzca una hora valida'
        },
        {
            title: 'Tipo de documento',
            text: '¿El residente defiende su proyecto?',
            input: 'radio',
            inputOptions: {
                'si': 'SI',
                'no': 'NO'
            },
            inputValidator: function (result) {
                if (!result) {
                    return '¡Necesita seleccionar una opción!';
                }
            }
        }
    ]).then((result) => {
        if (result.value) {
            if (result.value[4] == 'si') {
                PreguntarPromedio(result.value);
            } else {
                window.open("pdf/tesis/comision.php?id=" + idResidente + "&fecha=" + result.value[0] + "&numero=" + result.value[1] + "&fechaT=" + result.value[2] + "&horaT=" + result.value[3] + "&defiende=" + result.value[4] + "&pro=0", "_blank");
            }
        }
    })
});

async function PreguntarPromedio(resulte) {
    // console.table(resulte);
    const {
        value: promedio
    } = await Swal.fire({
        title: 'Promedio',
        text: '¿Cual es el promedio del residente?',
        input: 'text',
        showCancelButton: true,
        inputValidator: (value) => {
            if (!value) {
                return '¡Necesita escribir el propmedio!'
            }
        }
    })
    if (promedio) {
        // Swal.fire(`Your IP address is ${promedio}`)
        window.open("pdf/tesis/comision.php?id=" + idResidente + "&fecha=" + resulte[0] + "&numero=" + resulte[1] + "&fechaT=" + resulte[2] + "&horaT=" + resulte[3] + "&defiende=" + resulte[4] + "&pro=" + `${promedio}`, "_blank");
    }
}







/*<!--=====================================
    CHECKS EDITAR RESIDENTE
======================================-->*/
$(document).on("click", ".customCheck1", function () {

    if (document.getElementById("customCheck1").checked == false) {
        document.getElementById("customCheck2").checked = false;
        document.getElementById("customCheck3").checked = false;
    }
})
$(document).on("click", ".customCheck2", function () {

    if (document.getElementById("customCheck2").checked) {
        document.getElementById("customCheck1").checked = true;
    } else {
        document.getElementById("customCheck3").checked = false;
    }
})
$(document).on("click", ".customCheck3", function () {

    if (document.getElementById("customCheck3").checked) {
        document.getElementById("customCheck1").checked = true;
        document.getElementById("customCheck2").checked = true;
    }
})
$(document).on("click", ".CheckTesis", function () {

    if (document.getElementById("CheckTesis").checked) {
        document.querySelector('#StatusTesis').innerText = 'Liberado';
    }else{
        document.querySelector('#StatusTesis').innerText = 'No liberado';
    }
})