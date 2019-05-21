<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Materia;
use app\models\Carrera;

/* @var $this yii\web\View */
/* @var $model app\models\CorrelativaSearch */
/* @var $form yii\widgets\ActiveForm */
$carrModel= new Carrera();
?>

<div class="correlativa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'materia_id')->dropDownList(
        ArrayHelper::map(Materia::find()->all(),'id', 'nombre'),
        [
            'prompt'=> 'Seleccionar una materia'
        ]
    ) ?>
    <?= $form->field($model, 'cursada_id')->dropDownList(
        ArrayHelper::map(Materia::find()->all(),'id', 'nombre'),
        [
            'prompt'=> 'Seleccionar una cursada',
        ]
    ) ?>
    <?= $form->field($model, 'aprobada_id')->dropDownList(
        ArrayHelper::map(Materia::find()->all(),'id', 'nombre'),
        [
            'prompt'=> 'Seleccionar una aprobada',
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
