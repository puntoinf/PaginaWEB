<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Materia;
use app\models\Carrera;



/* @var $this yii\web\View */
/* @var $model app\models\Correlativa */
/* @var $form yii\widgets\ActiveForm */
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if(array_key_exists("f", $data)&&$data["f"]!="x"){
?>

<div class="correlativa-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php
    //Si la variable $carrModel es enviada para ser usada en la vista update, se crea un input desabilitado mostrando el nombre de la carrera a la cual pertenece la materia. $carrModel es un arreglo generado por la función Correlativa::buscarCarrera($idMateria)
    if (isset($carrModel)) {

        ?>
    <div class="form-group">
        <label for="disabledInput" class="control-label">Carrera</label>
        <input class="form-control" id="disabledInput" type="text" value="<?= $carrModel['nombre'] ?>" disabled>
    </div>
    
    <?= $form->field($model, 'materia_id')->dropDownList(
        ArrayHelper::map(Materia::find()->where(['id_carrera' => $carrModel["id"]])->all(), 'id', 'nombre')) ?>

    <?= $form->field($model, 'cursada_id')->dropDownList(
        ArrayHelper::map(Materia::find()->where(['id_carrera' => $carrModel["id"]])->all(), 'id', 'nombre')) ?>

    <?= $form->field($model, 'aprobada_id')->dropDownList(
        ArrayHelper::map(Materia::find()->where(['id_carrera' => $carrModel["id"]])->all(), 'id', 'nombre')) ?>
    <?php 
} else {
    //Si la variable $carrModel no existe, quiere decir que el formulario a mostrar es para crear una nueva Correlativa. Se creara un nuevo objeto Carrera, para poder elegir las materias pertenecientes a la carrera seleccionada.
    $carrModel = new Carrera(); ?>
    <?= $form->field($carrModel, 'nombre')->dropDownList(
        ArrayHelper::map(Carrera::find()->all(), 'id', 'nombre'),
        [
            'prompt' => 'Seleccione una carrera',
            'onchange' => '
            $.post("index.php?r=correlativa/list&id="+$(this).val(), function( data ) {
            $( "select#correlativa-materia_id" ).html( data );
            $( "select#correlativa-cursada_id" ).html( data );
            $( "select#correlativa-aprobada_id" ).html( data );
            });',
        ]
    ); ?>
            
    <?= $form->field($model, 'materia_id')->dropDownList(
        ArrayHelper::map(Materia::find()->all(), 'id', 'nombre'),
        [
            'prompt' => 'Seleccione una materia',
        ]
    ) ?>

    <?= $form->field($model, 'cursada_id')->dropDownList(
        ArrayHelper::map(Materia::find()->all(), 'id', 'nombre'),
        [
            'prompt' => 'Seleccione una materia cursada necesaria',
        ]
    ) ?>

    <?= $form->field($model, 'aprobada_id')->dropDownList(
        ArrayHelper::map(Materia::find()->all(), 'id', 'nombre'),
        [
            'prompt' => 'Seleccione una materia aprobada necesaria',
        ]
    ) ?>
            <?php 
        } ?>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>
