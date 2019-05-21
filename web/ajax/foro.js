$(document).ready(function () {

    /**------------------------INDEX-FORO-----------------------------*/
    var texto = false, titulo = false;
    var orden;
    var ultimoTabla = -1;



    $("#buscarI").keyup(function () {
        var array = {titulo: $(this).val()};
        $.ajax({
            url: "index.php?r=foro%2Fbuscar",
            type: "POST",
            data: {'datos': JSON.stringify(array)},
            success: function (response) {
                if (response == "") {
                    $("#g2TodosLosForos").html('<div class=" form-horizontal col-md-10 col-md-offset-1" align="center"><h2>No se an encontrado foros</h2></div>');
                    $("#g2CargarMasForo").hide();
                } else {
                    $("#g2TodosLosForos").html(response);
                    $("#g2CargarMasForo").hide();
                }
            }
        });

    });

    $("#cambiarEstado").click(function () {
        var idForo = getValorPorGet("id");
        $.ajax({
            url: "index.php?r=foro%2Fcambiarestado",
            type: "POST",
            data: {'idForo': idForo},
            success: function (response) {
                if(response==1){
                    $("#cambiarEstado").html("<b>Estado: </b>Cerrado");
                    $("#cambiarEstado").removeAttr("class");
                    $("#cambiarEstado").removeAttr('id');
                }
            }
        });
    });


    $("#g2CargarMasForo").click(function () {
        if (ultimo != ultimoTabla) {
            var array = {ultimo: ultimo};
            $.ajax({
                url: "index.php?r=foro%2Fcargar",
                type: "POST",
                data: {'datos': JSON.stringify(array)},
                dataType: 'json',
                success: function (response) {
                    if (response.foros != "") {
                        $("#g2TodosLosForos").append("" + response.foros);
                        ultimo = response.ultimo;
                        ultimoTabla = response.ultimoTabla;
                    } else {
                        ultimoTabla = ultimo;
                    }
                }
            });
        } else {
            $("#g2CargarMasForo").html("<h4>No hay mas foros para cargar</h4>");
        }
    });

    $("#crearForo").click(function () {
        $("#Categoria").parent(".form-group").addClass(" has-success");
        if (texto && titulo) {
            var $f = $(this);
            var array = {texto: $("#Descripcion").val(), categoria: $("#Categoria").val(), titulo: $("#Titulo").val()};
            $.ajax({
                url: "index.php?r=foro%2Fcrear",
                type: "POST",
                data: {'datos': JSON.stringify(array)},
                dataType: 'json',
                beforeSend: function(){ $f.data('locked', true)},
                success: function (response) {
                    if (response != "") {
                        $("#createForoExpand").click();
                        $("#g2PrimerForo").append('<div class=" form-horizontal col-md-10 col-md-offset-1"><div class="form-group col-md-2 vertical-center" style="border-width: 1px; border-style: solid; border-color: lightgrey;border-radius: 3px 0px 0px 3px; background: #f1f3f6;min-height: 250px" align="center"><div class="col-md-12" style="display:block;"><img width="100px" src="' + response.imagen + '"><h5>' + response.nombre + '</h5><h5>' + response.fecha + '</h5></div></div><div class="form-group col-md-10" style="border-width:1px 1px 1px 0px; border-style: solid; border-color: lightgrey;border-radius: 0px 3px 3px 0px;min-height: 250px"><h4 class="col-md-offset-1">' + response.titulo + '</h4><hr style="width:90%;margin-right:25px;"><p class="col-md-offset-1">' + response.texto + '</p><div class="form-group col-md-offset-1 acc" style="left:120px;bottom: 8px"><b>Categoria:</b> <i>' + response.categoria + '</i></div><div class="form-group col-md-12 acc" align="right"><a class="btn btn-info btn-md" href="index.php?r=foro%2Fver&id=' + response.id + '">Acceder</a></div></div></div>');


                    }
                },
                complete: function(){ $f.data('locked', false)}
            });
        } else {
            texto = validacionCampoCompleto("#descripcionR", "#Descripcion");
            titulo = validacionCampoCompleto("#tituloR", "#Titulo");
        }


    });

    $("#Descripcion").focusout(function () {
        texto = validacionCampoCompleto("#descripcionR", "#Descripcion");
    });

    $("#Categoria").focusout(function () {
        $(this).parent(".form-group").addClass(" has-success");
    });


    $("#Titulo").focusout(function () {
        texto = validacionCampoCompleto("#tituloR", "#Titulo");
    });




    $("#createForoExpand").click(function () {

        if ($(this).html() == "Cancelar") {
            $(this).html("Crear Foro");
            $(this).removeClass("btn-danger");
            $(this).addClass("btn-info");
            $("#Descripcion").parent(".form-group").removeClass("has-error has-success");
            $(".glyphicon-remove").remove();
            $(".glyphicon-ok").remove();
            $("#Descripcion").val("");
            $("#descripcionR").html("");
            $("#Categoria").parent(".form-group").removeClass("has-error has-success");
            $("#Titulo").parent(".form-group").removeClass("has-error has-success");
            $("#Titulo").val("");
            $("#tituloR").html("");
        } else {

            $(this).html("Cancelar");
            $(this).removeClass("btn-info");
            $(this).addClass("btn-danger");

        }

    });





    /**------------------------VER-FORO-----------------------------*/





    $("#g2EnviarRespuesta").click(function () {
        if ($("#g2Comentario").val().length > 0) {
            var array = {respuesta: $("#g2Comentario").val(), id_foro: getValorPorGet("id")};
            $.ajax({
                url: "index.php?r=foro%2Fresponder",
                type: "POST",
                data: {'datos': JSON.stringify(array)},
                dataType: 'json',
                success: function (response) {
                    if (response != "") {
                        $("#createResExpand").click();
                        $("#g2Comentario").val("");
                        $("#g2BoxResponder").html("<h3>Respuesta enviada</h3>");
                        $("#g2RespuestasForo").append('<div class="form-group col-md-10 col-md-offset-2" id="resp' + response.idU + '" ><div class="form-horizontal col-md-12"style="border-width:1px; border-style: solid; border-color: lightgrey;background: #ffffff;"><div class="form-group col-md-10" style="min-height: 150px;"><p>' + response.respuesta + '</p></div><div class="form-group col-md-2" align="center" style="margin: 20px 0px 0px 0px; position: absolute; right: 0"><a href="index.php?r=usuario%2Fperfil&id=' + response.idU + '" style="text-decoration:none"><img width="100px" src="' + response.imagen + '"><h5>' + response.nombre + '</h5></a></div></div></div>');
                        $('html,body').animate({scrollTop: $('#resp' + response.idU + '').position().top + 'px'}, 1000);
                        $.ajax({
                            url: "index.php?r=foro%2Fenviaremails",
                            type: "POST",
                            data: {'datos': JSON.stringify(array)}
                        });
                    }
                }
            });
        } else {
            $("#g2Comentario").focus();
            $("#g2Comentario").attr("placeholder", "Complete este campo");
        }

    });

   
    $("#g2Suscribirse").click(function () {

        $.ajax({
            url: "index.php?r=foro%2Fsuscribirse",
            type: "POST",
            data: {'datos': JSON.stringify({'id_foro': getValorPorGet("id")})},
            success: function (response) {

                if (response == "desuscripto") {
                    $("#g2Suscribirse").html("Suscribirse");
                } else {
                    $("#g2Suscribirse").html("Des-Suscribirse");
                }
            }
        });

    });




    /**------------------------GENERAL------------------------------*/
    function getValorPorGet(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    function validacionCampoCompleto(id, id2) {
        if ($(id2).val().length < 3) {
            $(id).parent(".form-group").removeClass(" has-success");
            $(id).parent(".form-group").find("span").not("#spanEmail").remove();
            $(id).parent(".form-group").addClass(" has-error");
            $(id).parent(".form-group").append('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            $(id).html((id2 == "#Descripcion") ? "Descripcion no aceptada, es muy corta" : (id2.substr(1, id2.length)) + ((id2 == "#Contraseña") ? " no aceptada, es muy corta" : " no aceptado, es muy corto"));
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

});