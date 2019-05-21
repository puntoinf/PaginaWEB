<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "propuesta".
 *
 * @property int $id
 * @property int $id_usuario
 * @property string $titulo
 * @property string $descripcion
 */
class Propuesta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propuesta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'required'],
            [['id', 'id_usuario'], 'integer'],
            [['descripcion'], 'string'],
            [['titulo'], 'string', 'max' => 125],
            [['titulo', 'descripcion'], 'required'], 
            [['id'], 'unique'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'titulo' => Yii::t('app', 'Asunto'),
            'descripcion' => Yii::t('app', 'Mensaje'),
        ];
    }
}
