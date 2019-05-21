<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\CorrelativaController;
use app\models\Correlativa;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MateriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Plan de Estudio y Correlatividad';
$this->params['breadcrumbs'][] = ['label' => 'Carreras', 'url' => ['carrera/index']];
$this->params['breadcrumbs'][] = $this->title;

if (isset($error)){
    echo '<h2>'.$error.'</h2>';
?>

    <p>
        <?php // Html::a('Regresar', ['carrera/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
}else{
?>


    <div class="correlativa-ver container-fluid">

        <!-- <div class="page-header"><h2>Plan de Estudio y Correlatividad</h2></div> -->
        <h3>
            <?= $anios[0]['carrera']; ?>
            <a href="<?= $anios[0]['url']; ?>" target="_blank" title="Más info!"><span class="glyphicon glyphicon-info-sign"></span></a>
            
        </h3>
<?php
    $table='';
    //Se inicializa un objeto Correlativa para llamar funciones.
    $obj= new Correlativa();
    //Recorremos las variables que se envian desde la vista
    //El array anios, contiene una coleccion de materias agrupadas por año de cursada
    foreach ($anios as $anio){
        echo '<div class=row>';
        //Se guarda el id de carrera, y el anio de cursada
        $idCarrera=$anio['idCarrera'];
        $anio_cursada=$anio['anio_cursada'];
        echo '<div class="col-lg-12"><blockquote>Año '.$anio_cursada.'</blockquote>';
        foreach ($periodo as $unPer){
            //buscamos las materias pertenecientes a la carrera, año y periodo
            $materias=$obj->materias($idCarrera,$anio_cursada,$unPer);
            if (count($materias)==0){

            }else{
                echo '<div class="col-lg-6"><h4 class="lead">'.$unPer.'</h4>';
                //print_r($materias);
                $table='
                <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th class="col-xs-4">Materia</th>
                        <th class="col-xs-4">Cursada</th>
                        <th class="col-xs-4">Aprobada</th>
                    </tr>
                </thead>
                <tbody>
                ';
                foreach ($materias as $unaMateria){
                    $table.='<tr><td>'.$unaMateria['nombre'].'</td>';
                    //se buscan las materias cursadas y aprobadas que requiere la materia actual
                    $cursAprob= $obj->cursadas_aprobadas($unaMateria['id']);
                    $array = array();
                    if (count($cursAprob)==0){
                        $table.='<td></td>';
                        $table.='<td></td></tr>';
                    }else{
                        //si se encuentran materias cursadas y aprobadas, se llena el array antes inicializado.
                        foreach ($cursAprob as $val) {
                            if (!array_key_exists($val['idMateria'], $array)) {
                                //echo $val['idMateria'].'/';
                                $array[$val['idMateria']] = $val;
                            } else {
                                $array[$val['idMateria']]['Aprobada'] .= ', '.$val['Aprobada'];
                                $array[$val['idMateria']]['Cursada'] .= ', '.$val['Cursada'];
                            }
                        }
                        //print_r($array);
                        foreach ($array as $correlativa){
                            //se recorre el array para ya imprimir en la tabla las materias aprobadas y cursadas.
                            $cursada=$correlativa['Cursada'];
                            $aprobada= $correlativa['Aprobada'];
                            
                            $table.='<td>'.$cursada.'</td>';
                            $table.='<td>'.$aprobada.'</td></tr>';
                            
                        }
                    }
                }
                $table.=' 
                </tbody>
            </table></div>';
            echo $table;
            }
        }
    echo '</div></div>';    
    }
    ?>
            
    </div>
    <?php
}
?>
