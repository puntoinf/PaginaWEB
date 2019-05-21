<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Correlativa;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HorarioCursadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Horario Cursados';
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if(array_key_exists("f", $data)&&$data["f"]!="x"){
?>
<div class="horario-cursado-index container-fluid">
<div class="row">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <div class="col-lg-3">
    <h3>Filtrar busqueda</h3>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="col-lg-9">
    <p>
        <?= Html::a('Crear Horario Cursado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => "",
        //'filterModel' => $searchModel,
        'columns' => [
            'hora_inicio',
            'hora_fin',
            'aula',
            ['header'=>'Día','attribute'=>'dia.nombre'],

            ['header'=>'Materia','attribute'=>'materia.nombre'],

            [
                'label' => 'Carrera',
                'value' => function($data){
                    return Correlativa::buscarCarrera($data->id_materia)[0]['nombre'];
                },
            ],

            //'id_dia',

            ['class' => 'yii\grid\ActionColumn','header'=>'Administrar'],
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