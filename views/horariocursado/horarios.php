
<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
$req=Yii::$app->request;
$this->title="Horarios";
echo "<center>".Html::tag("h2",$req->post('periodo'))."</center>";
if(count($horarios)>0){
  echo "<table class=\"table table-hover table-striped\">";
  echo "<thead>";
  echo "<th>Materia</th>";
  echo "<th>Dia</th>";
  echo "<th>Hora inicio</th>";
  echo "<th>Hora fin</th>";
  echo "<th>Aula</th>";
  echo "</thead>";
  echo "<tbody>";

  foreach($horarios as $unHorario){
    echo "<td>".$unHorario['nombre']."</td>";
    echo "<td>".$unHorario['nombre_dia']."</td>";
    echo "<td>".$unHorario['hora_inicio']."</td>";
    echo "<td>".$unHorario['hora_fin']."</td>";
    echo "<td>".$unHorario['aula']."</td></tr>";
  }
  echo "</tbody>";
  echo "</table>";
}else{?> <?php
  echo Html::tag("h3","Aún no se han cargado horarios.") ;
}?>

<?php

/*echo Html::button("Volver",
['class'=>'btn btn-info',
'onclick'=>"window.location.href = '" . \Yii::$app->urlManager->createUrl(["carrera/horarios"]) . "';",
'data-toggle'=>'tooltip',
'title'=>Yii::t('app', 'Volver al listado de carreras'),
],[
  'data-method' => 'POST',
  'data-params' => [
    'idCarrera' =>$req->post('idCarrera') ,
    'periodo'=>$req->post('periodo'),
    'idAnio' => $req->post('idAnio'),
  ]
]);*/






?>
