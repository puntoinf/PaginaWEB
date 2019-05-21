<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suscripcion_noticia".
 *
 * @property int $id
 * @property int $id_usuario
 */
class SuscripcionNoticia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suscripcion_noticia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario'], 'required'],
            [['id', 'id_usuario'], 'integer'],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailUsuarios()
    {
        return Usuario:: findBySql('select email from usuario inner join suscripcion_noticia on usuario.id = suscripcion_noticia.id_usuario')->all();
    }
}
