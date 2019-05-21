$(document).ready(function () {
    $("#formactualizardatos-password_repeat").keyup(function () {
        if ($("#formactualizardatos-password").val() != $("#formactualizardatos-password_repeat").val()) {
            $(".field-formactualizardatos-password_repeat").addClass("has-error");
            $(".field-formactualizardatos-password_repeat").find(".help-block").html("Las contraseñas no coinciden");
        } else {
            $(".field-formactualizardatos-password_repeat").removeClass("has-error");
            $(".field-formactualizardatos-password_repeat").find(".help-block").html("");
        }
    }
    );

    $("#formactualizardatos-password").val("");
    $("#formactualizardatos-password_actual").val("");
    $(".btn-enviar").click(function () {
        var pass = $("#formactualizardatos-password_actual");
        var pass2 = $("#formactualizardatos-password");
        var pass3 = $("#formactualizardatos-password_repeat");
        if (pass.val() != "" || pass2.val() != "" || pass3.val() != "") {
            if (pass.val() != "" && pass2.val() != "" && pass3.val() != "") {
                $("#formactualizardatos-password").val(md5($("#formactualizardatos-password").val()))
                $("#formactualizardatos-password_actual").val(md5($("#formactualizardatos-password_actual").val()))
                return true;
            }
            if (pass.val() == "") {
                $(".field-formactualizardatos-password_actual").addClass("has-error");
                $(".field-formactualizardatos-password_actual").find(".help-block").html("Complete el campo");
            } else {
                $(".field-formactualizardatos-password_actual").removeClass("has-error");
                $(".field-formactualizardatos-password_actual").find(".help-block").html("");
            }
            if (pass2.val() == "") {
                $(".field-formactualizardatos-password").addClass("has-error");
                $(".field-formactualizardatos-password").find(".help-block").html("Complete el campo");
            } else {
                $(".field-formactualizardatos-password").removeClass("has-error");
                $(".field-formactualizardatos-password").find(".help-block").html("");
            }
            if (pass3.val() == "") {
                $(".field-formactualizardatos-password_repeat").addClass("has-error");
                $(".field-formactualizardatos-password_repeat").find(".help-block").html("Complete el campo");
            } else {
                $(".field-formactualizardatos-password_repeat").removeClass("has-error");
                $(".field-formactualizardatos-password_repeat").find(".help-block").html("");
            }
            return false;
        }

    })
});
