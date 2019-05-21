<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FormActualizardatos */
/* @var $form ActiveForm */
?>
<div class="FormActualizardatos">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'nombre') ?>
        <?= $form->field($model, 'apellido') ?>
        <?= $form->field($model, 'password_actual')->passwordInput()->label("Contraseña Actual") ?>
        <?= $form->field($model, 'password')->passwordInput()->label("Nueva Contraseña") ?>
        <?= $form->field($model, 'password_repeat')->passwordInput()->label("Repetir Nueva Contraseña") ?>
        <?= $form->field($model, 'file')->fileInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- FormActualizardatos -->
