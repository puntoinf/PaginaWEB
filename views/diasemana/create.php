<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DiaSemana */

$this->title = 'Create Dia Semana';
$this->params['breadcrumbs'][] = ['label' => 'Dia Semanas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dia-semana-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
