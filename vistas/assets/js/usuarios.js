/* function infoPassword() {
    /* Swal.fire({
        type: "info",
        title: "!Puede editar la contraseña desde el boton editar!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false
    }); 

var capa = document.getElementById("capa");
capa.innerHTML = "Contenido para la capa";


}*/

/*<!--=====================================
EDITAR USUARIO
======================================-->*/

$(document).on("click", ".btnEditarUsuario", function () {
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
            console.log("respuesta", respuesta);
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
$(document).on("click", ".btnActivar", function () {
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
            if (window.matchMedia("(max-width:767px)").matches) {
                Swal.fire({
                    type: "success",
                    title: "!Modificado Correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result) => {
                    if (result.value) {
                        window.location = "Usuarios";
                    }
                });
            }
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
/*<!--=====================================
REVISAR SI EL USUARIO YA ESTA REGISTRADO
======================================-->*/
$("#nuevoUsuario").change(function () {
    $(".alert").remove();
    var usuario = $(this).val();
    var datos = new FormData();
    datos.append("validarUsuario", usuario);
    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta) {
                $("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe</div>');
                $("#nuevoUsuario").val("");
            }
        }
    })
})
/*<!--=====================================
REVISAR SI LA CONTRASEÑA COINCIDE
======================================-->*/
function comprobarPassword(nuevoPassword, confirmarPassword) {
    $(".alert").remove();
    if (($(nuevoPassword).val() !== "" || $(confirmarPassword).val() !== "")) {
        if ($(nuevoPassword).val() === $(confirmarPassword).val()) {
            $(confirmarPassword).parent().after('<div class="alert alert-success">¡Si coinciden!</div>');
        } else {
            $(confirmarPassword).parent().after('<div class="alert alert-warning">¡No coinciden!</div>');
        }
    }
};

$(".comprobarPassword").keyup(function () {
    comprobarPassword("#nuevoPassword", "#confirmarPassword");
});
$(".editarComprobarPassword").keyup(function () {
    comprobarPassword("#editarPassword", "#editarConfirmarPassword");
});

/*<!--=====================================
ELIMINAR USUARIO
======================================-->*/
$(document).on("click", ".btnEliminarUsuario", function () {
    var idUsuario = $(this).attr("idUsuario");
    Swal.fire({
        title: '¿Esta seguro de eliminarlo?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: "#d33",
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Eliminar!'
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=Usuarios&idUsuario=" + idUsuario;
        }
    })
})