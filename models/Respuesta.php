<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta".
 *
 * @property int $id
 * @property int $id_comentario
 * @property string $respuesta
 * @property string $fecha
 * @property int $id_usuario
 *
 * @property Comentario $comentario
 */
class Respuesta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'respuesta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_comentario', 'id_usuario'], 'required'],
            [['id_comentario', 'id_usuario'], 'integer'],
            [['respuesta'], 'string'],
            [['fecha'], 'safe'],
            [['id_comentario'], 'exist', 'skipOnError' => true, 'targetClass' => Comentario::className(), 'targetAttribute' => ['id_comentario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_comentario' => 'Id Comentario',
            'respuesta' => 'Respuesta',
            'fecha' => 'Fecha',
            'id_usuario' => 'Id Usuario',
        ];
    }
 /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return Usuario:: findOne($this->id_usuario);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentario()
    {
        return $this->hasOne(Comentario::className(), ['idComentario' => 'idComentario']);
    }
}
