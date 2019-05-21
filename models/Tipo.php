<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo".
 *
 * @property int $id
 * @property string $descripcion
 *
 * @property Estado[] $estados
 * @property Foro[] $foros
 */
class Tipo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo';
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
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstados()
    {
        return $this->hasMany(Estado::className(), ['id_tipo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForos()
    {
        return $this->hasMany(Foro::className(), ['id_tipo' => 'id']);
    }
}
