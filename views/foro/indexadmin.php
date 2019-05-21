<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\foroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Foros';
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol, true);
if (array_key_exists("f", $data)&&$data["f"] != "x") {
    ?>
    <div class="foro-index">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Crear Foro', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                'titulo',
                'texto:ntext',
                'fecha',
                    ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
    <?php
} else {
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>