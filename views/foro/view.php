<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Foro */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Foros', 'url' => ['indexadmin']];
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol, true);
if (array_key_exists("f", $data)&&$data["f"] != "x") {
?>
<div class="foro-view">

    <h1>Foro: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Seguro que desea eliminar este foro?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php $model->id_categoria= \app\models\Categoria_Foro::findOne($model->id_categoria)->descripcion; ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            'id_categoria',
            'texto:ntext',
            'fecha',
        ],
    ]) ?>
    

</div>
<?php
} else {
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>