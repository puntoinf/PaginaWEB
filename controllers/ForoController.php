<?php

namespace app\controllers;

use Yii;
use app\models\Foro;
use app\models\foroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Respuesta_Foro;
use app\models\Usuario;
use app\models\SuscripcionForo;

/**
 * ForoController implements the CRUD actions for Foro model.
 */
class ForoController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all Foro models.
     * @return mixed
     */
    public function actionIndexadmin() {
        $searchModel = new foroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexadmin', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCambiarestado() {
        $idForo = $_POST["idForo"];
        $foro = Foro::findOne($idForo);
        $foro->id_estado = 2;
        return $foro->save();
    }

    public function actionIndex() {

        $foros = Foro::find()->orderBy(["fecha" => SORT_DESC])->limit(5)->all();
        return $this->render('index', ['g2Foros' => $foros]);
    }

    /**
     * Displays a single Foro model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Foro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Foro();

        if ($model->load(Yii::$app->request->post())) {
            $model->id_usuario=$_SESSION["__id"];
            $model->id_estado=1;
            $model->id_categoria=$_POST["Categoria"];
            $model->fecha= date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Foro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->id_categoria=$_POST["Categoria"];
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Foro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['indexadmin']);
    }

    /**
     * Finds the Foro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Foro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Foro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionVer($id) {
        $foro = Foro::findOne($id);
        $respuestas = $foro->getRespuestaForos();

        return $this->render('ver', ['g2Foro' => $foro, 'g2Respuesta' => $respuestas]);
    }

    public function actionResponder() {

        $data = json_decode($_POST['datos'], true);
        $usuario = Usuario::findOne($_SESSION["__id"]);
        $respuesta = new Respuesta_Foro();
        $respuesta->id_foro = $data["id_foro"];
        $respuesta->fecha = date("Y-m-d H:i:s");
        $respuesta->texto = $data['respuesta'];
        $respuesta->id_usuario = $usuario->id;
        $respuesta->save();
        $exito = ["nombre" => ($usuario->nombre . " " . $usuario->apellido), "imagen" => $usuario->imagen, "respuesta" => $data['respuesta'], "idU" => $usuario->id];
        return json_encode($exito);
    }
    
    
    public function actionEnviaremails(){
        $data = json_decode($_POST['datos'], true);
        $suscripciones = SuscripcionForo::find()->where(["id_foro" => $data["id_foro"]])->all();
        $foro = Foro::findOne($data["id_foro"]);
        $usuario = Usuario::findOne($_SESSION["__id"]);
        foreach ($suscripciones as $unaSuscripcion) {
            $unUsuarioSuscripto = Usuario::findOne($unaSuscripcion->id_usuario);
            Yii::$app->mail->compose()
                    ->setFrom('cefaiwebprueba@gmail.com')
                    ->setTo($unUsuarioSuscripto->email)
                    ->setSubject('CEFAIWEB: An respondido en el foro')
                    ->setHTMLBody('<h2>Foro: ' . $foro->titulo . '</h2><p>Usuario: '.$usuario->nombre.' '.$usuario->apellido.'</p><br/><p>Respuesta: ' . $data['respuesta'] . '</p><br/><a href="http://localhost/MASTER/cefaiweb/web/index.php?r=foro%2Fver&id=' . $foro->id . '">Ver en su contexto</a>')
                    ->send();
        }
    }

    public function actionCrear() {
        $suscribirse=new SuscripcionForo();
        $data = json_decode($_POST['datos'], true);
        $usuario = Usuario::findOne($_SESSION["__id"]);
        $foro = new Foro();
        $foro->id_estado = 1;
        $foro->fecha = date("Y-m-d H:i:s");
        $foro->texto = $data['texto'];
        $foro->titulo = $data['titulo'];
        $foro->id_categoria = $data['categoria'];
        $foro->id_usuario = $usuario->id;
        $foro->save();
        $suscribirse->id_foro=$foro->getPrimaryKey();
        $suscribirse->id_usuario=$usuario->id;
        $suscribirse->save();
        $exito = ["titulo" => $data['titulo'], "nombre" => ($usuario->nombre . " " . $usuario->apellido), "imagen" => $usuario->imagen, "texto" => $data['texto'], "fecha" => date("d-m-Y"), "id" => $foro->getPrimaryKey(), "categoria" => $foro->getCategoria()->descripcion];
        return json_encode($exito);
    }

    public function actionCargar() {

        $data = json_decode($_POST['datos'], true);
        $foros = Foro::find()->where("id>" . $data["ultimo"])->limit(5)->all();
        $ultimoForo = Foro::find()->where("id = (SELECT MAX(id) from foro)")->one();
        $masForos = "";
        foreach ($foros as $g2UnForo) {
            if ($data["ultimo"] != $g2UnForo->id) {

                $masForos .= '<div class=" form-horizontal col-md-10 col-md-offset-1">
        <div class="form-group col-md-2 vertical-center" style="border-width: 1px; border-style: solid; border-color: lightgrey;border-radius: 3px 0px 0px 3px; background: #f1f3f6;min-height: 250px" align="center">
            <div class="col-md-12" style="display:block;">
                <img width="100px" src="' . $g2UnForo->getUsuario()->imagen . '">
                <h5>' . $g2UnForo->getUsuario()->nombre . ' ' . $g2UnForo->getUsuario()->apellido . '</h5>
                <h5>' . (substr($g2UnForo->fecha, 0, 10)) . '</h5>
            </div>
        </div>
        <div class="form-group col-md-10" style="border-width:1px 1px 1px 0px; border-style: solid; border-color: lightgrey;border-radius: 0px 3px 3px 0px;min-height: 250px">
            <h4 class="col-md-offset-1">' . $g2UnForo->titulo . '</h4>
            <hr style="width:90%;margin-right:25px;">
            <p class="col-md-offset-1">' . $g2UnForo->texto . '</p>
            <div class="form-group col-md-offset-1 acc" style="left:120px;bottom: 8px">
                <b>Categoria:</b> <i>' . $g2UnForo->getCategoria()->descripcion . '</i>
            </div>
            <div class="form-group col-md-12 acc" align="right">
                <a class="btn btn-info btn-md" href="index.php?r=foro%2Fver&id=' . $g2UnForo->id . '">Acceder</a>
            </div>
        </div>

    </div>';
            }
        }
        return json_encode(["foros" => $masForos . " ", "ultimo" => $g2UnForo->id, "ultimoTabla" => $ultimoForo->id]);
    }

    public function actionBuscar() {
        $data = json_decode($_POST['datos'], true);
        $foros = Foro::find()->where("titulo LIKE '" . $data["titulo"] . "%'")->all();
        $masForos = "";
        foreach ($foros as $g2UnForo) {
            $masForos .= '<div class=" form-horizontal col-md-10 col-md-offset-1">
        <div class="form-group col-md-2 vertical-center" style="border-width: 1px; border-style: solid; border-color: lightgrey;border-radius: 3px 0px 0px 3px; background: #f1f3f6;min-height: 250px" align="center">
            <div class="col-md-12" style="display:block;">
                <img width="100px" src="' . $g2UnForo->getUsuario()->imagen . '">
                <h5>' . $g2UnForo->getUsuario()->nombre . ' ' . $g2UnForo->getUsuario()->apellido . '</h5>
                <h5>' . (substr($g2UnForo->fecha, 0, 10)) . '</h5>
            </div>
        </div>
        <div class="form-group col-md-10" style="border-width:1px 1px 1px 0px; border-style: solid; border-color: lightgrey;border-radius: 0px 3px 3px 0px;min-height: 250px">
            <h4 class="col-md-offset-1">' . $g2UnForo->titulo . '</h4>
            <hr style="width:90%;margin-right:25px;">
            <p class="col-md-offset-1">' . $g2UnForo->texto . '</p>
            <div class="form-group col-md-offset-1 acc" style="left:120px;bottom: 8px">
                <b>Categoria:</b> <i>' . $g2UnForo->getCategoria()->descripcion . '</i>
            </div>
            <div class="form-group col-md-12 acc" align="right">
                <a class="btn btn-info btn-md" href="index.php?r=foro%2Fver&id=' . $g2UnForo->id . '">Acceder</a>
            </div>
        </div>

    </div>';
        }
        return $masForos;
    }

    public function actionSuscribirse() {
        $data = json_decode($_POST['datos'], true);
        $suscribirse = new SuscripcionForo();
        $estoy = $suscribirse->estoySuscripto($data['id_foro']);
        if ($estoy) {
            $estoy->delete();
            return "desuscripto";
        } else {
            $suscribirse->id_foro = $data['id_foro'];
            $suscribirse->id_usuario = $_SESSION["__id"];
            $suscribirse->save();
        }
    }

}
