<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_foro".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property Foro[] $foros
 */
class Estado_Foro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_foro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string', 'max' => 125],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForos()
    {
        return $this->hasMany(Foro::className(), ['id_estado' => 'id']);
    }
}
