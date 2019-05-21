<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use app\models\Materia;
use yii\helpers\ArrayHelper;
use app\models\Carrera;
use app\models\DiaSemana;

/* @var $this yii\web\View */
/* @var $model app\models\HorarioCursado */
/* @var $form yii\widgets\ActiveForm */
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if(array_key_exists("f", $data)&&$data["f"]!="x"){
    ?>

<div class="horario-cursado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hora_inicio')->widget(TimePicker::className(), [
        'name' => 'hora_inicio',


        'pluginOptions' => [
            'showSeconds' => true, 'showMeridian' => false, 'defaultTime' => ''
        ]
    ]); ?>

    <?= $form->field($model, 'hora_fin')->widget(TimePicker::className(), [
        'name' => 'hora_inicio',


        'pluginOptions' => [
            'showSeconds' => true, 'showMeridian' => false, 'defaultTime' => ''
        ]
    ]); ?>
    <?= $form->field($model, 'id_materia')->dropDownList(
        ArrayHelper::map(Materia::find()->all(), 'id', 'nombre'),
        [
            'prompt' => 'Seleccionar una materia',
        ]
    ) ?>
    <?= $form->field($model, 'aula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_dia')->dropDownList(
        ArrayHelper::map(DiaSemana::find()->all(), 'id', 'nombre'),
        [
            'prompt' => 'Seleccionar un dia',
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error"); 
}?>