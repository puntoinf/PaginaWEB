<?php

namespace app\controllers;

use Yii;
use app\models\Materia;
use app\models\MateriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Correlativa;

/**
 * MateriaController implements the CRUD actions for Materia model.
 */
class MateriaController extends Controller
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
     * Lists all Materia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id_carrera = Yii::$app->request->get('id_carrera');
        $searchModel = new MateriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id_carrera);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Materia model.
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
     * Creates a new Materia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Materia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Materia model.
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
     * Deletes an existing Materia model.
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
     * Finds the Materia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Materia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Materia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    function actionListaranios()
    {
        $this->layout = false;
        $req = Yii::$app->request;
        $id = $req->post('id');


    /*return $this->render('listarxcarrera', ['materias'=>$materias

  ]);*/ $searchModel = new MateriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_carrera' => $id])->groupBy(['anio_cursada']);//Poner condicion al dataprovider para que traiga solo el id solicitado
        $dataProvider->sort = false;
        return $this->render('listaranios', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'idCarrera' => $id
        ]);

    }
    function actionMostrarhorarios()
    {
        $this->layout = false;
        $req = Yii::$app->request;
        $idCarrera = $req->post('idCarrera');
        $idAnio = $req->post('idAnio');
        $idCuatrimestre = $req->post('periodo');
        $searchModel = new MateriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['id_carrera' => $idCarrera])->andWhere(['periodo' => $idCuatrimestre])->andWhere(['anio_cursada' => $idAnio]);
        $dataProvider->sort = false;
        return $this->render('mostrarHorarios', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    function actionListarcuatrimestres()
    {

        $req = Yii::$app->request;
        $idCarrera = $req->post('idCarrera');
        $idAnio = $req->post('idAnio');
        $this->layout = false;


  /*return $this->render('listarxcarrera', ['materias'=>$materias]);*/ 
        $searchModel = new MateriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['anio_cursada' => $idAnio])->where(['id_carrera' => $idCarrera])->groupBy(['periodo']);//Poner condicion al dataprovider para que traiga solo el id solicitado
        $dataProvider->sort = false;
        return $this->render('listarcuatrimestres', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 'idCarrera' => $idCarrera, 'idAnio' => $idAnio,
        ]);

    }
}
