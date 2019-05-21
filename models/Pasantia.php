<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasantia".
 *
 * @property int $id
 * @property string $titulo
 * @property string $tarea
 * @property string $requisito
 * @property string $ubicacion
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $fecha_limite
 * @property int $id_estado
 *
 * @property Estado $estado
 */
class Pasantia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pasantia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'tarea', 'ubicacion', 'fecha_inicio', 'fecha_fin', 'id_estado'], 'required'],
            [['requisito'], 'string'],
            [['fecha_inicio', 'fecha_fin', 'fecha_limite'], 'safe'],
            [['id_estado'], 'integer'],
            [['titulo', 'tarea', 'ubicacion'], 'string', 'max' => 255],
            [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['id_estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'tarea' => 'Tarea',
            'requisito' => 'Descripción',
            'ubicacion' => 'Ubicacion',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'fecha_limite' => 'Fecha Limite',
            'id_estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['id' => 'id_estado']);
    }
    public function last3(){
 
        $sql= 'select *, DATE_FORMAT(fecha_limite, "%d/%m/%Y") as fechalimite from pasantia order by id desc limit 3';
 
        $pasantias= Yii::$app->db->createCommand($sql)->queryAll();
 
        return $pasantias;
 
    }
 
}
