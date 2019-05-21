<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noticia".
 *
 * @property int $id
 * @property int $id_usuario
 * @property int $id_estado
 * @property string $titulo
 * @property string $texto
 * @property string $fecha
 * @property string $copete
 * @property string $imagen
 * @property int $importante
 *
 * @property Comentario[] $comentarios
 * @property Usuario $usuario
 * @property Estado $estado
 * @property SuscripcionNoticia[] $suscripcionNoticias
 */
class Noticia extends \yii\db\ActiveRecord
{
	
	public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noticia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_estado', 'titulo', 'texto', 'copete'], 'required'],
            [['id_usuario', 'id_estado', 'importante'], 'integer'],
            [['texto'], 'string'],
            [['fecha'], 'safe'],
            [['titulo', 'copete','alt'], 'string', 'max' => 150],
            [['imagen'], 'string', 'max' => 256],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['id_estado' => 'id']],
			['file', 'file',
                'skipOnEmpty' => true,
                'uploadRequired' => 'No has seleccionado ningún archivo', //Error
                'maxSize' => 1024 * 1024 * 1, //1 MB
                'tooBig' => 'El tamaño máximo permitido es 1MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'png jpg',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
                'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuario',
            'id_estado' => 'Id Estado',
            'titulo' => 'Titulo',
            'texto' => 'Texto',
            'fecha' => 'Fecha',
            'copete' => 'Copete',
            'imagen' => 'Imagen',
            'alt' => 'Alt',
            'importante' => 'Importante',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return Comentario:: find()->where("id_noticia =".$this->id)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioLogueado()
    {   
        if (isset($_SESSION["__id"])) {
            # code...
       
        return Usuario:: findOne($_SESSION["__id"]);

         }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estado::className(), ['id' => 'id_estado']);
    }

    
	
	public function crearNoticia(){
		
		if ($this->file) {
			$this->save(); 
            $insert_id = Yii::$app->db->getLastInsertID();     
            $file = $this->file;
            $guardarEn = 'archivos/noticias/' . $insert_id . '.' . $file->extension;
            $file->saveAs($guardarEn);
			$this->imagen=$guardarEn;
			$this->save(false);
        
        }

	}

    public function actualizarNoticia(){
        
        if (($this->file) or ($this->id_estado) or ($this->titulo) or ($this->copete) or ($this->texto) or ($this->importante) or ($this->alt)) {
            $this->save();
            if ($this->file) {        
            $file = $this->file;
            $guardarEn = 'archivos/noticias/' . $this->id . '.' . $file->extension;
            $file->saveAs($guardarEn);
            $this->imagen=$guardarEn;
            $this->save(false);
        }
        }
        
    }
}
