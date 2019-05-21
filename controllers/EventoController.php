<?php

namespace app\controllers;

use Yii;
use app\models\Evento;
use app\models\EventoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * EventoController implements the CRUD actions for Evento model.
 */
class EventoController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Displays a single Evento model.
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
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Evento();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->id_usuario = $_SESSION['__id'];
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Evento model.
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
     * Deletes an existing Evento model.
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
     * Finds the Evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evento::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Vista diseñada para el usuario de Evento
     */
    public function actionVer($id){
        //utiliza modelo Evento para utilizar funciones de ActiveRecord y usar la Base de Datos
        $detallesEvento = Evento::find()->all();

        //retorna la vista en la pagina ver.php de la variable con los datos 
        return $this->render('ver', 
            [
            'detallesEvento'=>$detallesEvento,
            ]
        );
    }

    /**
     * Vista diseñada para el administrador de Evento
     */
    public function actionIndexadm()
    {
        //se llama a el model Evento, para obtener todos los datos de los eventos cargados en la BD
        $eventos = Evento::find()->all();
        $arreglo=[];

        //Se recorren los datos y se colocan los mismos en el modelo de FullCalendar para que se muestren en el calendario
        foreach ($eventos as $eve) {

            $evento = new \yii2fullcalendar\models\Event(); //se inicializa el obj. de fullCalendar
            $evento->id = $eve->id;
            $evento->title = $eve->nombre;

            $evento->start = date($eve->desde ,strtotime($eve->desde.' '.'02:00:00')); //se declara la instancia START para que figure en el calendario
            $evento->url = Url::to(['evento/view', 'id'=> $eve->id]); //se declara la instancia URL para que redireccione a ver y editar evento
            $evento->allDay=true;

            //Se verifica si es un feriado ya que los feriados apareceran de color Rojo mientras que los demas eventos seran de color verde
            if($eve->es_feriado==1)
            {
                $evento->color="red"; 
            }
            $evento->ranges=4;

              $arreglo[] = $evento;
        }

        return $this->render('indexadm', [
            'events' => $arreglo,
        ]);
    }
}
