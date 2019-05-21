<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FormUpload */
/* @var $form ActiveForm */
?>

<div class="form-group col-lg-6 col-md-offset-3" align="center">

    <img src="archivos/site/registro/activarcuenta.png" style="width: 150px;">
    <h2>Activacion de cuenta</h2>
</div>
<div class="ActivacionForm">
    <?php $form = ActiveForm::begin([
     "method" => "post",
     "enableClientValidation" => true,
     "options" => ["enctype" => "multipart/form-data","class"=>"col-md-6 col-md-offset-3"],
     ]); ?>

        
        <?= $form->field($model, 'legajo') ?>
        <?= $form->field($model, 'password')->input("password")->label("Nueva Contraseña") ?>
    <?= $form->field($model, 'file[]')->fileInput() ?>
        <div class="form-group">
            <?= Html::submitButton('Activar e Iniciar Sesion', ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- ActivacionForm -->


<script>
$("#w0").submit(function(){
    $("#formupload-password").val(md5($("#formupload-password").val()));
});


</script>