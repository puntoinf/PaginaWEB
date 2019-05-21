<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = 'Crear Evento';
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['indexadm']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-create">

    <h1><?= Html::encode('Crear Evento') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
