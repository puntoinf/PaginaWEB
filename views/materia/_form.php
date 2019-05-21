<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Carrera;

/* @var $this yii\web\View */
/* @var $model app\models\Materia */
/* @var $form yii\widgets\ActiveForm */
$periodo=['Primer Cuatrimestre' => 'Primer Cuatrimestre', 'Segundo Cuatrimestre' => 'Segundo Cuatrimestre'];
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if(array_key_exists("f", $data)&&$data["f"]!="x"){
?>

<div class="materia-form container-fluid">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_carrera')->dropDownList(
        ArrayHelper::map(Carrera::find()->all(),'id', 'nombre'),
        [
            'prompt'=> 'Seleccionar una carrera.',
        ]
    ) ?>

    <?= $form->field($model, 'anio_cursada')->textInput() ?>

    <?= $form->field($model, 'periodo')->dropDownList($periodo,[
        'prompt' => 'Seleccionar periodo'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>