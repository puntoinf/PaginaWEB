<?php

use yii\helpers\Html;
use app\models\Evento;

?>
<div class="col-sm-3">

        <?php
            $eventos = Evento::find()->all();

        $arreglo=[];
        //Se recorren y revisan los eventos para ser mostrados en el widget de fullCalendar
        foreach ($eventos as $eve) {
              $evento = new \yii2fullcalendar\models\Event();
              $evento->id = $eve->id;
              $evento->title = $eve->nombre;
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
        <!-- se muestran los detalles que se permiten que se editen (y vean) -->
        <?= yii2fullcalendar\yii2fullcalendar::widget(array(
            'events'=> $arreglo,
        ));
         ?>
    </div>