<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property int $id
 * @property int $id_usuario
 * @property string $nombre
 * @property string $descripcion
 * @property string $lugar
 * @property string $desde
 * @property string $hasta
 * @property int $es_feriado
 *
 * @property Usuario $usuario
 */
class Evento extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'evento';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['id_usuario', 'nombre', 'descripcion', 'lugar', 'desde', 'hasta'], 'required'],
                [['id_usuario', 'es_feriado'], 'integer'],
                [['desde', 'hasta'], 'safe'],
                ['hasta', 'compare', 'compareAttribute' => 'desde', 'operator' => '>',],
                [['nombre'], 'string', 'max' => 125],
                [['descripcion'], 'string', 'max' => 255],
                [['lugar'], 'string', 'max' => 100],
                [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'nombre' => 'Titulo del evento',
            'descripcion' => 'Descripcion del evento',
            'lugar' => 'Lugar del evento',
            'desde' => 'Fecha y hora de comienzo',
            'hasta' => 'Fecha y hora de finalizacion',
            'es_feriado' => 'Es Feriado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario() {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario']);
    }


}
