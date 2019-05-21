<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta_foro".
 *
 * @property int $id
 * @property int $id_foro
 * @property int $id_usuario
 * @property string $texto
 * @property string $fecha
 *
 * @property Foro $foro
 * @property Usuario $usuario
 */
class Respuesta_Foro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'respuesta_foro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_foro', 'id_usuario'], 'required'],
            [['id_foro', 'id_usuario'], 'integer'],
            [['texto'], 'string'],
            [['fecha'], 'safe'],
            [['id_foro'], 'exist', 'skipOnError' => true, 'targetClass' => Foro::className(), 'targetAttribute' => ['id_foro' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_foro' => 'Id Foro',
            'id_usuario' => 'Id Usuario',
            'texto' => 'Texto',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForo()
    {
        return $this->hasOne(Foro::className(), ['id' => 'id_foro']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return Usuario::findOne($this->id_usuario);
    }
}
