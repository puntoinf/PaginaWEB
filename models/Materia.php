<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materia".
 *
 * @property int $id
 * @property string $nombre
 * @property int $id_carrera
 * @property int $anio_cursada
 * @property string $periodo
 *
 * @property HorarioCursado[] $horarioCursados
 * @property Carrera $carrera
 */
class Materia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'id_carrera', 'anio_cursada', 'periodo'], 'required'],
            [['id_carrera'], 'integer'],
            [['anio_cursada'], 'integer'],
            [['anio_cursada'], 'string', 'max' => 2],
            [['nombre'], 'string', 'max' => 256],
            [['periodo'], 'string', 'max' => 125],
            [['id_carrera'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::className(), 'targetAttribute' => ['id_carrera' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Materia',
            'id_carrera' => 'Carrera',
            'anio_cursada' => 'Año Cursada',
            'periodo' => 'Periodo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarioCursados()
    {
        return $this->hasMany(HorarioCursado::className(), ['id_materia' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarrera()
    {
        return $this->hasOne(Carrera::className(), ['id' => 'id_carrera']);
    }
    public static function getNombreCarrera($id){
        $model = Carrera::find()->where(["id" => $id])->one();
        if(!empty($model)){
            return $model->nombre;
        }

        return null;
    }
    public function getAprobadas()
    {
        return $this->hasMany(Correlativa::className(), ['aprobada_id' => 'id']);
    }
    public function getCursadas()
    {
        return $this->hasMany(Correlativa::className(), ['cursada_id' => 'id']);
    }

}
