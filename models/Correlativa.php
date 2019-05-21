<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "correlativa".
 *
 * @property int $id
 * @property int $materia_id
 * @property int $cursada_id
 * @property int $aprobada_id
 *
 * @property Materia $materia
 * @property Materia $cursada
 * @property Materia $aprobada
 */
class Correlativa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'correlativa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['materia_id'], 'required'],
            [['materia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materia::className(), 'targetAttribute' => ['materia_id' => 'id']],
            [['cursada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materia::className(), 'targetAttribute' => ['cursada_id' => 'id']],
            [['aprobada_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materia::className(), 'targetAttribute' => ['aprobada_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'materia_id' => 'Materia',
            'cursada_id' => 'Cursada',
            'aprobada_id' => 'Aprobada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMateria()
    {
        return $this->hasOne(Materia::className(), ['id' => 'materia_id']);
    }
    public static function getNombreMateria($id){
        $model = Materia::find()->where(["id" => $id])->one();
        if(!empty($model)){
            return $model->nombre;
        }
    
        return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCursada()
    {
        return $this->hasOne(Materia::className(), ['id' => 'cursada_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprobada()
    {
        return $this->hasOne(Materia::className(), ['id' => 'aprobada_id']);
    }

    //lista las materias cursadas y aprobadas que tiene la materia que entra por parametro.
    public function cursadas_aprobadas($materia_id){
        $sql='select c.materia_id as idMateria, m.nombre as Cursada, m1.nombre as Aprobada
        from correlativa c
        left join materia m
        on m.id=c.cursada_id
        left join materia m1
        on m1.id=c.aprobada_id
        where c.materia_id='.$materia_id;
        $cursadas_aprobadas= Yii::$app->db->createCommand($sql)->queryAll();
        return $cursadas_aprobadas;
    }

    //lista las materias donde la carrera, año y periodo sean los que entran por parametro.
    public function materias($idCarrera, $anio, $periodo){
        $sql= 'SELECT * from materia WHERE materia.id_carrera = '.$idCarrera.' and materia.periodo="'.$periodo.'" and materia.anio_cursada= '.$anio;
        $materias= Yii::$app->db->createCommand($sql)->queryAll();
        return $materias;
    }

    //seleeciona la carrera asociada a la materia.
    public function buscarCarrera($idMateria){
        $sql= 'select carrera.nombre as nombre, carrera.id as id FROM carrera INNER JOIN materia on materia.id_carrera=carrera.id
        WHERE materia.id='.$idMateria;
        $carrera= Yii::$app->db->createCommand($sql)->queryAll();
        return $carrera;
    }
}
