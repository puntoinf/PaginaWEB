<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Noticia */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $noticia->titulo;
$this->params['breadcrumbs'][] = $this->title;

/* -----------------------------SECCION NOTICIA------------------------------------- */
echo ('<h1>' . (Html::encode($this->title)) . '</h1>');
echo ('<table><tr><td><div style="margin:3%;">');
echo ('<hr>');
echo ('<p align="center" style="font-weight: bold;">' . (Html::encode($noticia->copete)) . '</p>');
echo ('<hr>');
echo ('<img style="float: right;width:70%;max-height:10%;margin:1%;" src="' . $noticia->imagen . '"/>');
echo ('<p style="text-align: justify;">' . (Html::encode($noticia->texto)) . '</p>');
echo ('</div></td></tr><tr><td>');
echo ('<input class="no-imprimir esteImprimir" type="button" name="imprimir" value="Imprimir P&aacute;gina" onclick="printnoticia();">');
/* --------------------------AGREGAR COMENTARIO------------------------------------ */
if (isset($_SESSION["__id"])) {
    echo ('<div class="comentar no-imprimir">');
    echo ('<h4>Agregar comentario</h4>');
    $idUsuario = $_SESSION["__id"];
    echo Html::beginForm(Url::toRoute("comentario/comentar"), "get", ["class" => "form-inline"]);
    echo Html::textInput('comentario', null);
    echo Html::hiddenInput('idNoticia', $noticia->id);
    echo Html::submitInput('Comentar', null);
    echo Html::endForm();
    echo ("</div>");
}

/* --------------------------SECCION COMENTARIOS------------------------------------ */


foreach ($noticia->comentarios as $uncomentario) {

    $usuarioCom = $uncomentario->getUsuario();
    $userComImg = $usuarioCom->imagen;
    $userComNombre = $usuarioCom->nombre;
    $userComTexto = $uncomentario->comentario;


    echo ('<div class="unComentario">');
    echo ('<img src="' . $userComImg . '">');
    echo ('<h5>' . $userComNombre . '</h5>');
    echo ('<p>' . $userComTexto . '</p>');
    echo ('<p>' . $uncomentario->fecha . '</p>');



    foreach ($uncomentario->respuestas as $unaRespuesta) {

        $usuarioRes = \app\models\Usuario::findOne($unaRespuesta->id_usuario);
        $userResImg = $usuarioRes->imagen;
        $userResNombre = $usuarioRes->nombre;
        $userResTexto = $unaRespuesta->respuesta;
        echo ('<div class="unaRespuesta">');
        echo ('<img src="' . $userResImg . '">');
        echo ('<h5>' . $userResNombre . '</h5>');
        echo ('<p>' . $userResTexto . '</p>');
        echo ('<p>' . $unaRespuesta->fecha . '</p>');
        echo ('</div>');

}

    /* --------------------------AGREGAR RESPUESTA------------------------------------ */

    if (isset($_SESSION["__id"])) {
        echo ('<div class="responder no-imprimir">');
        $idUsuario = $_SESSION["__id"];

        echo Html::beginForm(Url::toRoute("respuesta/responder"), "get", ["class" => "form-inline"]);
        echo Html::textInput('respuesta', null, ["class" => "txt-responder"]);
        echo Html::hiddenInput('idComentario', $uncomentario->id);
        echo Html::hiddenInput('idNoticia', $noticia->id);
        echo Html::submitInput('Responder', null);
        echo Html::endForm();
        echo ("</div>");
    }


    echo ('</div>');

}


echo ("</td></tr></table>");
?>
<script type="text/javascript">
 function printnoticia() {
        var oldstr = document.body.innerHTML;

        // remover elementos que no se van a imprimir
        $('nav').remove();
        $('.unComentario').remove();
        $('.unaRespuesta').remove();
        $('.no-imprimir').remove();




        //cambiar tamaño de texto
        //var tdText = document.getElementsByTagName('td');
        //for (var i = 0, max = tdText.length; i < max; i++) {tdText[i].style.fontSize = '12px';}

        window.print();
        document.body.innerHTML = oldstr;
        return false;
}
</script>


