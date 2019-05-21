<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Perfil de Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>


<!-- Contenido de la página -->
<div class="container">
    <!-- Fin Encabezado de página / Breadcrumb -->

    <!-- Contact Form -->
    <!-- Campos del formulario de contacto con validación de campos-->
    <div class="row">
        <!-- Columna de la izquierda -->

        <?php if (Yii::$app->user->isGuest) { ?>
            <div class="col-md-4 col-md-offset-4">
            <?php } else if ($usuario->id != $_SESSION["__id"]) { ?>
                <div class="col-md-4 col-md-offset-4">
                <?php } else { ?>
                    <div class="col-md-3">
                    <?php } ?>

                    <div class="col-md-12" align="center">
                        <img class="img-responsive img-portfolio img-hover" src="<?= $usuario->imagen ?>">
                    </div>
                    <div class="col-md-12">
                        <p class="text-center"><strong><?= $usuario->nombre . " " . $usuario->apellido ?></strong></p>
                        <p class="text-center"><em><?php
                                $rol = $usuario->getRol();
                                echo $rol->descripcion;
                                ?></em></p>

                        <?php if (Yii::$app->user->isGuest) { ?>

                            <p class="text-center"></p>

                        <?php } else if ($usuario->id == $_SESSION["__id"]) { ?>
                            <a href="index.php?r=mensaje" class="btn btn-success col-sm-12">Abrir Chat</a>
                        <?php } else { ?>
                            <a href="index.php?r=mensaje&id_con=<?= $usuario->id ?> " class="btn btn-success col-sm-12">Chatear</a>
                        <?php } ?>
                    </div>

                    <?php if (!Yii::$app->user->isGuest && $usuario->id == $_SESSION["__id"]) { ?>
                        <div class="col-md-12">

                            <br >
                            <ul class="list-group list-primary">
                                <a href="#perf" class="list-group-item">Mi perfil</a>
                                <a href="#suscri" class="list-group-item">Suscripciones</a>
                            </ul>
                        </div>

                    </div>

                    <div class="col-md-9" style="margin-bottom: 20px;" id="perf">
                        <div class="col-md-12" style="border-width:1px 1px 0px 1px; border-style: solid; border-color: lightgrey;">
                            <h3 style="text-align: center">Editar mi perfil</h3>
                        </div>

                        <div class="col-md-12" style="border-width: 0px 1px 1px 1px; border-style: solid; border-color: lightgrey; background: #f1f3f6;">
                            <div class="col-md-8 col-md-offset-2" id="perf">
                                <form id="actualizarDatos" enctype="multipart/form-data" method="post">
                                    <div class="control-group form-group">



                                        <div class="FormActualizardatos">

                                            <?php
                                            $form = ActiveForm::begin([
                                                        "method" => "post",
                                                        "enableClientValidation" => true,
                                                        "options" => ["enctype" => "multipart/form-data"],]);
                                            ?>
                                            <div class="btn col-md-12" style="background: #ffffff;border: solid 1px lightgrey;margin: 10px 0px;">Datos Basicos</div>
                                            <div class="col-md-12" style="margin-bottom: 10px;padding: 10px;background: #ffffff;border: solid 1px lightgrey;border-radius: 10px;">
                                                <?= $form->field($model, 'nombre'); ?>
                                                <?= $form->field($model, 'apellido'); ?>
                                                <?= $form->field($model, 'file')->fileInput()->label("Imagen de Perfil"); ?>
                                            </div>
                                            <div class="btn col-md-12" style="background: #ffffff;border: solid 1px lightgrey;margin-bottom: 10px;">Cambiar Constraseña</div>
                                            <div class="col-md-12" style="margin-bottom: 10px;padding: 10px;background: #ffffff;border: solid 1px lightgrey;border-radius: 10px;">
                                                <?= $form->field($model, 'password_actual')->passwordInput()->label("Contraseña Actual"); ?>
                                                <?= $form->field($model, 'password')->passwordInput()->label("Nueva Contraseña"); ?>
                                                <?= $form->field($model, 'password_repeat')->passwordInput()->label("Repetir Nueva Contraseña"); ?>
                                            </div>

                                            <div class="form-group">
                                                <?= Html::submitButton('Actualizar', ['class' => 'btn btn-success btn-enviar']); ?>
                                            </div>
                                            <?php ActiveForm::end(); ?>

                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="col-md-12" style="margin:0px 0px 20px 0px;border-width:1px;background: #f1f3f6; border-style: solid; border-color: lightgrey;">
                            <div class="form-group col-md-12" style="margin: 10px 0px">
                                <em class="col-md-12" align="center"  style="margin: 10px 0px">Datos que no se pueden modificar</em><br>
                                <div class="col-md-12 btn btn-default disabled" align="left">Correo: <?=$usuario->email?></div><br>
                                <div class="col-md-12 btn btn-default disabled" style="margin: 10px 0px" >Legajo: <?=$usuario->legajo?></div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-9 col-md-offset-3">
                        <div  id="suscri" class="col-md-12" style="border-width:1px 1px 0px 1px; border-style: solid; border-color: lightgrey;">
                            <h3 style="text-align: center">Suscripciones</h3>
                        </div>

                        <div class="col-md-12" style="border-width: 0px 1px 1px 1px; border-style: solid; border-color: lightgrey;">
                            <div class="form-group">
                                <div class="col-md-12" align="center" style=" background: #f1f3f6;"><h4>Foros</h4></div>
                            </div>
                            <table class="table table-striped col-md-12">
                                <?php
                                foreach ($usuario->getSuscripcionForos() as $unaSuscripcion) {
                                    $foro = app\models\Foro::findOne($unaSuscripcion->id_foro);
                                    ?>
                                    <tr>
                                        <td><?= $foro->titulo ?></td>
                                        <td align="right"><a href="index.php?r=foro%2Fver&id=<?= $foro->id; ?>">Ver</a></td>
                                    </tr>
                                <?php } ?>
                            </table>

                            <div class="form-group">
                                <div class="col-md-12" align="center" style=" background: #f1f3f6;"><h4>Noticias</h4></div>
                            </div>
                            <table class="table table-striped col-md-12">
                                <tr>
                                    <td>Suscripto</td>
                                    <td align="right"><?= (!empty(app\models\SuscripcionNoticia::findOne($usuario->id))) ? "Si" : "No"; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                <?php } ?>

            </div>

            <hr class="col-md-12">


        </div>
