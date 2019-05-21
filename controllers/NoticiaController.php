<?php

namespace app\controllers;

use Yii;
use app\models\Noticia;
use app\models\Usuario;
use app\models\SuscripcionNoticia;
use app\models\noticiaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FormUpload;
use yii\data\Pagination;
use yii\web\UploadedFile;

/**
 * NoticiaController implements the CRUD actions for Noticia model.
 */
class NoticiaController extends Controller {

    /**
     * {@inheritdoc}
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
     * Lists all Noticia models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new noticiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInicio() {
        $searchModel = new NoticiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $noticias = Noticia::find()->where(['id_estado' => 6])->all();

        $noticiasImp = noticia::find()->where(['importante' => 1])
                ->where(['id_estado' => 6])
                ->orderBy('fecha desc')
                ->limit(5) //limite de noticias en el slider
                ->all();

        return $this->render('inicio', ['noticias' => $noticias,
                    'noticiasImp' => $noticiasImp,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,]);
    }

    public function actionNoticias() {
        $searchModel = new NoticiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $query = Noticia::find()->where(['id_estado' => 6])->orderBy('fecha desc');
        $ultimasNoticias = Noticia:: findBySql('SELECT * FROM noticia where id_estado=6 ORDER BY id DESC LIMIT 0,5')->all();

        if (isset($_SESSION["__id"])) {
          $usuarioLogueado = Usuario:: findOne($_SESSION["__id"]);
          $usuario = SuscripcionNoticia:: find()->where('id_usuario= '.$_SESSION['__id'])->One(); 
        }
        else{
            $usuarioLogueado= null;
            $usuario = null;
        }
         
        
        	$countQuery = clone $query;
			$pages = new Pagination(['totalCount' => $countQuery->count() ,'pageSize' => 3]); //page size es la cantidad de noticias por pag
			$noticias = $query->offset($pages->offset)
			->limit($pages->limit)
			->all();
			
        return $this->render('noticias', ['noticias' => $noticias,
                    'pages' => $pages,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'ultimasNoticias'=>$ultimasNoticias,
                    'usuarioLogueado'=>$usuarioLogueado,
                    'usuarioSus'=>$usuario]);
    }

    /**
     * Displays a single Noticia model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionVer($id) {
        $noticia = Noticia::findOne($id);
        $coment = $noticia->getComentarios();
        $comentarios = [];
        foreach ($coment as $comentario) {
            $respuestas = $comentario->getRespuestas();
            $comentarios[] = [$comentario, $respuestas];
        }

        return $this->render('ver', ['noticia' => $noticia, 'comentarios' => $comentarios]);
    }

    /**
     * Creates a new Noticia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Noticia();
        $suscripcion = new SuscripcionNoticia();
        $emails = $suscripcion->emailUsuarios;
        if ($model->load(Yii::$app->request->post())) {
            $model->id_usuario = $_SESSION["__id"];
            $model->id_estado = 7;
            $model->fecha = date("Y-m-d H:i:s");
            $model->file = UploadedFile::getInstance($model, 'file');
            foreach ($emails as $usuario) {
                Yii::$app->mailer->compose()
                        ->setFrom('cefaifacultad@gmail.com')//Remitente
                        ->setTo("$usuario->email")
                        ->setSubject($model->titulo)
                        ->setTextBody('Noticia nueva')
                        ->setHtmlBody('<h3>' . $model->copete . '</h3>')
                        ->send();
            }

            $model->crearNoticia();
            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Noticia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $suscripcion = new SuscripcionNoticia();
        $emails = $suscripcion->emailUsuarios;

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');

            foreach ($emails as $usuario) {

                Yii::$app->mailer->compose()
                        ->setFrom('cefaifacultad@gmail.com')//Remitente
                        ->setTo("$usuario->email")
                        ->setSubject($model->titulo)
                        ->setTextBody('Noticia editada')
                        ->setHtmlBody('<h2>' . $model->titulo . '</h2><hr><h3>' . $model->copete . '</h3>')
                        ->send();
            }



            $model->actualizarNoticia();


            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Noticia model.
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
     * Finds the Noticia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Noticia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Noticia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
