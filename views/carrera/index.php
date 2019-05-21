<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarreraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carreras';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.glyphicon {
    font-size: 20px;
}
</style>
<div class="carrera-index container">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Carrera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
Modal::begin([
    'header' => '<h4>Plan de Estudio y Correlatividades</h4>',
    'id'     => 'modal',
    'size'   => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>',
]);

echo "<div id='modalContent'></div>";

Modal::end();
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions'=>['class'=>'table table-hover'],
        'summary' => "",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'nombre',
                'headerOptions' => ['style' => 'width:70%'],
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Buscar...'
                 ]
            ],
            [
                'label' => 'Plan de Estudio y Correlatividades',
                'headerOptions' => ['style' => 'width:20%'],
                'contentOptions' => ['class' => 'text-center'],
                'value'=> function($data){
                    $id= $data->id;
                    return   Html::button('<span class="glyphicon glyphicon-eye-open"></span>', ['id' => 'modalButton', 'value' => Url::toRoute(['correlativa/ver', 'idCarrera' => $id]), 'class' => 'btn btn-link modalButton']
            );      
            },
                'format' => 'raw'
            ],
            [
                'label'=> 'Más información',
                'headerOptions' => ['style' => 'width:10%'],
                'contentOptions' => ['class' => 'text-center'],
                'format' => 'raw',
                'value'=> function($data){
                    $url= $data->url;
                    $doc='<a href="'.$url.'" target="_blank" class="btn btn-link">
                      <span class="glyphicon glyphicon-info-sign"></span>
                    </a>';
                        return $doc;
                },
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
</div>