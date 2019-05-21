<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NoticiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol, true);
if (array_key_exists("n", $data)&&$data["n"] != "x") {
?>
<div class="noticia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Noticia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'id_usuario',
            [

                'label'=>'Usuario',
                'attribute'=>'id_usuario',
                'value'=> function($model){

                        $usuario = app\models\Usuario:: find()->where('id='.$model->id_usuario)->one();
                        return $usuario->nombre." ".$usuario->apellido;
                }

            ],
            'titulo',
            'texto:ntext',
            'fecha',
            'copete',
            //'imagen',
            //'importante',
            //'id_estado',
            [

                'label'=> 'Estado',
                'attribute'=>'id_estado',
                'value' => function($model){
                    $estados = app\models\Estado:: find()->where('id='.$model->id_estado)->one();
                    return $estados->descripcion;
                }

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php
} else {
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>
