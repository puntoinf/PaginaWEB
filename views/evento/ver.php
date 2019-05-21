<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Evento';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <?php
    foreach ($detallesEvento as $unEvento) :
        //Se obtiene y verifica el id del evento para obtener los datos del evento seleccionado para mostrarlo 
        if (isset($_GET['id']) && $_GET['id'] == $unEvento->id) { 
            ?>
            <h1>
                <center><b><?= Html::encode($unEvento->nombre) ?></b></center>
            </h1>
            <br/>
            <div>
                <h4><center><?= $unEvento->descripcion ?></center></h4>
            </div>
            <br/><br/>
            <ul>
                <h4><li><b>Lugar:</b>
                <?= $unEvento->lugar ?></li></h4>
            </ul>
            <ul>
                <h4><li><b>Desde:</b>
                <?= $unEvento->desde ?></li></h4>
            </ul>
            <ul>
                <h4><li><b>Hasta:</b>
                <?= $unEvento->hasta ?></li></h4>
            </ul>
    <?php }endforeach; ?>
</div>