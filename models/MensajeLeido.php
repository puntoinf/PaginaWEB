<?php
namespace app\models;
use Yii;
/**
 * This is the model class for table "mensaje_leido".
 *
 * @property int $id
 * @property string $id_chat
 * @property int $id_usuario
 * @property int $mensajes
 *
 * @property Usuario $usuario
 */
class MensajeLeido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mensaje_leido';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_chat', 'id_usuario', 'mensajes'], 'required'],
            [['id_usuario', 'mensajes'], 'integer'],
            [['id_chat'], 'string', 'max' => 11],
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
            'id_chat' => Yii::t('app', 'Id Chat'),
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'mensajes' => Yii::t('app', 'Mensajes'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario']);
    }
}
