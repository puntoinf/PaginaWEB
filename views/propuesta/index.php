<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;



/* @var $this yii\web\View */
/* @var $searchModel app\models\PropuestaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Propuestas';
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true); 
if($data["p"]!="x"){
    $datos = []; 
    $sqlDatos = app\models\Usuario:: findBySql('SELECT nombre,apellido FROM usuario t1, propuesta t2 WHERE t1.id=t2.id_usuario')->all(); 
    foreach ($sqlDatos as $value) { 
                $datos[] = $value['nombre'] . ' ' . $value['apellido']; 
    } 
?>


<div class="propuesta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            [ 
                'label' => 'idUsuario', 
                'value'=>'id_usuario' 
            ],

            'titulo',
            'descripcion:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 

    ?>
</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>