<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CarreraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Materias';

?>



      <?php //Html::encode($this->title) ?>

    <?php $this->title="Seleccione la materia";// echo $this->render('_search', ['model' => $searchModel]); ?>



    <?php





  echo GridView::widget([
    'id'=>'anios',
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
'summary'=>'',
'tableOptions' => ['class' => 'table  table-hover'],//Tabla de tipo hover
'rowOptions' => function ($model, $key, $index, $grid) {
$id=$model->anio_cursada;
  return [
'key'=>$id,
    'style' => "cursor: pointer",//Para que muestre el icono de la mano
    'onclick'=>'$("#anios tbody tr").css({"background-color":"white","cursor": "pointer"}),mostrarCuatrimestres('.$id.'),'.'$("#anios tbody tr[key='.$id.']").css({"background-color":"rgba(120,120,120,0.2)","cursor": "pointer"})',



  ];;},

        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'nombre',
            //'id',
          //  'id',
      //  'anio_cursada',
        [
     'attribute' => 'anio_cursada','header'=>'Seleccione un año'

 ],




          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
        ?>
        <script>
        function mostrarCuatrimestres(id){

          $("#cuatrimestres").html("");
          $("#horarios").html("");
          var datos={'idAnio':id,'idCarrera':<?php echo $idCarrera;?>};
          $.ajax({
            type:"post",
            data:datos,

            url:<?php echo '"'. Url::to(['materia/listarcuatrimestres']).'"'; ?>,
            success:function(response){

                $('#cuatrimestres').html(response);



            },error:function(){
             $('#cuatrimestres').html("error");},beforeSend:function(){
                $('#cuatrimestres').html("Cargando...")
             }
         })
       }</script>
