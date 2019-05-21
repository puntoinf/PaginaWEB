<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "foro".
 *
 * @property int $id
 * @property int $id_usuario
 * @property int $id_estado
 * @property int $id_categoria
 * @property string $titulo
 * @property string $texto
 * @property string $fecha
 *
 * @property Usuario $usuario
 * @property EstadoForo $estado
 * @property CategoriaForo $categoria
 * @property RespuestaForo[] $respuestaForos
 */
class Foro extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'foro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_estado', 'id_categoria'], 'required'],
            [['id_usuario', 'id_estado', 'id_categoria'], 'integer'],
            [['texto'], 'string'],
            [['fecha'], 'safe'],
            [['titulo'], 'string', 'max' => 125],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['id_estado' => 'id']],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria_Foro::className(), 'targetAttribute' => ['id_categoria' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Usuario',
            'id_estado' => 'Estado',
            'id_categoria' => 'Categoria',
            'titulo' => 'Titulo',
            'texto' => 'Texto',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return Usuario::findOne($this->id_usuario);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return Estado::findOne($this->id_estado);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return Categoria_Foro::findOne($this->id_categoria);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestaForos()
    {
        return Respuesta_Foro::find()->where(["id_foro"=> $this->id])->all();
    }
}
