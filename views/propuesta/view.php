<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Propuesta */

$this->title = $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Propuestas', 'url' => ['index']]; 
$this->params['breadcrumbs'][] = $this->title;
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true); 
if($data["p"]!="x"){ 
?>
<div class="propuesta-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'id_usuario',
            'titulo',
            'descripcion:ntext',
        ],

    ])?>

      <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro queriere borrar? ',
                'method' => 'post',
            ],
        ]) ?>
    </p>


</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>