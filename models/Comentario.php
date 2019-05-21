<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $id
 * @property int $id_noticia
 * @property int $id_usuario
 * @property string $fecha
 * @property string $comentario
 *
 * @property Noticia $noticia
 * @property Usuario $usuario
 * @property Respuesta[] $respuestas
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_noticia', 'id_usuario', 'comentario'], 'required'],
            [['id_noticia', 'id_usuario'], 'integer'],
            [['fecha'], 'safe'],
            [['comentario'], 'string'],
            [['id_noticia'], 'exist', 'skipOnError' => true, 'targetClass' => Noticia::className(), 'targetAttribute' => ['id_noticia' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_noticia' => 'Id Noticia',
            'id_usuario' => 'Id Usuario',
            'fecha' => 'Fecha',
            'comentario' => 'Comentario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticia()
    {
        return $this->hasOne(Noticia::className(), ['id' => 'id_noticia']);
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
    public function getRespuestas()
    {
        return Respuesta:: find()->where("id=".$this->id)->all();
    }
}
