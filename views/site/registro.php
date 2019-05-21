<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
$this->title = 'Registrarse';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="form-group col-lg-6 col-md-offset-3" align="center">

    <img src="archivos/site/registro/registro.png" style="width: 150px;">
    <h2>Registro de usuario</h2>
</div>

<div class="form-group col-lg-6 col-md-offset-3">
    <hr>
    <?= Html::beginForm(null, "post", ["class" => "form-horizontal", "id" => "formRegistro"]) ?>

    <div class="datosSolicitados">


        <div class="form-group col-md-12 has-feedback">
            <label class="col-sm-1 control-label" for="Nombre">Nombre</label>
            <?= Html::textInput('nombre', null, ["class" => "form-control", "id" => "Nombre"]) ?>
            <div id="nameR" class="help-block with-errors"></div>
        </div>



        <div class="form-group col-md-12 has-feedback">
            <label class="col-sm-1 control-label" for="Apellido">Apellido</label>
            <?= Html::textInput('apellido', null, ["class" => "form-control", "id" => "Apellido"]) ?>
            <div id="appR" class="help-block with-errors"></div>
        </div>


        <div class="form-group col-md-12 has-feedback">
            <label class="col-sm-1 control-label" for="Email">Email</label>
            <?= Html::textInput('email', null, ["class" => "form-control", "id" => "Email"]) ?>
            <span id="spanEmail" class="form-control-feedback" style="color:#3B3B3B;margin-right: 140px;">@est.fi.uncoma.edu.ar</span>
            <div id="emailR" class="help-block with-errors"></div>
        </div>
        
        <div class="form-group col-md-12 has-feedback">
            <label class="col-sm-1 control-label" for="Contraseña">Contraseña</label>
            <?= Html::input('password', "password",null, ["class" => "form-control", "id" => "Contraseña"]) ?>
            <div id="passR" class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form-group col-md-12 cargandoEmail" align="center">
        <img src="archivos/site/registro/aguarde.gif" aling="center">
    </div>
    <div class="datosSolicitados">
        <div class="form-group col-md-12">
            <p>Recuerda que debes tener un correo institucional para regitrarte en nuestra pagina</p>
            <a href="http://faiweb.uncoma.edu.ar/index.php/57-academica/alumnos/422-2014-05-07-17-59-37">
                <img src="archivos/site/registro/email.png" alt="email" style="width: 15px;">
                Crear email institucional
            </a>
        </div>

        <div class="form-group col-lg-2">
            <?= Html::submitInput('Registrarse', ["class" => "btn btn-primary", "id" => "registrarse"]) ?></div>
    </div>
    <?= Html::endForm() ?>

</div>
<div class="form-group col-lg-12 formInfo" align="center"></div>
