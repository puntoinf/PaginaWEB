<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */

$this->title = 'Actualizar Inventario: '.$model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nombre;
?>
<div class="inventario-update">

    <h1><?= Html::encode('Editar un Articulo') ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
