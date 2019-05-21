<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Carrera;
/* @var $this yii\web\View */
/* @var $model app\models\MateriaSearch */
/* @var $form yii\widgets\ActiveForm */

$periodo=['Primer Cuatrimestre' => 'Primer Cuatrimestre', 'Segundo Cuatrimestre' => 'Segundo Cuatrimestre'];
?>

<div class="materia-search container-fluid">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?php // $form->field($model, 'id_carrera') ?>
    <?= $form->field($model, 'id_carrera')->dropDownList(
        ArrayHelper::map(Carrera::find()->all(),'id', 'nombre'),
        [
            'prompt'=> 'Seleccionar una carrera.',
        ]
    ) ?>

    <?= $form->field($model, 'anio_cursada') ?>

    <?= $form->field($model, 'periodo')->dropDownList($periodo,[
        'prompt' => 'Seleccionar periodo'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
