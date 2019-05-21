


<div class="col-md-12">

    <div class="col-md-12" align="center">
        <h1 class="col-md-12" align="center">Centro de Estudiantes de la Facultad del Comahue</h1>
        <hr  class="col-md-12">
        <p><i>Centro de estudiantes realizado por estudiantes integrado por estudiantes para estudiantes que estudiantean pero en lugar de estudiar leen esto.</i></p>
        <div style="margin-top: 30px">
            <div class="col-md-6" align="center">
                <img src="archivos/site/main/logo.png" alt="Grupo de trabajo" class="col-md-12"  style="margin-bottom: 30px">
                <b>Medios de contacto</b><br>
                <a href="tel:2994490300" style="text-decoration: none;color:#000;"><img src="archivos/site/main/tel.png" alt="Telefono"> Tel: 2994490300</a>
                <?=(!Yii::$app->user->isGuest)?'<a href="index.php?r=propuesta%2Fcreate" style="text-decoration: none;color:#000;"><img src="archivos/site/main/email.png" alt="Email"> Contacto Directo</a>':''?>
                <a href="https://www.facebook.com/CEFAIUNCO/" style="text-decoration: none;color:#000;"><img src="archivos/site/main/fb.png" style="width:15px" alt="Email"> Facebook</a>
            </div>
            <div class="col-md-6" style="border:solid 1px gainsboro; padding: 5px">
                <h3 align="center">¿Como ubicarnos?</h3>
                <img src="archivos/site/main/plano.jpg"  alt="Plano Universidad Nacional del Comahue" style="cursor: pointer;width:100%" class="col-md-12" onclick='swal({text: "Plano Universidad Nacional del Comahue", icon: "archivos/site/main/plano.jpg", button: "Cerrar"})'>
            </div>
        </div>
    </div>

</div>