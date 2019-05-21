<?php

namespace app\controllers;

use Yii;
use app\models\SuscripcionNoticia;
use app\models\SuscripcionNoticiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuscripcionNoticiaController implements the CRUD actions for SuscripcionNoticia model.
 */
class SuscripcionNoticiaController extends Controller
{
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
     * Lists all SuscripcionNoticia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuscripcionNoticiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SuscripcionNoticia model.
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
     * Creates a new SuscripcionNoticia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SuscripcionNoticia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SuscripcionNoticia model.
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
     * Deletes an existing SuscripcionNoticia model.
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


    public function actionSuscribir() {
        if (isset($_GET["idUsuario"])) {
        $model = new SuscripcionNoticia();
        $model->id_usuario=$_GET["idUsuario"];

        Yii::$app->mailer->compose()
            ->setFrom('cefaifacultad@gmail.com')//Remitente
            ->setTo($_GET['email'])
            //->setTo(['nico.anabalon7@gmail.com','shakociclac@gmail.com'])//destinatarios
            ->setSubject('Suscripcion a las noticias')
            ->setTextBody('Suscripcion noticia')
            ->setHtmlBody('<h1>Gracias por suscribirse</h1>')
            ->send();

        $model->save();
        }
        $this->redirect("index.php?r=noticia/noticias");
    }

    public function actionCancelar()
    {
        if (isset($_GET['id'])) {
            # code...
        
        $this->findModel($_GET['id'])->delete();
        Yii::$app->mailer->compose()
            ->setFrom('cefaifacultad@gmail.com')//Remitente
            ->setTo($_GET['email'])
            //->setTo(['nico.anabalon7@gmail.com','shakociclac@gmail.com'])//destinatarios
            ->setSubject('Cancelacion de Suscripcion a noticias')
            ->setTextBody('Cancelacion De Suscripcion a noticas')
            ->setHtmlBody('<h1>La cancelacion de la suscripcion a noticias se realizo correctamente</h1>')
            ->send();
}
      $this->redirect("index.php?r=noticia/noticias");
    }

    

    /**
     * Finds the SuscripcionNoticia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SuscripcionNoticia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SuscripcionNoticia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
