<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
$this->title = 'Activar Cuenta';
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="form-group col-lg-6 col-md-offset-3" align="center">

    <img src="archivos/site/registro/activarcuenta.png" alt="email" style="width: 150px;">
    <h2>Activacion de usuario</h2>
</div>

<div class="form-group col-lg-6 col-md-offset-3">
    <hr>
    <?= Html::beginForm(url::toRoute("site/inicioautomatico"), "post", ["class" => "form-horizontal","id"=>"formActivarCuenta"]) ?>
    <?=Html::hiddenInput("id",$model->id)?>



    <div class="form-group col-md-12 has-feedback">
        <label class="col-sm-1 control-label" for="pass">Contraseña</label>
        <?= Html::input('password', "pass",null, ["class" => "form-control", "id" => "pass"]) ?>
        <div id="passR" class="help-block with-errors"></div>
    </div>



    <div class="form-group col-md-12 has-feedback">
        <label class="col-sm-1 control-label" for="passr">Repetir Contraseña</label>
        <?= Html::input('password','passr', null, ["class" => "form-control", "id" => "passr"]) ?>
        <div id="passrR" class="help-block with-errors"></div>
    </div>


    <div class="form-group col-md-12 has-feedback">
        <label class="col-sm-1 control-label" for="Legajo">Legajo</label>
        <?= Html::textInput('legajo', null, ["class" => "form-control", "id" => "Legajo"]) ?>
        <div id="legajoR" class="help-block with-errors"></div>
    </div>
    
    
    <div class="form-group col-lg-2">
        <?= Html::submitInput('Activar e Iniciar Sesion', ["class" => "btn btn-primary", "id" => "inicioAutomatico"]) ?></div>
        <?= Html::endForm() ?>
    
    
    <div class="formInfo"></div>
</div>
