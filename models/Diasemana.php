<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dia_semana".
 *
 * @property int $id
 * @property string $nombre
 *
 * @property HorarioCursado[] $horarioCursados
 */
class Diasemana extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dia_semana';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 125],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHorarioCursados()
    {
        return $this->hasMany(HorarioCursado::className(), ['id_dia' => 'id']);
    }
}
