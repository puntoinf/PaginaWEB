<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Foro';
$this->params['breadcrumbs'][] = ["label"=>"Foros","url"=>"index.php?r=foro%2Findex"];
$this->params['breadcrumbs'][] = $this->title;
?>
<!------------------------------------------------------------------>
<div class="form-horizontal col-md-12">
    <div class="form-group" style="border-width: 1px; border-style: solid; border-color: lightgrey;border-radius: 3px 3px 0px 0px; background: #f1f3f6;" align="center">
        <h1><?= $g2Foro->titulo ?></h1>
        <div class="form-horizontal col-md-12"style="border-width:1px 0px 0px 0px; border-style: solid; border-color: lightgrey;background: #ffffff;">
            <div class="form-group col-md-6">
                <h4><b>Fecha de creacion: </b><?=  (new DateTime($g2Foro->fecha))->format("d/m/Y h:m:s") ?></h4>
            </div>
            <div class="form-group col-md-6">
                <h4 <?= (array_key_exists("__id", $_SESSION)&&$g2Foro->id_estado!=2&&$g2Foro->getUsuario()->id==$_SESSION["__id"])?'class="btn btn-success" id="cambiarEstado"':"" ?> ><b>Estado: </b><?= $g2Foro->getEstado()->descripcion ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group col-md-12 vertical-center" style="border-width: 1px; border-style: solid; border-color: lightgrey;border-radius: 3px;min-height: 300px;" align="center">
        <div class="col-md-12" style="display:block;">
            <a href="index.php?r=usuario%2Fperfil&id=<?= $g2Foro->getUsuario()->id ?>" style="text-decoration:none">
            <img width="100px" src="<?= $g2Foro->getUsuario()->imagen ?>">
            <h5><?= $g2Foro->getUsuario()->nombre . " " . $g2Foro->getUsuario()->apellido ?></h5>
            </a>
            <hr>
            <p><?= $g2Foro->texto ?></p>
            <hr>
        </div>
    </div>
</div>





<div class="col-md-12" align="center">

    <?php
    if (!Yii::$app->user->isGuest) {
        echo '
            


<div class="col-md-4 col-md-offset-1 no-print">

    <div data-toggle="collapse" data-target="#crearrespuesta" id="createResExpand" class=" btn btn-info col-md-12" style="margin-bottom:15px">Responder</div>
    
    <div id="crearrespuesta" class="collapse col-md-12">
        <div class="form-group">
                <label for="g2Comentario">Respuesta</label>
                <textarea id = "g2Comentario" class="form-control"></textarea></div>
                <h4 class=" btn btn-info" id = "g2EnviarRespuesta">Responder</h4>
        </div>
    </div>

<div id="g2Suscribirse" class="form-group col-md-4 btn btn-success col-md-offset-2 no-print">
';

        $suscrito = app\models\SuscripcionForo::estoySuscripto($g2Foro->id);
        if ($suscrito) {
            echo'Des-Suscribirse</div>';
        } else {
            echo'Suscribirse</div>';
        }
    }
    ?>

</div>
<div class="col-sm-12 no-print" align="center" style="margin:20px"><a href='javascript:window.print(); void 0;' class="btn btn-success col-md-6 col-sm-offset-3">Imprimir</a> </div>
<!------------------------------------------------------------------>
<?=(count($g2Respuesta)>0)?"<h2 align='center'>Respuestas</h2>":"<h2 align='center'>Aun no an respondido en este foro</h2>"?>
<div id="g2RespuestasForo">
    <?php foreach ($g2Respuesta as $g2UnaRespuesta) { ?>

        <div class="form-group col-md-10 col-md-offset-2">
            <div class="form-horizontal col-md-12"style="border-width:1px; border-style: solid; border-color: lightgrey;background: #ffffff;">
                <div class="form-group col-md-10" style="min-height: 150px;padding: 20px">
                    <p><?= $g2UnaRespuesta->texto ?></p>  
                </div>
                <div class="form-group col-md-2" align="center" style="margin: 20px 0px 0px 0px; position: absolute; right: 0">         
                <a href="index.php?r=usuario%2Fperfil&id=<?= $g2UnaRespuesta->getUsuario()->id ?>" style="text-decoration:none"><img width="100px" src="<?= $g2UnaRespuesta->getUsuario()->imagen ?>">
                    <h5><?= $g2UnaRespuesta->getUsuario()->nombre . " " . $g2UnaRespuesta->getUsuario()->apellido ?></h5></a>
            </div>
            </div>
        </div>
<?php }
?>

</div>




<style>
    .vertical-center {
        min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
        min-height: 100vh; /* These two lines are counted as one 🙂       */
        display: flex;
        align-items: center;
    }

    .acc{
        position:absolute;
        bottom: 0;
    }

</style>
