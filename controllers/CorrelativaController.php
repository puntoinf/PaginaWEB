<?php

namespace app\controllers;

use Yii;
use app\models\Correlativa;
use app\models\CorrelativaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Materia;
use app\models\Carrera;

/**
 * CorrelativaController implements the CRUD actions for Correlativa model.
 */
class CorrelativaController extends Controller
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
  * Lista las carreras y las materias de esa carrera agrupadas por año.
  * @return mixed
  */
    public function actionVer($idCarrera){
        $consultaAnios= 'SELECT carrera.url as url, carrera.nombre as carrera, carrera.id as idCarrera, materia.anio_cursada FROM materia inner join carrera on materia.id_carrera=carrera.id WHERE materia.id_carrera='.$idCarrera.' GROUP by materia.anio_cursada';
        $anios = Yii::$app->db->createCommand($consultaAnios)->queryAll();
        $periodo= ['1' => 'Primer Cuatrimestre', '2' => 'Segundo Cuatrimestre'];
        if (count($anios) == 0){
            //si la consulta no tiene resultados
            return $this->renderAjax('ver', ['error'=>'La carrera no tiene materias registradas.']);
        }else{
            //los resultados se retornan en forma de ajax para usarlos en el modal.
           return $this->renderAjax('ver',['anios'=>$anios, 'periodo' => $periodo]);
        }
    }
    
    /**
     * Lists all Correlativa models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CorrelativaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Correlativa model.
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
     * Creates a new Correlativa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Correlativa();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Correlativa model.
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
     * Deletes an existing Correlativa model.
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
     * Finds the Correlativa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Correlativa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Correlativa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Lista los datos necesarios para los select's del formulario 
     */
    public function actionList($id){
        $countMaterias= Materia::find()
            ->where(['id_carrera' => $id])
            ->count();
        $materias= Materia::find()
            ->where(['id_carrera' => $id])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

        if ($countMaterias > 0){
            echo '<option value="">Selección...</option>';
            foreach ($materias as $unaMateria){
                echo '<option value="'.$unaMateria->id.'">'.$unaMateria->nombre.'</option>';
            }
        }else{
            echo '<option value="">No hay materias registradas</option>';
        }

    }

}
