<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado".
 *
 * @property int $id
 * @property int $id_tipo
 * @property string $descripcion
 *
 * @property Tipo $tipo
 * @property Noticia[] $noticias
 * @property Pasantia[] $pasantias
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_tipo'], 'integer'],
            [['descripcion'], 'string', 'max' => 125],
            [['id_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::className(), 'targetAttribute' => ['id_tipo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_tipo' => Yii::t('app', 'Id Tipo'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(Tipo::className(), ['id' => 'id_tipo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias()
    {
        return $this->hasMany(Noticia::className(), ['id_estado' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasantias()
    {
        return $this->hasMany(Pasantia::className(), ['id_estado' => 'id']);
    }
}
