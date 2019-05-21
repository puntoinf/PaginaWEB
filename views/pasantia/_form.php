<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use app\models\Estado;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Pasantia */
/* @var $form yii\widgets\ActiveForm */
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if(array_key_exists("f", $data)&&$data["f"]!="x"){
?>

<div class="pasantia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tarea')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'requisito')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ubicacion')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model,'fecha_inicio')->
    widget(DatePicker::className(),[
        'dateFormat' => 'yyyy/MM/dd',
        'clientOptions' => [
            'yearRange' => '-0:+1',
            'changeYear' => false]
    ]) ?>

    <?php echo $form->field($model,'fecha_fin')->
    widget(DatePicker::className(),[
        'dateFormat' => 'yyyy/MM/dd',
        'clientOptions' => [
            'yearRange' => '-0:+5',
            'changeYear' => true]
    ]) ?>

    <?php echo $form->field($model,'fecha_limite')->
    widget(DatePicker::className(),[
        'dateFormat' => 'yyyy/MM/dd',
        'clientOptions' => [
            'yearRange' => '-0:+1',
            'changeYear' => false]
    ]) ?>

    <?= $form->field($model, 'id_estado')->dropDownList(
        ArrayHelper::map(Estado::find()->where('id_tipo=3')->all(),'id', 'descripcion'),
        [
            'prompt'=> 'Seleccione un estado',
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
 