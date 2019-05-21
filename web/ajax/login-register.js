$(document).ready(function () {
    var name = false, app = false, email = false, pass = false;



    $("#formActivarCuenta").submit(function () {
        alert("hola")
        return false;
    });






    $('[name="login-button"]').click(function () {
        $('#loginform-clave').val(md5($('#loginform-clave').val()));
    });

    $(".cargandoEmail").hide();


    $("#registrarse").click(function () {

        if (name && app && email && pass) {
            var $f = $(this);
            $(".datosSolicitados").hide();
            $(".cargandoEmail").show();
            var passSolo = $("#Contraseña").val();
            var passEncrypt = md5(passSolo);
            if (($("#Email").val()).substring($("#Email").val().length - 21, $("#Email").val().length) == "@est.fi.uncoma.edu.ar")
                var array = {email: ($("#Email").val()).substring(0, $("#Email").val().length - 21), nombre: $("#Nombre").val(), apellido: $("#Apellido").val(), password: passEncrypt};
            else
                var array = {email: $("#Email").val(), nombre: $("#Nombre").val(), apellido: $("#Apellido").val(), password: passEncrypt};
            $.ajax({
                url: "index.php?r=site%2Fenviaremail",
                type: "POST",
                data: {'datos': JSON.stringify(array)},
                dataType: 'json',
                beforeSend: function () {
                    $f.data('locked', true)
                },
                success: function (response) {
                    $("#formRegistro").fadeOut(function () {
                        $(".formInfo").html("<h2>" + response.mensaje + "</h2>")

                        if (!response.siNo) {
                            $(".formInfo").append('<a href="" class="btn btn-primary" id="idVolver"> Volver a intentar</a>');

                        }
                    });
                },
                timeout: 10000,
                error: function (request, status, err) {
                    if (status == "timeout") {
                        $("#formRegistro").fadeOut(function () {
                            $(".formInfo").html('<div class="form-group col-md-12" align="center"><h2 align="center">La conexion esta tardando demasiado</h2></div>');
                            $(".formInfo").append('<div class="form-group col-md-12" align="center"><a href="" class="btn btn-primary" id="idVolver"> Volver a intentar</a></div>');
                        });
                    } else {
                        $("#formRegistro").fadeOut(function () {
                            $(".formInfo").html('<div class="form-group col-md-12" align="center"><h2 align="center">Correo no valido</h2></div>');
                            $(".formInfo").append('<div class="form-group col-md-12" align="center"><a href="" class="btn btn-primary" id="idVolver"> Volver a intentar</a></div>');
                        });
                    }
                },
                complete: function () {
                    $f.data('locked', false)
                }
            });
        } else {
            name = validacionCampoCompleto("#nameR", "#Nombre");
            app = validacionCampoCompleto("#appR", "#Apellido");
            email = validacionCampoCompleto("#emailR", "#Email");
            pass = validacionCampoCompleto("#passR", "#Contraseña");
        }
        return false;
    });


    $("#idVolver").click(function () {
        $("#formRegistro")[0].reset();
        $("#formRegistro").fadeIn(function () {
            $(".formInfo").html("")
        });
    });

    $("#Nombre").focusout(function () {
        name = validacionCampoCompleto("#nameR", "#Nombre");
    });
    $("#Apellido").focusout(function () {
        app = validacionCampoCompleto("#appR", "#Apellido");
    });
    $("#Email").focusout(function () {
        email = validacionCampoCompleto("#emailR", "#Email");

    });
    $("#Contraseña").focusout(function () {
        email = validacionCampoCompleto("#passR", "#Contraseña");

    });

    $("#passr").focusout(function () {
        email = validacionCampoCompleto("#passrR", "#passr");
    });

    $("#pass").focusout(function () {
        email = validacionCampoCompleto("#passR", "#pass");
    });
    $("#Legajo").focusout(function () {
        email = validacionCampoCompleto("#legajoR", "#Legajo");
    });




    function validacionCampoCompleto(id, id2) {
        if ($(id2).val().length < 3) {
            $(id).parent(".form-group").removeClass(" has-success");
            $(id).parent(".form-group").find("span").not("#spanEmail").remove();
            $(id).parent(".form-group").addClass(" has-error");
            $(id).parent(".form-group").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $(id).html((id2 == "#passr" || id2 == "#pass") ? "Contraseña no aceptada, es muy corta" : (id2.substr(1, id2.length)) + ((id2 == "#Contraseña") ? " no aceptada, es muy corta" : " no aceptado, es muy corto"));
            return false;
        } else {
            $(id).parent(".form-group").removeClass(" has-error");
            $(id).parent(".form-group").find("span").not("#spanEmail").remove();
            $(id).parent(".form-group").addClass(" has-success");
            $(id).parent(".form-group").append('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
            $(id).html("");
            return true;
        }
    }




    $("#actualizarDatos").bind("submit", function () {
        var formData = new FormData;
        formData.append("imagen", $("#imgP")[0].files[0]);
        var passSolo = $("#passP").val();
        var passEncrypt = md5(passSolo);
        array = {nombre: $("#nombreP").val(), apellido: $("#appP").val(), password: passEncrypt }
        $.ajax({
            url: "index.php?r=usuario%2Factualizardatos",
            type: "POST",
            data: {'datos': JSON.stringify(array)},
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function (response) {
                alert("subido")
            }
        });
        return false;
    });


});