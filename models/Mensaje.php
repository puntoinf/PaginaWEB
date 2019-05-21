<?php

namespace app\models;

use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
* This is the model class for table "mensaje".
*
* @property int $id
* @property string $id_chat
* @property int $id_usuario_remitente
* @property int $id_usuario_destino
* @property string $texto
* @property string $visto
* @property string $fecha
*
* @property Usuario $usuarioRemitente
* @property Usuario $usuarioDestino
*/
class Mensaje extends \yii\db\ActiveRecord
{
  /**
  * @inheritdoc
  */
  public static function tableName()
  {
    return 'mensaje';
  }

  /**
  * @inheritdoc
  */
  public function rules()
     {
         return [
             [['id_usuario_remitente', 'id_usuario_destino', 'texto', 'visto'], 'required'],
             [['id_usuario_remitente', 'id_usuario_destino'], 'integer'],
             [['texto'], 'string'],
             [['fecha'], 'safe'],
             [['visto'], 'string', 'max' => 50],
             [['id_chat'], 'string', 'max' => 11],
             [['id_usuario_remitente'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario_remitente' => 'id']],
             [['id_usuario_destino'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario_destino' => 'id']],
         ];
     }

  /**
  * @inheritdoc
  */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'id_chat' => 'Id Chat',
      'id_usuario_remitente' => 'Id Usuario Remitente',
      'id_usuario_destino' => 'Id Usuario Destino',
      'texto' => 'Texto',
      'visto' => 'Visto',
      'fecha' => 'Fecha',
    ];
  }

  /**
  * @return \yii\db\ActiveQuery
  */
  public function getUsuarioRemitente()
  {
    return $this->hasOne(Usuario::className(), ['id' => 'id_usuario_remitente']);
  }

  /**
  * @return \yii\db\ActiveQuery
  */
  public function getUsuarioDestino()
  {
    return $this->hasOne(Usuario::className(), ['id' => 'id_usuario_destino']);
  }

  public function getMensajesChat($id_chat,$id_usuario){ //trae todos los mensajes de una conversacion
    // SELECT mensaje.*,
    // usuario.nombre as remitente_nombre, usuario.apellido as remitente_apellido, usuario.imagen as remitente_imagen,
    // usuario2.nombre as destinatario_nombre, usuario2.apellido as destinatario_apellido, usuario2.imagen as destinatario_imagen
    // FROM mensaje
    // LEFT JOIN usuario ON mensaje.id_usuario_remitente = usuario.id
    // LEFT JOIN usuario usuario2 ON mensaje.id_usuario_destino = usuario2.id
    // wHERE (id_usuario_remitente = 1 or id_usuario_destino = 1) and id_chat='1_3'
    // order by fecha desc LIMIT 0,2000
    $query = new Query;
    $query->select(['mensaje.*',
    'usuario.nombre as remitente_nombre', 'usuario.apellido as remitente_apellido', 'usuario.imagen as remitente_imagen',
    'usuario2.nombre as destinatario_nombre', 'usuario2.apellido as destinatario_apellido', 'usuario2.imagen as destinatario_imagen'])
    ->from('mensaje')
    ->join('left join','usuario','mensaje.id_usuario_remitente=usuario.id')
    ->join('left join','usuario usuario2','mensaje.id_usuario_destino=usuario2.id')
    ->where("id_usuario_remitente = $id_usuario or id_usuario_destino = $id_usuario") //cambiar 1 por id de usuario
    ->where("id_chat='$id_chat'")
    ->orderBy('fecha asc')
    ->limit(2000);

    // $dataProvider = new ActiveDataProvider([
    //   'query' => $query,
    // ]);

    // return $query->createCommand()->sql;
    return $query->all();

  }

  public function getUltimosMensajes($id_usuario){ // trae ultimo mensaje de cada conversacion del usuario actual
    // SELECT mensaje.*,
    //      usuario.nombre as remitente_nombre, usuario.apellido as remitente_apellido, usuario.imagen as remitente_imagen,
    //      usuario2.nombre as destinatario_nombre, usuario2.apellido as destinatario_apellido, usuario2.imagen as destinatario_imagen
    //      FROM mensaje
    //      LEFT JOIN usuario ON mensaje.id_usuario_remitente = usuario.id
    //      LEFT JOIN usuario usuario2 ON mensaje.id_usuario_destino = usuario2.id
    //      WHERE (id_usuario_remitente = 1 or id_usuario_destino = 1)
    //      HAVING fecha in (SELECT MAX(fecha) from mensaje GROUP BY id_chat)
    //      order by fecha desc LIMIT 0,2000
    $query = new Query;
    $query->select(['mensaje.*'])
    ->from('mensaje')
    ->join('left join','usuario','mensaje.id_usuario_remitente=usuario.id')
    ->join('left join','usuario usuario2','mensaje.id_usuario_destino=usuario2.id')
    ->where("id_usuario_remitente = $id_usuario or id_usuario_destino = $id_usuario") //cambiar 1 por id de usuario
    ->having("fecha in (SELECT MAX(fecha) from mensaje GROUP BY id_chat)")
    ->orderBy('fecha desc')
    ->limit(2000);
    // ->all();
    return $query->all();
  }
}
