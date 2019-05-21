<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\url;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
use kartik\datetime\DateTimePicker;
use app\models\Evento;
use app\models\Pasantia;

$this->title = 'Cefaiweb';
?>
<style>
    hr.style1{
        border-top: 1px dashed #8c8b8b;
        border-bottom: 1px dashed #fff;
        border-color: lightgrey;
    }
    div.pasantia a:link{
        text-decoration: none;
        color: black;
    }
    div.pasantia a:hover{
        color: lightblue;
    }

    .unaNot{
        margin: 10px;
        padding: 10px;
        border:solid 1px gainsboro
    }
    .unaNot:hover{
        box-shadow: 0 0 15px -4px rgba(0,0,0,0.75);
    }
</style>
<div id="myCarousel" class="carousel slide col-md-12" data-ride="carousel" style="margin-top: 0px;margin: 0;padding: 0;">
    <!-- Indicators -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php
        $notImp="";
        $i = 0;
        foreach ($noticiasImp as $unanoticia) {
            
            if ($i == 0) {
                $notImp.= '<div class="item active">
                            <img src="' . $unanoticia->imagen . '" alt="' . $unanoticia->alt . '" style="width:1600px;max-height:700px">
                            <div class="carousel-caption" style="background:rgba(0,0,0,0.5);width:100%;position:absolute;bottom:0;left:0;box-shadow: 0 0 25px #000;">
                                <a href="index.php?r=noticia/ver&id=<?= $unanoticia->id; ?>" style="text-decoration:none;color:white">
                                    <h3>' . $unanoticia->titulo . '</h3>
                                    <div class="container">
                                        <p>' . $unanoticia->copete . '</p>
                                    </div>
                                </a>
                                    <a href="#anclaTitulo" class="beto"><img src="archivos/site/main/bajar.gif" alt="" style="max-width:45px;margin-bottom:-20px;border:2px #fff"></a>
                                </div>
                    </div>';
            } else {
                $notImp.= '
                         <div class="item">
                                <img src="' . $unanoticia->imagen . '" alt="' . $unanoticia->alt . '" style="width:1600px;max-height:700px">
                                <div class="carousel-caption" style="background:rgba(0,0,0,0.5);width:100%;position:absolute;bottom:0;left:0;box-shadow: 0 0 25px #000;">
                                    <a href="index.php?r=noticia/ver&id=<?= $unanoticia->id; ?>" style="text-decoration:none;color:white">
                                        <h3>' . $unanoticia->titulo . '</h3>
                                        <div class="container">
                                            <p>' . $unanoticia->copete . '</p>
                                        </div>
                                    </a>
                                    <a href="#anclaTitulo" class="beto"><img src="archivos/site/main/bajar.gif" alt="" style="max-width:45px;margin-bottom:-20px;border:2px #fff"></a>
                                </div>
                        </div>';
            }
            $i++;
        }
        echo $notImp;
        ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Anterior</span>
    </a><a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Siguiente</span>
    </a>

</div>
<hr/>
<div class="container" >
    
    <div class="col-md-12" style="margin-top: 30px;"  >
<div id="anclaTitulo"></div>
        <div class=" col-md-9">
            <h1 align="center">Ultimo</h1>
            <?php foreach ($cincoNot as $unaNot) { ?>
                <div class="unaNot">
                    <a href="index.php?r=noticia/ver&id=<?= $unaNot->id; ?>" style="text-decoration: none;
        color: #000;">

                            <img src="<?= $unaNot->imagen ?>" alt="<?= $unaNot->alt ?>"  style="width:100%;">
                            <h3><?= $unaNot->titulo ?></h3>
                            <p><?= $unaNot->copete ?></p>
                            <p><?= DateTime::createFromFormat("Y-m-d H:i:s", $unaNot->fecha)->format("d/m/Y") ?></p>
                 

                    </a>
                </div>
            <?php } ?>
            <div align="center" class="col-md-12">
                <?= Html::a('Ver mas', ['noticia/noticias'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>



        <div class="col-md-3" >
            <div class="calendario" >
                <h3>Calendario</h3>
                <div class="evento-index" id="calendar">

                    <?php
                    $eventos = Evento::find()->all();
                    $arreglo = [];
                    foreach ($eventos as $eve) {
                        $evento = new \yii2fullcalendar\models\Event();
                        $evento->id = $eve->id;
                        $evento->title = $eve->nombre;
                        $evento->start = $eve->desde;
                        $evento->url = Url::to(['evento/ver', 'id' => $eve->id]);
                        if ($eve->es_feriado == 1) {
                            $evento->color = "red";
                        }
                        $evento->allDay = true;
                        $arreglo[] = $evento;
                    }
                    ?>

                    <?=
                    yii2fullcalendar\yii2fullcalendar::widget(array(
                        'events' => $arreglo,
                    ));
                    ?>
                </div>

            </div>
            <hr/>
            <div class="foro">

                <table class="table table-striped" style="border:solid 1px gainsboro">
                    <thead>
                        <tr >
                            <th style="text-align:center;"><h3>Ultimos Foros</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($foros as $unForo) {
                            $url = Url::to(['foro/ver', 'id' => $unForo->id]);
                            echo ''
                            . '<tr>'
                            . '<td>'
                            . '<a href=' . $url . ' class="col-md-12" style="text-decoration:none;color:#000">'
                            . '<div  style="width:100%;height:100%;">'
                            . '<h5 class="text-uppercase">' . $unForo->titulo . '</h5>'
                            . '<p class="text-primary">Fecha limite: ' . DateTime::createFromFormat("Y-m-d H:i:s", $unForo->fecha)->format("d/m/Y") . '</p>'
                            . '</div>'
                            . '</a>'
                            . '</td>'
                            . '</tr>'
                            ;
                        }
                        ?>
                        <tr><td><?= Html::a('Ver más foros', ['foro/index'], ['class' => 'col-md-12', 'style' => 'text-align:center;text-decoration:none;color: #000']) ?></td></tr>
                    </tbody>
                </table>
            </div>

            <hr/>












            <div class="pasantia">
                <table class="table table-striped" style="border:solid 1px gainsboro">
                    <thead>
                        <tr >
                            <th style="text-align:center;"><h3>Ultimas Pasantias</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pasantias = Pasantia::last3();
                        foreach ($pasantias as $unaPasantia) {
                            $url = Url::to(['pasantia/verpasantia', 'id' => $unaPasantia['id']]);
                            echo ''
                            . '<tr>'
                            . '<td>'
                            . '<a href=' . $url . ' class="col-md-12" style="text-decoration:none;color:#000">'
                            . '<div  style="width:100%;height:100%;">'
                            . '<h5 class="text-uppercase">' . $unaPasantia['titulo'] . '</h5>'
                            . '<p class="text-primary">Fecha limite: ' . $unaPasantia['fechalimite'] . '</p>'
                            . '</div>'
                            . '</a>'
                            . '</td>'
                            . '</tr>'
                            ;
                        }
                        ?>
                        <tr><td><?= Html::a('Ver más pasantias', ['pasantia/index'], ['class' => 'col-md-12', 'style' => 'text-align:center;text-decoration:none;color: #000']) ?></td></tr>
                    </tbody>
                </table>

            </div>









        </div>
    </div>


</div>


<script>
    $('.beto').click(function (e) {
        e.preventDefault();    //evitar el eventos del enlace normal
        var strAncla = $(this).attr('href'); //id del ancla
        $('body,html').stop(true, true).animate({
            scrollTop: $(strAncla).offset().top -40
        }, 800);

    });

</script>
