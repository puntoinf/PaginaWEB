<?php

namespace app\models;

use yii\base\model;

class FormActualizardatos extends model {

    public $file;
    public $nombre;
    public $apellido;
    public $password;
    public $password_actual;
    public $password_repeat;

    public function rules() {
        return [
                [['nombre', 'apellido'], 'string', 'max' => 100],
                [['password'], 'string', 'max' => 125],
                ['password_actual', 'compare', 'compareValue' => Usuario::findOne($_SESSION["__id"])->password, 'message' => "La contraseña ingresada no coincide con la actual"],
                ['file', 'file',
                'skipOnEmpty' => true,
                'uploadRequired' => 'No has seleccionado ningún archivo', //Error
                'maxSize' => 1024 * 1024 * 1, //1 MB
                'tooBig' => 'El tamaño máximo permitido es 1MB', //Error
                'minSize' => 10, //10 Bytes
                'tooSmall' => 'El tamaño mínimo permitido son 10 BYTES', //Error
                'extensions' => 'png',
                'wrongExtension' => 'El archivo {file} no contiene una extensión permitida {extensions}', //Error
                'tooMany' => 'El máximo de archivos permitidos son {limit}', //Error
            ],
        ];
    }

    public function actualizarDatos() {
        $exito=false;
        $usuario= Usuario::findOne($_SESSION["__id"]);
        if ($this->file) {
            $file = $this->file;
            $guardarEn = 'archivos/usuario/' . $usuario->id . '.' . $file->extension;
            $file->saveAs($guardarEn);
            $usuario->imagen=$guardarEn;
            $exito=true;
        }
        $usuario->nombre=(!empty($this->nombre))?$this->nombre:$usuario->nombre;
        $usuario->apellido=(!empty($this->apellido))?$this->apellido:$usuario->apellido;
        $usuario->password=(!empty($this->password))?$this->password:$usuario->password;
        $usuario->save();
        return $exito;
        
        
    }

}
