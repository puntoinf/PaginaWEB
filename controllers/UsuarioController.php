<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\UsuarioSearch;
use app\models\FormUpload;
use app\models\FormActualizardatos;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller {

    private $id_usuario_actual;

    /**
     * @inheritdoc
     */
    public function init() {
        $this->id_usuario_actual = (!empty($_SESSION["__id"])) ? $_SESSION["__id"] : "0";
    }

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
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
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
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Usuario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionFormactualizardatos() {
        $model = new FormActualizardatos();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {

                // form inputs are valid, do something here

                return;
            }
        }
        return $this->render('FormActualizardatos', [
                    'model' => $model,
        ]);
    }

    public function actionPerfil($id = "") {
        if (empty($id)) {
            if (!empty($_SESSION["__id"])) {
                $id = $_SESSION["__id"];
            } else {
                Yii::$app->session->set("error", "No tienes permitido acceder a esta pagina");
                return $this->redirect("index.php?r=site/error");
            }
        }
        $usuario = Usuario::findOne($id);
        if (empty($usuario)) {
            Yii::$app->session->set("error", "No existe tal usuario");
            return $this->redirect("index.php?r=site/error");
        } else {
            $msg = "Hola";
            $model = new FormActualizardatos();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->file = UploadedFile::getInstance($model, 'file');
                $msg = (($model->actualizarDatos())?"Si":"No")." Nombre: ".$model->nombre." Apellido: ".$model->apellido." Password: ".$model->password;
            }
            return $this->render('perfil', ['model' => $model, 'usuario' => $usuario, 'model' => $model, 'msg' => $msg]);
        }
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionActualizardatos() {
        
    }

    public function actionBuscar() {
        // $not_in=$_SESSION['id__'];
        $not_in = $_POST['id_list'];
        $id_usuario = $this->id_usuario_actual; //cambiar por id usuario session
        $not_in .= $id_usuario;
        $nombre = $_POST['nombre'];
        $objUsuario = new Usuario();
        $usuarios = $objUsuario->getUsuarios($nombre, $not_in);

        return json_encode($usuarios);
    }

}
