<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PasantiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pasantias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pasantia-index container-fluid">
<div class="row">
<h1><?= Html::encode($this->title) ?></h1>
<div class="col-lg-3">
<h3>Filtrar busqueda</h3>
<?php  echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<div class="col-lg-9">
<?php if (!Yii::$app->user->isGuest) {
    $data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
    if(array_key_exists("f", $data)&&$data["f"]!="x"){ ?>

        <p>
            <?= Html::a('Crear Pasantia', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'summary' => "",
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],

                //'id',
                'titulo',
                'tarea',
                'requisito:ntext',
                'ubicacion',
                'fecha_inicio',
                'fecha_fin',
                'fecha_limite',
                ['header'=>'Estado','attribute'=>'estado.descripcion'],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);}
        else{
            $datos = $dataProvider->models;
            if (count($datos) > 0){
                foreach ($datos as $pasantia) {
                $url = Url::to(['pasantia/verpasantia', 'id' => $pasantia['id']]);
                $fecha_limite = date("d/m/Y", strtotime($pasantia->fecha_limite));
                $fecha_inicio = date("d/m/Y", strtotime($pasantia->fecha_inicio));
                $fecha_fin = date("d/m/Y", strtotime($pasantia->fecha_fin));
                echo "<div class='well'>";
                echo "<h3 class='margin'>".$pasantia->titulo."</h3>";
                echo "<h4>".$pasantia->tarea."</h4>";
                echo "Requisitos: ".$pasantia->requisito."<br>";
                echo "Ubicación: ".$pasantia->ubicacion."<br>";
                echo "Estado de inscripciones: ".$pasantia->estado->descripcion."<br>";
                echo "<strong>Fecha límite de inscripción: ".$fecha_limite."</strong><br>";
                echo "<strong>Comienzo de pasantia: ".$fecha_inicio."</strong><br>";
                echo "<strong>Finalización de pasantia: ".$fecha_fin."</strong>";
                echo '<br><br><a href="'.$url.'" class="btn btn-primary" role="button">Ver pasantia</a>';
                echo "</div>";
                }
            }else{
                echo "<h3>No hay resultados.</h3>";
            }
        }
        ?>

    <?php
    }else{
        $datos = $dataProvider->models;
        if (count($datos) > 0){
          foreach ($datos as $pasantia) {
          $url = Url::to(['pasantia/verpasantia', 'id' => $pasantia['id']]);
          $fecha_limite = date("d/m/Y", strtotime($pasantia->fecha_limite));
          $fecha_inicio = date("d/m/Y", strtotime($pasantia->fecha_inicio));
          $fecha_fin = date("d/m/Y", strtotime($pasantia->fecha_fin));
          echo "<div class='well'>";
          echo "<h3 class='margin'>".$pasantia->titulo."</h3>";
          echo "<h4>".$pasantia->tarea."</h4>";
          echo "Requisitos: ".$pasantia->requisito."<br>";
          echo "Ubicación: ".$pasantia->ubicacion."<br>";
          echo "Estado de inscripciones: ".$pasantia->estado->descripcion."<br>";
          echo "<strong>Fecha límite de inscripción: ".$fecha_limite."</strong><br>";
          echo "<strong>Comienzo de pasantia: ".$fecha_inicio."</strong><br>";
          echo "<strong>Finalización de pasantia: ".$fecha_fin."</strong>";
          echo '<br><br><a href="'.$url.'" class="btn btn-primary" role="button">Ver pasantia</a>';
          echo "</div>";
          }
        }else{
            echo "<h3>No hay resultados.</h3>";
        }
    }
    ?>
    </div>
    </div>
</div>
