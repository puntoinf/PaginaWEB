<?php

namespace app\controllers;

use Yii;
use app\models\HorarioCursado;
use app\models\HorarioCursadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HorariocursadoController implements the CRUD actions for HorarioCursado model.
 */
class HorariocursadoController extends Controller
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
     * Lists all HorarioCursado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HorarioCursadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    function actionHorarios()
    {
        $this->layout = false;
        $req = Yii::$app->request;
        $idCarrera = $req->post('idCarrera');
        $periodo = $req->post('periodo');
        $idAnio = $req->post('idAnio');

        $horarios = Yii::$app->db->createCommand("select h.aula as aula, d.nombre as nombre_dia,h.hora_inicio,h.hora_fin,m.nombre from horario_cursado as h inner join dia_semana as d on d.id=h.id_dia inner join materia as m  on h.id_dia=d.id where m.anio_cursada='$idAnio' and m.id_carrera='$idCarrera' and m.periodo ='$periodo' and m.id=h.id_materia")->queryAll();

        return $this->render('horarios', ['horarios' => $horarios]);


    /*$horarios = HorarioCursado::find()
    ->innerJoinWith('materia','horario_cursado.id_materia=materia.id')
    ->where(['materia.id_carrera' =>$idCarrera])->where(['materia.anio_cursada' =>$idAnio])->where(['materia.periodo' =>$periodo])
    ->all();
    return $this->render('horarios',['horarios'=>$horarios]);*/
    }
    /**
     * Displays a single HorarioCursado model.
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
     * Creates a new HorarioCursado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HorarioCursado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing HorarioCursado model.
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
     * Deletes an existing HorarioCursado model.
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
     * Finds the HorarioCursado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HorarioCursado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HorarioCursado::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
