function infoPassword() {
    Swal.fire({
        type: "info",
        title: "!Puede editar la contraseña desde el boton editar!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false
    });
}

/*<!--=====================================
EDITAR USUARIO
======================================-->*/

$(".btnEditarUsuario").click(function () {
    var idUsuario = $(this).attr("idUsuario");
    /* console.log("idUsuario", idUsuario); */
    var datos = new FormData();
    datos.append("idUsuario", idUsuario);
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            /* console.log("respuesta", respuesta); */
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#passwordActual").val(respuesta["password"]);
        }
    });
})
/*<!--=====================================
ACTIVAR USUARIO
======================================-->*/
$(".btnActivar").click(function () {
    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

        }
    })
    if (estadoUsuario == 0) {
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 1);
    } else {
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 0);
    }
})