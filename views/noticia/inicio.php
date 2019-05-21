<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;

use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;

$this->title = 'Inicio';
$this->params['breadcrumbs'][] = $this->title;

$noticiasImportantes = $noticiasImp;

//Slider

$SliderNoticias = array();



foreach ($noticiasImportantes as $unanoticia) {
	
	$unaNoticiaSlider = "";
	
    $unaNoticiaSlider .= "
        <a class='noticiaSlider' href='index.php?r=noticia/ver&id={$unanoticia->id}'>
		<div class = 'col-lg-12'>";
		
		if (($unanoticia->imagen) == "") {
			
			$unaNoticiaSlider .= "<img src='archivos/site/noticia/SliderNoticiaPorDefecto.png' alt='chincheta' width = '100%' class='imageSlider'>";
		
		}
		
		else {
			
			$unaNoticiaSlider .= "<img src='" . $unanoticia->imagen . "' width = '60%' class='imageSlider'>";
			
		}
		
		$unaNoticiaSlider .= "
		
		<div class='textSlider'>
		<h2>{$unanoticia->titulo}</h2>
		</div>

		</div></a>";

	array_push($SliderNoticias,$unaNoticiaSlider);


    }



?>

<?=Slick::widget([

        // HTML tag for container. Div is default.
        'itemContainer' => 'div',

        // HTML attributes for widget container
        'containerOptions' => ['class' => 'col-md-8'],

        // Items for carousel. Empty array not allowed, exception will be throw, if empty
        'items' => $SliderNoticias,


        // HTML attribute for every carousel item
        'itemOptions' => ['class' => 'cat-image'],

        // settings for js plugin
        // @see http://kenwheeler.github.io/slick/#settings
        'clientOptions' => [
            'autoplay' => true,
            'autoplaySpeed' => 1000,
            'dots'  => true,
            // note, that for params passing function you should use JsExpression object
            'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),

        ],

    ]);


   foreach ($noticias as $unanoticia) {
    
$usuarioLogueado = $unanoticia->usuarioLogueado;

//$usuariosSuscritos = $unanoticia->suscripcionNoticias;
$estaSuscrito= $unanoticia->suscripcionNoticias;
}


   if (isset($_SESSION["__id"])) {
   if (isset($estaSuscrito->id_usuario) == $_SESSION['__id']) {
    echo ('<h4>Suscripcion</h4>');
    echo Html::beginForm(url::toRoute("suscripcion-noticia/cancelar"), "get", ["class" => "form-inline"]);
    echo Html::hiddenInput('id', $estaSuscrito->id,['id'=>'id']);
    echo Html::hiddenInput('email', $usuarioLogueado->email,['id'=>'email']);
    echo Html::submitInput('Cancelar Suscripcion',array('value'=>'suscribirse','name' => 'suscribirse','id'=>'canSuscripcion'));
    echo Html::endForm();
   }
else{
    echo ('<h4>Suscribirse</h4>');
    $idUsuario = $_SESSION["__id"];
    echo Html::beginForm(url::toRoute("suscripcion-noticia/suscribir"), "get", ["class" => "form-inline"]);
    echo Html::hiddenInput('email', $usuarioLogueado->email,['id'=>'emailSuscripcion']);
    echo Html::hiddenInput('idUsuario', $usuarioLogueado->id,['id'=>'idUsuario']);
    echo Html::submitInput('Suscribirse',array('value'=>'suscribirse','name' => 'suscribirse','id'=>'suscribirse'));
    echo Html::endForm();
}
}

   
   ?>