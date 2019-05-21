<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\datetime\DateTimePicker;
use app\models\Evento;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//  $this->title = 'Eventos';
//$this->params['breadcrumbs'][] = $this->title;

//verificacion de permisos de usuario
if(Yii::$app->user->isGuest){
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
    return app\controllers\SiteController::redirect("index.php?r=site/error");
}
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if($data["f"]!="x"){

?>

  
<div class="evento-index" id="calendar" >

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Evento', ['create'], ['class' => 'btn btn-success']) //Boton Crear evento ?>
    </p>

     

    <!-- mostramos el calendario de fullcalendar de la siguiente manera -->
    <?= yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
       'options'=>array(
        'style'=>'width:100%',
        ),

    ));

?>

</div>

<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error");
}?>