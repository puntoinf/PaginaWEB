<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

$req=Yii::$app->request;
$this->title = 'Horarios de cursado';
?>
  
<div class="carrera-seleccionar container">
<h1><?= Html::encode($this->title) ?></h1>
<div class="col-md-4" id="carreras">
<?php

echo GridView::widget([
  'id' => 'widgetCarrera',
  'summary' => '',
  'dataProvider' => $dataProvider,
  'tableOptions' => ['class' => 'table  table-hover'], //Tabla de tipo hover
  'filterModel' => $searchModel,
  'rowOptions' => function ($model, $key, $index, $grid) {
    return [
      'style' => "cursor: pointer", //Para que muestre el icono de la mano
      'onclick' => '$("#widgetCarrera tbody tr").css({"background-color":"white","cursor": "pointer"}),mostrarAnios('.($key).
      '),'.
      '$("#widgetCarrera tbody tr[data-key='.$key.
      ']").css({"background-color":"rgba(120,120,120,0.2)","cursor": "pointer"})',
    ];
  },
  'columns' => [
    [
      'attribute' => 'nombre',
      'header' => 'Seleccione una carrera',
      'filterInputOptions' => [
        'class' => 'form-control',
        'placeholder' => 'Buscar...'
      ]
    ],
  ],
]);
   ?>
</div>
<div class="col-md-4" id="anios"></div>
<div class="col-md-4" id="cuatrimestres"></div>

<script>
function mostrarAnios(id) {
  $("#cuatrimestres").html("");
  $("#horarios").html("");
  $("#anios").html("");
  var datos = {
    'id': id
  };
  $.ajax({
    type: "post",
    data: datos,
    url: <?php echo '"'. Url::to(['materia/listaranios']).'"'; ?>,
    success: function (response) {
      $('#anios').html(response);
    },
    error: function () {
      $('#anios').html("error");
    },
    beforeSend: function () {
      $('#anios').html("Cargando...")
    }
  })
}
</script>
</div >
