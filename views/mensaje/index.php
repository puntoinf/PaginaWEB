<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MensajeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Mensajes';
$this->params['breadcrumbs'][] = $this->title;
?>
<style media="screen">
.divchat{height:670px;background:#f5f5f5;}
.conversaciones{background: #fff;height: 646px;border-radius: 5px;margin-top: 12px;overflow-y: auto;}
.conversacion-select{background: #d9edf7 !important;}
.conversacion{background:#f5f5f5;height:100px;max-height:100px;margin-top:12px !important;padding: 9px;border-radius: 3px;}
.img-conversacion{width: 70px;}
.conversacion:hover{background: #d9edf7;cursor: pointer;}
.conversaciones .badge{background-color: #337ab7;position: absolute;}
.header-chat{background:#fff;margin-top: 12px;border-radius: 5px;min-height: 39px;}
.btn-recargar-mensajes{position: absolute;right: 2px;bottom: 2px;border-radius: 10px;}
.btn-recargar-mensajes::selection{background-color: red;}
.chat{height:646px}
.contenido-chat{background: #fff;height: 486px;border-radius: 5px;margin-top: 12px;overflow-y: auto;}
.contenido-chat-mensaje, .chat button{margin-top:12px !important;}
.contenido-chat-mensaje span{margin-left: 7px;}
.fecha-mensaje{display: none;}
/* .fecha-mensaje:hover{display: block !important;} */
.contenido-chat-mensaje h4:hover >.fecha-mensaje{display: inline !important;}
.chat-input textarea{min-width: 100%;max-width: 100%;height: 100px;margin-top: 12px;}
.lista_usuarios{margin: 10px;}
.lista_usuarios span{margin: 4px;padding: 5px;font-size: 85%;border-radius: 4px;cursor: pointer;}
.alert-nuevo-mensaje{position: absolute;bottom: 0;}
</style>

<div class="mensaje-index">

  <h1><?= Html::encode($this->title) ?></h1>
  <?php if (!empty($nuevo_chat)): ?>
    <input type="hidden" id="nuevo_chat_id" value="<?= $nuevo_chat['id']; ?>">
    <input type="hidden" id="nuevo_chat_nombre" value="<?= $nuevo_chat['nombre']; ?>">
    <input type="hidden" id="nuevo_chat_apellido" value="<?= $nuevo_chat['apellido']; ?>">
  <?php endif; ?>
  <input type="hidden" id="onload_id_chat" value="<?= $id_chat; ?>">
  <div class="input-group col-sm-4">
    <span class="input-group-addon">Nuevo Mensaje</span>
    <input type="text" class="form-control" id="username_input" data-id-list="<?= $id_list; ?>" placeholder="Escriba un nombre de usuario">
    <input type="hidden" id="id_usuario_actual" value="<?= $id_usuario_actual; ?>">
  </div>
  <div id="lista_usuarios" class="lista_usuarios"></div>

  <div class="col-sm-12 divchat">
    <div class="col-sm-4 conversaciones">
      <?php foreach ($mensajes as $mensaje): ?>
        <div id="conversacion<?= $mensaje['id_chat']; ?>"
          onclick="cargarMensajes(this);"
          data-id-con="<?= $mensaje['id_con']; ?>"
          data-nombre-completo="<?= $mensaje['nombre_con'].' '.$mensaje['apellido_con']; ?>" class="media conversacion conversacion-bg">

          <?php if ($mensaje['no_leido']!=0): ?>
            <span class="badge" title="Tiene mensajes"><?= $mensaje['no_leido']; ?></span>
          <?php endif; ?>

          <div class="media-left">
            <a href="#">
              <?php if ($mensaje['imagen_con']=='' || file_exists($mensaje['imagen_con'])==false): ?>
                <img class="media-object img-conversacion" src="../web/archivos/usuario/user-alt.png">
              <?php else: ?>
                <img class="media-object img-conversacion" src="<?= $mensaje['imagen_con'] ?>">
              <?php endif; ?>
            </a>
          </div>
          <div class="media-body">
            <h4 class="media-heading text-info">
              <a href="index.php?r=usuario%2Fperfil&id=<?= $mensaje['id_con']; ?>" title="Ver perfil">
                <?= $mensaje['nombre_con'].' '.$mensaje['apellido_con']; ?>
              </a>
            </h4>
            <small><?= $mensaje['fecha']; ?></small>
            <p><?= $mensaje['texto']; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>


    <div class="col-sm-8 chat">
      <div id="header_chat" class="col-sm-12 header-chat text-center">
        <h4 class="text-info"></h4>
        <button id="recargar_mensajes_start" class="btn btn-recargar-mensajes" data-id-chat='' title="Activar recargar mensajes">
          <span class="glyphicon glyphicon-refresh"></span>
        </button>
        <button id="recargar_mensajes_stop" class="btn btn-danger btn-recargar-mensajes hidden" onclick="recargarMensajesStop(recargarMensajes)" title="Parar recarga">
          <span class="glyphicon glyphicon-refresh"></span>
        </button>
      </div>
      <div id="contenido_chat" class="col-sm-12 contenido-chat">

      </div>

      <div id="chat_input" class="col-sm-12 form-inline chat-input">
        <div class="form-group col-sm-10">
          <textarea class="form-control"></textarea>
        </div>
        <button id="enviar_conversacion"
        onclick="enviarMensaje(this)"
        data-id-con="" data-id-chat="" type="button" class="btn btn-success col-sm-2">Enviar</button>
      </div>
    </div>

  </div>

  <script type="text/javascript">
  $(document).ready(function () {
    // CARGAR USUARIOS -------------------------
    $('#username_input').keyup(function(){
      var nombre=$('#username_input').val(),
      id_list=$('#username_input').attr('data-id-list');
      if(nombre!=''){ //Si la palabra a buscar es dinstinto de vacio, entro al ajax; si borro todo limpio la lista
        $.ajax({
          url: "index.php?r=usuario%2Fbuscar",
          type: "POST",
          data: {'nombre':nombre,'id_list':id_list}, //valor = parametro de la funcion
          success: function(datos){ //datos=provincias del PDOprovincias
            // console.log(datos);
            obj=JSON.parse(datos); //parseo los datos para poder manejarlos
            //   console.log(obj);
            $('#lista_usuarios').html('');
            Object.keys(obj).forEach(function(key) { //primero selecciono a que le voy a aplicar la funcion, en este caso forEach
              var newContent = "<span class='label label-success label-usuario' data-id="+obj[key]['id']+" onclick='return relleno(this);'>"+obj[key]['nombre']+" "+obj[key]['apellido']+"</span>";
              //$('#respuesta').html('');
              $("#lista_usuarios").append(newContent);
            });
          },
          error: function(datos){
            console.log(datos);
          }
        });
      }
      else {//Limpio el listado ya que no hay nada escrito
        $('#lista_usuarios').html('');
      }
    });
    if ($('#nuevo_chat_id').val()!==undefined) {
      var id = $('#nuevo_chat_id').val(),
          nombre = $('#nuevo_chat_nombre').val(),
          apellido = $('#nuevo_chat_apellido').val(),
          newContent = "<span id='spanNuevoChat' class='label label-success label-usuario' data-id="+id+" onclick='return relleno(this);'>"+nombre+" "+apellido+"</span>";
      $("#lista_usuarios").append(newContent);
      $("#spanNuevoChat").click();
    }else if ($('#onload_id_chat').val()!=='') {
      var id_chat = $('#onload_id_chat').val().toString();
      var doOnce = setTimeout(function(){
        $('#conversacion'+id_chat).click();
      },1000);
      // clearInterval(doOnce);
    }
  });
  // CARGAR MENSAJES-------------------------------------
  function cargarMensajes(conversacion){
    var id_chat = conversacion.id.replace('conversacion',''),
    id_con = conversacion.getAttribute('data-id-con'),
    nombre_completo = conversacion.getAttribute('data-nombre-completo'),
    div=document.getElementsByClassName('conversacion');
    console.log(id_chat);
    for (var i = 0; i < div.length; i++) {
      div[i].classList.remove('conversacion-select');
    }
    conversacion.classList.add('conversacion-select');
    if ($(conversacion).children('span').length!==0) {
      $(conversacion).children('span').text('0');
    }
    $.ajax({
      url: "index.php?r=mensaje%2Fcargar-mensajes-chat",
      type: "POST",
      data: {'id_chat': id_chat},
      success: function (response) {
        // console.log(response);
        obj = JSON.parse(response); //parseo los datos para poder manejarlos
        // cambiamos titulos y textos
        $("#contenido_chat").html("");
        $('#chat_input textarea').val('');
        $('#header_chat h4').text('Conversacion con '+nombre_completo);
        $('#recargar_mensajes_start').attr('data-id-chat',id_chat);
        $('#recargar_mensajes_start').attr('onclick','recargarMensajesStart("'+id_chat+'")');
        Object.keys(obj).forEach(function(key) { //primero selecciono a que le voy a aplicar la funcion, en este caso forEach
          // console.log(obj[key]['remitente_nombre']);
          // listamos los mensajes en #contenido-chat uno a uno
          // console.log(obj[key]);
          if (obj[key]['remitente_imagen']=='' || obj[key]['remitente_imagen']==undefined) {
            var imagen = "../web/archivos/usuario/user-alt.png";
          }else {
            var imagen = obj[key]['remitente_imagen'];
          }
          if (obj[key]['visto'].indexOf(id_con)!=-1) {
            var visto = '<span class="glyphicon glyphicon-ok text-success" title="Visto"></span>';
          }else {
            var visto = '';
          }
          var newContent = "<div class='media contenido-chat-mensaje'>\
          <div class='media-left'>\
          <a href='#'>\
          <img class='media-object img-conversacion' src='"+imagen+"'>\
          </a>\
          </div>\
          <div class='media-body'>\
          <h4 class='media-heading text-info'>"+obj[key]['remitente_nombre']+" "+obj[key]['remitente_apellido']+" <small class='fecha-mensaje'>"+obj[key]['fecha']+"</small></h4>\
          <p class='pull-left'>"+obj[key]['texto']+"</p>"+visto+"\
          </div>\
          <hr>\
          </div>";
          $("#contenido_chat").append(newContent);
        });
        //hacemos scroll hasta el final del chat
        cont=document.getElementById('contenido_chat');
        cont.scrollTop = cont.scrollHeight;
        //alteramos atributos data del boton enviar.
        $('#enviar_conversacion').attr('data-id-con',id_con);
        $('#enviar_conversacion').attr('data-id-chat',id_chat);
        $('#chat_input textarea').focus();
      },
      error: function (response){console.log(response);}
    });
  }
  // ENVIAR MENSAJE------------------------------------------
  function enviarMensaje(mensaje){
    var id_chat = mensaje.getAttribute('data-id-chat'),
    id_con = mensaje.getAttribute('data-id-con'),
    texto = $('#chat_input textarea').val();
    if (texto!=='' && id_con!=='') {
      $.ajax({
        url: "index.php?r=mensaje%2Fenviar-mensaje",
        type: "POST",
        data: {'id_chat': id_chat,'id_con':id_con,'texto':texto},
        success: function (response) {
          console.log(response);
          obj = JSON.parse(response);
          if (id_chat=='') {
            // location.replace("http://localhost/cefaiweb/web/index.php?r=mensaje%2Findex&id_chat="+obj);
            location.reload();
            // $('#conversacion'+obj).click();
          }else {
            $('#conversacion'+id_chat).click();
          }
        },
        error: function (response){console.log(response.responseText);}
      });
    }else {
      alert('error: seleccione una conversacion y rellene el campo texto');
    }
  }
  function relleno(nombre){ // carga datos del usuario seleccionado para poder enviarle mensaje
    var id_con = nombre.getAttribute('data-id');
    $("#contenido_chat").html('');
    $('#lista_usuarios').html('');
    $('#username_input').val('');
    $('#recargar_mensajes_start').attr('onclick','');
    $('#header_chat h4').text('Iniciar conversacion con '+nombre.innerText);
    var div = "<div class='alert alert-info alert-nuevo-mensaje' role='alert'>Escribe un mensaje para iniciar una conversacion con <b>"+nombre.innerText+"</b> <span class='glyphicon glyphicon-arrow-down'></span></div>";
    $('#contenido_chat').append(div);
    $('#enviar_conversacion').attr('data-id-chat','');
    $('#enviar_conversacion').attr('data-id-con',id_con);
    $('#chat_input textarea').focus();
  }
  function recargarMensajesStart(id_chat){
    $('#recargar_mensajes_stop').removeClass('hidden');
    $('#recargar_mensajes_start').addClass('hidden');
    recargarMensajes = setInterval(function(){
      $('#conversacion'+id_chat).click();
    }, 5000);
  }
  function recargarMensajesStop(recargarMensajes){
    $('#recargar_mensajes_start').removeClass('hidden');
    $('#recargar_mensajes_stop').addClass('hidden');
    clearInterval(recargarMensajes);
  }
  </script>
