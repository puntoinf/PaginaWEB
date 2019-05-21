<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['indexadm']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar',['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar',['delete', 'id' => $model->id],['class' =>'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <!-- se muestran los detalles que se permiten que se editen (y vean) -->
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'nombre',
            'descripcion',
            'lugar',
            'desde',
            'hasta',
            'es_feriado',
        ],
    ]) ?>

</div>
