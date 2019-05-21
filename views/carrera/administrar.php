<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarreraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administrar Carreras';
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if(array_key_exists("f", $data)&&$data["f"]!="x"){
?>

<div class="carrera-administrar container-fluid">
    <div class="row">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'carrera']); ?>
    <div class="col-lg-3">
    <h3>Filtrar busqueda</h3>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="col-lg-9">
    <p>
        <?= Html::a('Crear Carrera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary' => "",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nombre',
            [
                'format' => 'html',
                'label' => 'Ver materias',
                'value'=> function($data){
                    $id= $data->id;
                    $url=Url::toRoute(['materia/index', 'id_carrera' => $id]);
                    $doc='<a href="'.$url.'">
                      <span class="glyphicon glyphicon-th-list"></span>
                    </a>';
                        return $doc;
                    },
            ],
            [
                'label'=> 'Más información',
                'format' => 'html',
                'value'=> function($data){
                    $url= $data->url;
                    $doc='<a href="'.$url.'" target="_blank">
                      <span class="glyphicon glyphicon-info-sign"></span>
                    </a>';
                        return $doc;
                },
            ],
            ['header'=>'Administrar',
            'class' => 'yii\grid\ActionColumn'],
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