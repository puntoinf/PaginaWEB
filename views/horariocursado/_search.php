<?php

namespace kartik\widgets;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Materia;
use kartik\time\TimePicker;


/* @var $this yii\web\View */
/* @var $model app\models\HorarioCursadoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="horario-cursado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?=  $form->field($model, 'hora_inicio')->widget(TimePicker::className(), [
      'name' => 'hora_inicio',
    	'pluginOptions' => [
    		'showSeconds' => true,  'showMeridian' => false,'defaultTime' => false
    	]
    ]); ?>

    <?= $form->field($model, 'hora_fin')->widget(TimePicker::className(), [
      'name' => 'hora_fin',
    	'pluginOptions' => [
    		'showSeconds' => true, 'showMeridian' => false, 'defaultTime' => false,
    	]
    ]); ?>

    <?= $form->field($model, 'aula') ?>

    <?= $form->field($model, 'id_materia')->dropDownList(
       ArrayHelper::map(Materia::find()->all(),'id', 'nombre'),
        [
            'prompt'=> 'Seleccionar una materia',
        ]
      ) ?>

    <?php // echo $form->field($model, 'id_dia') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
