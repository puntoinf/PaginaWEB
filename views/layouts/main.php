<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php
$this->beginPage();
$nombre = "";
$imagen = "";
$permisosJson = [];
if (!Yii::$app->user->isGuest) {
    $usuarioLogeado = \app\models\Usuario::findOne($_SESSION["__id"]);
    $imagen = $usuarioLogeado->imagen;
    $nombre = $usuarioLogeado->nombre . " " . $usuarioLogeado->apellido;
    $idRol = $usuarioLogeado->idrol;
    if ($idRol != 5) {

        $permisos = \app\models\Rol::findOne($idRol)->permiso_rol;
        $permisosJson = json_decode($permisos, true);
    }
    if ($usuarioLogeado->id_estado != 6) {
        app\controllers\UsuarioController::redirect(["site/estadodecuenta"]);
    }
}
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="archivos/site/main/favicon32.png" sizes="16x16" />
        <link rel="icon" type="image/png" href="archivos/site/main/favicon.png" sizes="16x16" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link rel="stylesheet" type="text/css" href="../../web/css/site.css">
        <script type="text/javascript" src="ajax/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="ajax/md5.min.js"></script>
        <script type="text/javascript" src="ajax/foro.js"></script>
        <script type="text/javascript" src="ajax/login-register.js"></script>
        <script type="text/javascript" src="ajax/perfil.js"></script>
        <script src="ajax/sweetalert.min.js"></script>

    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => '<img src="archivos/site/main/logo.png" class="img-rounded" width="120px" style="margin-top:-5px">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top'
                ],
            ]);

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'encodeLabels' => false,
                'items' => [['label' => 'Institucional', 'items' => [
                        ['label' => 'Carreras', 'url' => 'index.php?r=carrera%2Findex'],
                        ['label' => 'Horarios', 'url' => 'index.php?r=carrera%2Fhorarios'],
                ]],]]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => [
                        ['label' => 'Registro', 'url' => 'index.php?r=site/registro', 'visible' => Yii::$app->user->isGuest],
                        ['label' => 'Iniciar Sesion', 'url' => 'index.php?r=site%2Flogin', 'visible' => Yii::$app->user->isGuest],
                        ['label' => '<img src="archivos/site/main/admin.png" class="img-rounded" width="20px">', 'items' => [
                                ['label' => 'Eventos', 'url' => 'index.php?r=evento%2Findexadm', 'visible' => array_key_exists('e', $permisosJson)],
                                ['label' => 'Foros', 'url' => 'index.php?r=foro%2Findexadmin', 'visible' => array_key_exists('f', $permisosJson)],
                                ['label' => 'Inventario', 'url' => 'index.php?r=inventario', 'visible' => array_key_exists('i', $permisosJson)],
                                ['label' => 'Carreras', 'url' => 'index.php?r=carrera/administrar', 'visible' => array_key_exists('m', $permisosJson)],
                                ['label' => 'Materias', 'url' => 'index.php?r=materia', 'visible' => array_key_exists('m', $permisosJson)],
                                ['label' => 'Correlativas', 'url' => 'index.php?r=correlativa', 'visible' => array_key_exists('m', $permisosJson)],
                                ['label' => 'Horarios', 'url' => 'index.php?r=horariocursado', 'visible' => array_key_exists('m', $permisosJson)],
                                ['label' => 'Noticias', 'url' => 'index.php?r=noticia', 'visible' => array_key_exists('n', $permisosJson)],
                                ['label' => 'Pasantias', 'url' => 'index.php?r=pasantia', 'visible' => array_key_exists('p', $permisosJson)],
                                ['label' => 'Propuestas', 'url' => 'index.php?r=propuesta%2Findex', 'visible' => array_key_exists('c', $permisosJson)],
                                ['label' => 'Usuarios', 'url' => 'index.php?r=usuario%2Findex', 'visible' => array_key_exists('u', $permisosJson)]
                        ], 'visible' => !Yii::$app->user->isGuest && $idRol != 5],
                        ['label' => '<img src="archivos/site/main/sms2D.png" class="img-rounded" width="20px">', 'url' => 'index.php?r=mensaje', 'visible' => !Yii::$app->user->isGuest],
                        ['label' => $nombre . ' <img src="' . $imagen . '" class="img-rounded" width="20px">', 'items' => [
                                ['label' => 'Mi perfil', 'url' => 'index.php?r=usuario%2Fperfil'],
                                ['label' => 'Cerrar Sesion', 'url' => 'index.php?r=site%2Flogout', 'linkOptions' => ['data-method' => 'post']],
                        ], 'visible' => !Yii::$app->user->isGuest,
                    ],
                ],
            ]);
            NavBar::end();
            ?>
            <?php
            $direccion = "/MASTER/cefaiweb/web/";
            $urla = $_SERVER["REQUEST_URI"];
            ?>


            <div class="<?= ($urla != $direccion . "index.php" && $urla != $direccion . "index.php?r=site%2Findex" && $urla != $direccion . "index.php?r=site/index") ? "container" : "" ?>">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?></div>
        </div>

        <footer class="footer col-md-12 no-print" >
            <div class="container">
                <p class="pull-left">&copy; PWD  <?= date('Y') ?></p>
                <p class="pull-right">
                    <?= (!Yii::$app->user->isGuest) ? '<a href="index.php?r=propuesta%2Fcreate">Contacto</a><br>' : '' ?>
                    <a href="index.php?r=site%2Fmasinfo">Mas sobre nosotros</a></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>

<style>
    body{
        background: url("archivos/site/Texturas/txt (35).png");
    }
    .swal-modal{
        width:55% !important;
        padding:10px;
    }

    @media print
    {    
        .no-print, .no-print *,.breadcrumb
        {
            display: none !important;
        }
    }
</style>
