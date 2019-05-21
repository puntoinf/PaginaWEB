<?php
namespace app\controllers;
use Yii;
use app\models\Mensaje;
use app\models\MensajeLeido;
use app\models\MensajeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Usuario;
/**
 * MensajeController implements the CRUD actions for Mensaje model.
 */
class MensajeController extends Controller
{
  public $id_usuario_actual;
  public function init(){
      $this->id_usuario_actual=(!empty($_SESSION["__id"]))?$_SESSION["__id"]:"0";
      // echo $this->id_usuario_actual;exit;
    if($this->id_usuario_actual=="0"){
      $this->redirect("index.php?r=site%2Flogin");
        }
  }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all Mensaje models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $id_con=$this->id_usuario_actual;
        $objMensajes = new Mensaje();
        $id_usuario = $this->id_usuario_actual;
        $mensajes = $objMensajes->getUltimosMensajes($id_usuario);
        //añadir nombre de la persona con quien se esta conversando (no se puede saber si es remitente o destinatario en cualquier momento)
        $i=0;
        $id_list="";
        foreach ($mensajes as $mensaje) {
          if ($mensaje['id_usuario_remitente']==$id_usuario) { //identificar usuario (que no es usuario actual)
            $id_con=$mensaje['id_usuario_destino'];
          }else {
            $id_con=$mensaje['id_usuario_remitente'];
          }
          $mensajes[$i]["id_con"]=$id_con;
          $mensajes[$i]["nombre_con"]=Usuario::findOne($id_con)->getAttribute("nombre");
          $mensajes[$i]["apellido_con"]=Usuario::findOne($id_con)->getAttribute("apellido");
          $mensajes[$i]["imagen_con"]=Usuario::findOne($id_con)->getAttribute("imagen");
          $id_list.="$id_con,";
          $mensaje_leido=MensajeLeido::findOne(["id_chat" => $mensaje['id_chat'], "id_usuario" => $id_usuario]);
          if ($mensaje_leido=='') {
            $mensajes[$i]['no_leido']=0;
          }else {
            $mensajes[$i]['no_leido']=$mensaje_leido->getAttribute("mensajes");
          }
          $i=$i+1;
        }
        if (!empty($_GET['id_con'])) {
          $id_con = $_GET['id_con'];
          if ($id_usuario < $id_con) {
            $id_chat = $id_usuario."_".$id_con;
          }else {
            $id_chat = $id_con."_".$id_usuario;
          }
        }elseif (isset($_GET['id_chat'])) {
          $id_chat = $_GET['id_chat'];
        }else {
          $id_chat = '';
        }
        if (Mensaje::findOne(["id_chat" => $id_chat])=='' && !empty($_GET['id_con'])){
          $usr=Usuario::findOne($id_con);
          $nuevoChat['id'] = $usr->getAttribute('id');
          $nuevoChat['nombre'] = $usr->getAttribute('nombre');
          $nuevoChat['apellido'] = $usr->getAttribute('apellido');
        }else {
          $nuevoChat = '';
        }
        // $id_chat = (isset($_GET['id_chat']) ? $_GET['id_chat'] : "");
        return $this->render('index', [
            'mensajes' => $mensajes,
            'id_list' => $id_list,
            'id_chat' => $id_chat,
            'nuevo_chat' => $nuevoChat,
            'id_usuario_actual' => $id_usuario,
        ]);
    }
    public function actionCargarMensajesChat(){
      $id_chat = $_POST['id_chat'];
      $id_usuario = $this->id_usuario_actual;
      $objMensajes = new Mensaje();
      $mensajes = $objMensajes->getMensajesChat($id_chat,$id_usuario);

      $mensaje_leido = MensajeLeido::findOne(["id_chat" => $id_chat, "id_usuario" => $id_usuario]);
      if ($mensaje_leido!='') {
        // reseteo contador de mensajes no leidos
        $mensaje_leido->mensajes = 0;
        $mensaje_leido->save();
      }
      // actualizamos 'vistos'
      foreach ($mensajes as $mensaje) {
        if (strpos($mensaje['visto'],"$id_usuario")===false) {
          $id_msj = $mensaje['id'];
          $obj = Mensaje::findOne($id_msj);
          $obj->visto = $obj->visto.','.$id_usuario;
          // $obj->__set('visto',"$obj->visto,$id_usuario");
          // var_dump($obj);
          $obj->save();
          // print_r($obj->getErrors());
        }
      }
      return json_encode($mensajes);
    }

    public function actionEnviarMensaje(){
      $mensaje = new Mensaje();
      $id_remitente = $this->id_usuario_actual;
      $id_usuario_destino = $_POST['id_con'];
      if ($_POST['id_chat']!=="") {
        $id_chat = $_POST['id_chat'];
      }elseif ($id_remitente < $id_usuario_destino) {
        $id_chat = $id_remitente."_".$id_usuario_destino;
      }else {
        $id_chat = $id_usuario_destino."_".$id_remitente;
      }
      $mensaje->id_chat = $id_chat;
      $mensaje->id_usuario_remitente = $id_remitente;
      $mensaje->id_usuario_destino = $id_usuario_destino;
      $mensaje->texto = $_POST['texto'];
      $mensaje->visto = "$id_remitente";
      $mensaje->fecha = date("Y-m-d H:i:s");
      $mensaje->save();
      $mensaje_leido = MensajeLeido::findOne(["id_chat" => $id_chat, "id_usuario" => $id_usuario_destino]);
      if ($mensaje_leido==''){
        $mensaje_leido = new MensajeLeido();
        $mensaje_leido->mensajes = 1;
      }else {
        // var_dump($mensaje_leido);
        $mensaje_leido->mensajes = $mensaje_leido->mensajes + 1;
        // $mensaje_leido->id = $mensaje_leido_find->id;
        // $mensaje_leido->mensajes = 1;
      }
      $mensaje_leido->id_usuario = $id_usuario_destino;
      $mensaje_leido->id_chat = $id_chat;
      $mensaje_leido->save();
      return json_encode($id_chat);
    }
    /**
     * Displays a single Mensaje model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new Mensaje model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mensaje();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    /**
     * Updates an existing Mensaje model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /**
     * Deletes an existing Mensaje model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    /**
     * Finds the Mensaje model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mensaje the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mensaje::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
