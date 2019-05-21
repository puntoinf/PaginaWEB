<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Correlativa;
use app\models\Materia;

/* @var $this yii\web\View */
/* @var $model app\models\Correlativa */

$this->title = 'Correlativa '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Correlativas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if(array_key_exists("f", $data)&&$data["f"]!="x"){
?>
<div class="correlativa-view">

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
            //'materia_id',
            //'cursada_id',
            //'aprobada_id',
            [
                'label' => 'Materia',
                'value' => function($data){
                    return Correlativa::getNombreMateria($data->materia_id);
                },
            ],
            [
                'label' => 'Cursada',
                'value' => function($data){
                    return Correlativa::getNombreMateria($data->cursada_id);
                },
            ],
            [
                'label' => 'Aprobada',
                'value' => function($data){
                    return Correlativa::getNombreMateria($data->aprobada_id);
                },
            ],
            [
                'label' => 'Carrera',
                'value' => function($data){
                    return Correlativa::buscarCarrera($data->materia_id)[0]['nombre'];
                },
            ],
        ],
    ]) ?>

</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>