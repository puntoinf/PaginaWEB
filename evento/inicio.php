<?php

use yii\helpers\Html;
use app\models\Evento;

?>
<div class="col-sm-3">

        <?php
            $eventos = Evento::find()->all();
        //$a=var_dump($eventos);

        $arreglo=[];

        foreach ($eventos as $eve) {
              $evento = new \yii2fullcalendar\models\Event();
              $evento->id = $eve->id;
              $evento->title = $eve->nombre;
              //$evento->nombre = 'Testing';
             //$evento->descripcion = $eve->title;
              $evento->start = $eve->desde;
              $evento->url = Url::to(['evento/ver', 'id'=> $eve->id]);
              if($eve->es_feriado==1)
            {
                $evento->color="red";
            }
            $evento->allDay=true;

            
            $arreglo[] = $evento;
        }



        ?>
        <?= yii2fullcalendar\yii2fullcalendar::widget(array(
            'events'=> $arreglo,
        ));
         ?>
    </div>