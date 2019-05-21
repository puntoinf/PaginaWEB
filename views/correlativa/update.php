<?php

use yii\helpers\Html;
use app\models\Correlativa;

/* @var $this yii\web\View */
/* @var $model app\models\Correlativa */
$carrModel= Correlativa::buscarCarrera($model->materia_id);
$this->title = 'Actualizar Correlativa:';
$this->params['breadcrumbs'][] = ['label' => 'Correlativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if(array_key_exists("f", $data)&&$data["f"]!="x"){
?>
<div class="correlativa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'carrModel' => $carrModel[0]
    ]) ?>

</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>