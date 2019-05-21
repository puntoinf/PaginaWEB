<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\helpers\Url;

$this->title = 'Inicio';
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\LinkPager;

echo '<div class="row">';
//echo $this->render('_search', ['model' => $searchModel]);
$todasLasNoticias = "<div class = 'col-lg-8 noticias' id='noticias'><h1 align='center'>Novedades</h1>";

foreach ($noticias as $unanoticia) {
	if ($unanoticia->id_estado==6) {
		
	
    $todasLasNoticias .= "
        <a class='minNoticiaE' href='index.php?r=noticia/ver&id={$unanoticia->id}'>
<div class = 'col-lg-12 minNoticia '>";

		if (($unanoticia->imagen) == "") {
			
			$todasLasNoticias .= "<img src='archivos/site/noticia/logofacultad.png' alt='Logo de la Facultad de Informatica'>";
		
		}
		
		else {
			
			$todasLasNoticias .= "<img src='" . $unanoticia->imagen . "'>";
			
		}
		
		
$todasLasNoticias .= "<h3>{$unanoticia->titulo}</h3>

<p>" . $unanoticia->copete . "</p>

</div></a>";
}

}

echo $todasLasNoticias."</div>";

echo '

	<div class = "col-lg-4 ranking">
		<h2 align="center">Ultimas Noticias</h2>';
$Ranking = "";


foreach ($ultimasNoticias as $unanoticia) {
    $Ranking .= "
        <a class='minRankingE' href='index.php?r=noticia/ver&id={$unanoticia->id}'>
	<div class='unRanking  col-lg-12'>
	<h5 class = 'col-lg-6'>{$unanoticia->titulo} </h5>
	<img class = 'col-lg-4' src='" . $unanoticia->imagen . "'> </div> </a>";

 
}

echo $Ranking;
/*
foreach ($noticias as $unanoticia) {
   
//$usuariosSuscritos = $unanoticia->suscripcionNoticias;
$estaSuscrito= $unanoticia->suscripcionNoticias;
}
*/

$estaSuscrito = $usuarioSus;
echo "<div class = 'col-lg-4 suscripcion' >";
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
    if (isset($usuarioLogueado->id)) {
    echo Html::beginForm(url::toRoute("suscripcion-noticia/suscribir"), "get", ["class" => "form-inline"]);
    echo Html::hiddenInput('email', $usuarioLogueado->email,['id'=>'emailSuscripcion']);
    echo Html::hiddenInput('idUsuario', $usuarioLogueado->id,['id'=>'idUsuario']);
    echo Html::submitInput('Suscribirse',array('value'=>'suscribirse','name' => 'suscribirse','id'=>'suscribirse'));
    echo Html::endForm();
}
}
}
echo '</div></div></div>';

//-----------------------Paginador------------------------------------

echo '<div class = "col-md-8">';

echo LinkPager::widget([
    'pagination' => $pages,
]);

echo '</div>';


?>