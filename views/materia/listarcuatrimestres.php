<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarreraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Seleccione Materias';

?>



<?php $req=Yii::$app->request;//Html::encode($this->title) ?>



<?php

echo GridView::widget([
  'dataProvider' => $dataProvider,
  //'filterModel' => $searchModel,
  'summary'=>'',
  'tableOptions' => ['class' => 'table  table-hover'],//Tabla de tipo hover
  'columns' => [
    //['class' => 'yii\grid\SerialColumn'],
    //'nombre',
    //'id',[]
    //  'id',
    'periodo',


    [
      'class' => 'yii\grid\DataColumn', // can be omitted, default
      'header'=>'Ver horarios',
      'format'=> 'raw',
      'value'=> function($data){
$req=Yii::$app->request;
$periodo=$data['periodo'];
        return Html::a('<center><span class="glyphicon glyphicon-eye-open"></span></center>','#',[
          'onclick'=>"listarHorarios("."\"".$periodo."\"".");   function listarHorarios(periodo){

          var datos={'idAnio':". $req->post('idAnio').",'periodo':periodo,'idCarrera':".$req->post('idCarrera')."};

              $.ajax({
                type:'post',
                data:datos,

                url:".'"'. Url::to(['horariocursado/horarios']).'"'.",
                success:function(response){

                   $('#tablaHorarios .modal-body').html(response);
                    $('#tablaHorarios').modal();
                },error:function(){
                  $('#tablaHorarios .modal-body').html('error');
                   $('#tablaHorarios').modal();;},beforeSend:function(){   $('#tablaHorarios .modal-body').html('Cargando');
                      $('#tablaHorarios').modal()}
            })}"

        ]);},

      ],
    ]
    //  ['class' => 'yii\grid\ActionColumn'],
  ]);
  Modal::begin([
    'id'=>'tablaHorarios',
    'header'=>'<center><h1>Horarios</h1></center>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>',


]);



Modal::end();?>
  <script type="text/javascript">


</script>
