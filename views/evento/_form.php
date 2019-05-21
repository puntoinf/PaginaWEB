<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
//use kartik\datetime\DateRangePicker;
use dosamigos\datetimepicker\DateTimePicker;
use dosamigos\datepicker\DateRangePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Evento */
/* @var $form yii\widgets\ActiveForm */

//verificacion de permisos de usuario
$data = json_decode(\app\models\Rol::findOne(app\models\Usuario::findOne($_SESSION["__id"])->idrol)->permiso_rol,true);
if($data["e"]!="x"){
?>

<script type="text/javascript">
/* permite cambiar el idioma de datePicker. */

 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});

</script>



<div class="evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lugar')->textInput(['maxlength' => true]) ?>

    <!-- Se utiliza widget DateTimePicker para que se seleccione dia y hora del comienzo/fin del evento -->
	<?= $form->field($model, 'desde')->widget(
               DateTimePicker::className(), [
               'value' => date('d-M-Y', strtotime('+2 days')),
               'options' => [
                   'dateFormat'=>'yyyy-MM-dd',
                   'timeFormat'=>'hh:mm:ss',
                   'showButtonPanel'=>true,
                   'changeYear'=> true,
                   'yearRange'=>'-80:-10',
                    'yearRange'=> '-115:+0',
                    
                    'startAttribute'=>'2018-06-00',


                    'todayHighlight'=>true,
                    'autoclose' => true,
                    'class'=>'form-control',
                    'placeholder'=>date('Y-m-d')
                ],
        ]) ?>

        <?= $form->field($model, 'hasta')->widget(
               DateTimePicker::className(), [
               'options' => [
                    'dateFormat'=>'yyyy-MM-dd',
                    'timeFormat'=>'hh:mm:ss',
                    'showButtonPanel'=>true,
                    'changeYear'=> true,
                    'yearRange'=>'-80:-10',
                    'yearRange'=> '-115:+0',

                    'montRange'=>'6-12',

                
                    'todayHighlight'=>true,
                    'autoclose' => true,
                    'class'=>'form-control',
                    'placeholder'=>date('Y-m-d')
                ],
        ]) ?>
		
    <?= $form->field($model, 'es_feriado')->checkBox(['label' => '¿Es Feriado?', 
'uncheck' => '0', 'checked' => '1']) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php }else{
    Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
     return app\controllers\SiteController::redirect("index.php?r=site/error"); 
}?>