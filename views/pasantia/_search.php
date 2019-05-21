<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Estado;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\PasantiaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pasantia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //$form->field($model, 'id') ?>

    <?= $form->field($model, 'titulo') ?>

    <?php // $form->field($model, 'tarea') ?>

    <?php // $form->field($model, 'requisito') ?>

    <?= $form->field($model, 'ubicacion') ?>

    <?php // echo $form->field($model, 'fecha_inicio') ?>

    <?php // echo $form->field($model, 'fecha_fin') ?>

    <?php // echo $form->field($model, 'fecha_limite') ?>
    <?= $form->field($model, 'id_estado')->dropDownList(
        ArrayHelper::map(Estado::find()->where('id_tipo=3')->all(),'id', 'descripcion'),
        [
            'prompt'=> 'Seleccione un estado',
        ]
    ) ?>
    <?php // echo $form->field($model, 'id_estado') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
