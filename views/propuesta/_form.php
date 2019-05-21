
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Propuesta */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="propuesta-form">

    <?php 
    
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true,'id'=>'titulo']) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6,'id'=>'descripcion'])?>
    
    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); 
    ?>





</div>
