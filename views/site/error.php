<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

if (!empty($mensaje)) {
    $msg = $mensaje;
} else if (Yii::$app->session->get("error") != "") {
    $msg = Yii::$app->session->get("error");
} else {
    $msg = "No se puede acceder a esta pagina";
}

$this->title = "Atencion!";
?>
<div class="site-error" align="center">


    <img src="archivos/site/registro/alerta.png" style="margin:20px;max-width: 150px;">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger">
        <?php echo nl2br(Html::encode($msg));
        Yii::$app->session->set("error", "");
        ?>
    </div>

</div>
