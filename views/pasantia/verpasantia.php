<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Pasantias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$fecha_limite = date("d/m/Y", strtotime($model->fecha_limite));
$fecha_inicio = date("d/m/Y", strtotime($model->fecha_inicio));
$fecha_fin = date("d/m/Y", strtotime($model->fecha_fin));
?>

<div class="container">
    <h2 class="text-center"><?= $model->titulo ?></h2>
    <hr/>
    <h4><?= nl2br($model->tarea)?></h4>
    <p><em>Requisitos:</em><br><?= nl2br($model->requisito)?></p>
    <p><em>Ubicaci&oacute;n:</em><br><?= $model->ubicacion?></p>
    <p><em>Estado de inscripciones:</em><br><?= $model->estado->descripcion?></p>
    <p class="text-primary"><em>Fecha límite de inscripción:</em><br><?= $fecha_limite?></p>
    <p class="text-primary"><em>Comienzo de pasantia:</em><br><?= $fecha_inicio?></p>
    <p class="text-primary"><em>Finalización de pasantia:</em><br><?= $fecha_fin?></p>
</div>
