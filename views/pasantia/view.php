<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pasantia */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Pasantias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if(array_key_exists("f", $data)&&$data["f"]!="x"){
?>
<div class="pasantia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'titulo',
            'tarea',
            'requisito:ntext',
            'ubicacion',
            'fecha_inicio',
            'fecha_fin',
            'fecha_limite',
            ['label'=>'Estado','attribute'=>'estado.descripcion'],
        ],
    ]) ?>

</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error"); 
}?>
