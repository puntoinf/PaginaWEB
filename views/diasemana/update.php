<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DiaSemana */

$this->title = 'Update Dia Semana: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Dia Semanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dia-semana-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
