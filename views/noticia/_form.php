<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Noticia */
/* @var $form yii\widgets\ActiveForm */

if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol, true);
if (array_key_exists("n", $data)&&$data["n"] != "x") {
?>

<div class="noticia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'id_usuario')->textInput() ?>

    <?php //$form->field($model, 'id_estado')->textInput() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texto')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'alt')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'copete')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'imagen')->fileInput()->label("Imagen")?>
	
	<?= $form->field($model, 'importante')->dropdownList([
        0 => 'No', 
        1 => 'Si'
    ])?>
	
	
	<?= $form->field($model, 'file')->fileInput() ?>
	
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
} else {
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>
