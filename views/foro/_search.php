<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ForoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="foro-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'id_estado') ?>

    <?= $form->field($model, 'id_categoria') ?>

    <?= $form->field($model, 'titulo') ?>

    <?php // echo $form->field($model, 'texto') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
