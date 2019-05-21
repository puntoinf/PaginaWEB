<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar Sesion';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="form-group col-lg-6 col-md-offset-3" align="center">
        <h1><?= Html::encode($this->title) ?></h1>
        <img src="archivos/site/registro/iniciarsesion.png"  style="width: 150px;">
    </div>
    <div class="form-group col-lg-6 col-md-offset-3">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
        ]);
        ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'clave')->passwordInput() ?>


        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
<?= Html::submitButton('Iniciar Sesion', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

<?php ActiveForm::end(); ?>
    </div>
</div>
