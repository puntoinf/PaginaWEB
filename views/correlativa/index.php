<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Correlativa;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CorrelativaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Correlativas';
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if(array_key_exists("f", $data)&&$data["f"]!="x"){
?>
<div class="correlativa-index container-fluid">
<div class="row">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <div class="col-lg-3">
    <h3>Filtrar busqueda</h3>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="col-lg-9">
    <p>
        <?= Html::a('Crear Correlativa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary' => "",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
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

            ['header'=>'Administrar','class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>
    </div>
</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>