<?php

namespace app\controllers;

use Yii;
use app\models\Propuesta;
use app\models\PropuestaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Usuario;

/**
 * PropuestaController implements the CRUD actions for Propuesta model.
 */
class PropuestaController extends Controller {

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
     * Lists all Propuesta models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PropuestaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Propuesta model.
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
     * Creates a new Propuesta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Propuesta();


        if ($model->load(Yii::$app->request->post())) {
            $destinatarios = [];
            $datos = '';

            $sqlAdmin = Usuario:: findBySql('select email from usuario where idrol<5')->all();
            $sqlUsuario = Usuario:: findBySql('select email from usuario where id= ' . $_SESSION["__id"])->all();
            $sqlDatos = Usuario:: findBySql('select nombre,apellido from usuario where id= ' . $_SESSION["__id"])->all();

            foreach ($sqlUsuario as $value) {
                $destinatarios[] = $value['email'];
            }
            foreach ($sqlAdmin as $value) {
                $destinatarios[] = $value['email'];
            }
            foreach ($sqlDatos as $value) {
                $datos = $value['nombre'] . ' ' . $value['apellido'];
            }
            $destinatarios[] = "nico.anabalon7@gmail.com";


            $model->id_usuario = $_SESSION["__id"];

            foreach ($destinatarios as $email) {

                Yii::$app->mailer->compose()
                        ->setFrom('cefaifacultad@gmail.com')//Remitente
                        ->setTo("$email")
                        ->setSubject($model->titulo) 
                        ->setSubject('Nueva Propuesta:' . $model->titulo)
                        ->setTextBody('Contenido en texto plano')
                        ->setHtmlBody('<div>' .
                                '<h2>' . $model->titulo . '</h2>' .
                                '<p style="font-size:15px">' . $model->descripcion . '</p>' .
                                '<p style="font-size:11px">--Usuario:' . $datos . '--</p>' .
                                '</div>'
                        )
                        ->send();
            }

            $model->save();
            return $this->redirect('index.php');
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Propuesta model.
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
     * Deletes an existing Propuesta model.
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
     * Finds the Propuesta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Propuesta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Propuesta::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
