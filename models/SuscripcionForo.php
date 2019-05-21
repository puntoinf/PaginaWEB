<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suscripcion_foro".
 *
 * @property int $id
 * @property int $id_foro
 * @property int $id_usuario
 *
 * @property Foro $foro
 * @property Usuario $usuario
 */
class SuscripcionForo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suscripcion_foro';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_foro', 'id_usuario'], 'required'],
            [['id_foro', 'id_usuario'], 'integer'],
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
            'id' => Yii::t('app', 'ID'),
            'id_foro' => Yii::t('app', 'Id Foro'),
            'id_usuario' => Yii::t('app', 'Id Usuario'),
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
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario']);
    }
    
    public function estoySuscripto($id_foro){
        $exito= SuscripcionForo::find()->where(["id_foro"=>$id_foro,"id_usuario"=>$_SESSION["__id"]])->one();
        return $exito;
    }
}
