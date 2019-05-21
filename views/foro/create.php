<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Foro */

$this->title = 'Crear Foro';
$this->params['breadcrumbs'][] = ['label' => 'Admin Foros', 'url' => ['indexadmin']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="foro-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
