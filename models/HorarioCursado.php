<?php

namespace app\models;
use \omnilight\datetime\DatePickerConfig;
use Yii;

/**
 * This is the model class for table "horario_cursado".
 *
 * @property int $id
 * @property string $hora_inicio
 * @property string $hora_fin
 * @property string $aula
 * @property int $id_materia
 * @property int $id_dia
 *
 * @property Materia $materia
 * @property DiaSemana $dia
 */
class Horariocursado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'horario_cursado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hora_inicio', 'hora_fin', 'aula', 'id_materia', 'id_dia'], 'required'],
            [['hora_inicio', 'hora_fin'], 'safe'],
            [['id_materia', 'id_dia'], 'integer'],
            [['aula'], 'string', 'max' => 80],
            [['id_materia'], 'exist', 'skipOnError' => true, 'targetClass' => Materia::className(), 'targetAttribute' => ['id_materia' => 'id']],
            [['id_dia'], 'exist', 'skipOnError' => true, 'targetClass' => DiaSemana::className(), 'targetAttribute' => ['id_dia' => 'id']],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hora_inicio' => 'Hora Inicio',
            'hora_fin' => 'Hora Fin',
            'aula' => 'Aula',
            'id_materia' => 'Nombre de la materia',
            'id_dia' => 'Dia de la semana',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMateria()
    {
        return $this->hasOne(Materia::className(), ['id' => 'id_materia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDia()
    {
        return $this->hasOne(DiaSemana::className(), ['id' => 'id_dia']);
    }
}
