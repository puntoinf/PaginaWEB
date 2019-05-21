<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Propuesta */

$this->title = 'Actualizar Propuesta';
$this->params['breadcrumbs'][] = ['label' => 'Propuestas', 'url' => ['index']]; 
$this->params['breadcrumbs'][] = $this->title;
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true); 
if($data["p"]!="x"){ 
?>
<div class="propuesta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>