<?php

namespace app\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $legajo
 * @property string $email
 * @property string $password
 * @property string $imagen
 * @property string $authKey
 * @property int $idrol
 * @property int $id_estado
 *
 * @property Archivo[] $archivos
 * @property Comentario[] $comentarios
 * @property Evento[] $eventos
 * @property Foro[] $foros
 * @property Inventario[] $inventarios
 * @property Mensaje[] $mensajes
 * @property Mensaje[] $mensajes0
 * @property Noticia[] $noticias
 * @property Propuesta[] $propuestas
 * @property RespuestaForo[] $respuestaForos
 * @property SuscripcionForo[] $suscripcionForos
 * @property SuscripcionNoticia[] $suscripcionNoticias
 * @property Estado $estado
 * @property Rol $rol
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['idrol', 'id_estado'], 'required'],
                [['idrol', 'id_estado'], 'integer'],
                [['nombre', 'apellido', 'email'], 'string', 'max' => 100],
                [['legajo'], 'string', 'max' => 11],
                [['password'], 'string', 'max' => 125],
                [['imagen'], 'string', 'max' => 255],
                [['authKey'], 'string', 'max' => 250],
                [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['id_estado' => 'id']],
                [['idrol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['idrol' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellido' => Yii::t('app', 'Apellido'),
            'legajo' => Yii::t('app', 'Legajo'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'imagen' => Yii::t('app', 'Imagen'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'idrol' => Yii::t('app', 'Idrol'),
            'id_estado' => Yii::t('app', 'Id Estado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArchivos() {
        return $this->hasMany(Archivo::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios() {
        return $this->hasMany(Comentario::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos() {
        return $this->hasMany(Evento::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForos() {
        return $this->hasMany(Foro::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios() {
        return $this->hasMany(Inventario::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensajes() {
        return $this->hasMany(Mensaje::className(), ['id_usuario_remitente' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensajes0() {
        return $this->hasMany(Mensaje::className(), ['id_usuario_destino' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticias() {
        return $this->hasMany(Noticia::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropuestas() {
        return $this->hasMany(Propuesta::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRespuestaForos() {
        return $this->hasMany(RespuestaForo::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuscripcionForos() {
        return SuscripcionForo::find()->where(["id_usuario" => $this->id])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuscripcionNoticias() {
        return $this->hasMany(SuscripcionNoticia::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado() {
        return $this->hasOne(Estado::className(), ['id' => 'id_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRol() {
        return Rol::findOne($this->idrol);
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException();
    }

    public static function findByUsername($email) {
        return self::findOne(["email" => $email]);
    }

    public function validatePassword($password) {
        return $this->password === $password;
    }

    public function getUsuarios($nombre, $not_in) {
        $query = new Query;
        $query->select('id,nombre,apellido,imagen')
                ->from('usuario')
                ->where("id not in ($not_in)")
                ->andFilterWhere([
                    'or',
                        ['like', 'nombre', $nombre],
                        ['like', 'apellido', $nombre],
                ])
                ->orderBy('nombre')
                ->limit(10);
        // return $query->createCommand()->getRawSql();
        return $query->all();
    }

}
