<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Propuesta */
$this->title = 'Contacto Directo';
$this->params['breadcrumbs'][] = ['label' => 'Propuesta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if (Yii::$app->user->isGuest) {
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
?>
<div class="propuesta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>





