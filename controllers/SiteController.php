<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Usuario;
use app\models\Rol;
use app\models\FormUpload;
use yii\web\UploadedFile;
use app\models\Noticia;
use app\models\SuscripcionNoticia;
use app\models\noticiaSearch;
use app\models\Evento;
use app\models\Foro;
use app\models\EventoSearch;
use yii\helpers\Url;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */public $id_usuario_actual;

    public function init() {
        $this->id_usuario_actual = (!empty($_SESSION["__id"])) ? $_SESSION["__id"] : "0";
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionAdministrar() {
        if ($this->id_usuario_actual == "0") {
            $this->redirect("index.php?r=site%2Flogin");
        }
        $usuario = Usuario::findOne($_SESSION["__id"]);
        $rol = Rol::findOne($usuario->idrol);
        $permisosJson = $rol->permiso_rol;
        $data = json_decode($permisosJson, true);
        return $this->render('administrar', ["permisos" => $data, "rol" => $rol->descripcion]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new NoticiaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $noticias = Noticia::find()->where(['id_estado' => 6])->all();

        $noticiasImp = noticia::find()->where(['importante' => 1])
                ->where(['id_estado' => 6])
                ->orderBy('fecha desc')
                ->limit(5) //limite de noticias en el slider
                ->all();
        $eventos = Evento::find()->all();
        $arreglo = [];
        foreach ($eventos as $eve) {
            $evento = new \yii2fullcalendar\models\Event();
            $evento->id = $eve->id;
            $evento->title = $eve->nombre;
            $evento->start = date($eve->desde, strtotime($eve->desde . ' ' . '02:00:00'));
            $evento->url = Url::to(['evento/view', 'id' => $eve->id]);
            $evento->allDay = true;
            if ($eve->es_feriado == 1) {
                $evento->color = "red";
            }
            $evento->ranges = 4;
            $arreglo[] = $evento;
        }
        $cincoNot = Noticia::find()->where(["id_estado"=>6])->orderBy(["fecha" => SORT_DESC])->limit(5)->all();
        $foros = Foro::find()->orderBy(["fecha" => SORT_DESC])->limit(3)->all();
        return $this->render('index', ['noticias' => $noticias,
                    'foros' => $foros,
                    'cincoNot' => $cincoNot,
                    'noticiasImp' => $noticiasImp,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'events' => $arreglo,]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            return $this->goBack();
        }

        $model->clave = '';
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    public function actionActivarcuenta($cod = "", $user = "") {
        
        $usuario = new Usuario();
        $usuarioAactivar = $usuario->find()->where(["email" => $user])->one();
        if (empty($usuarioAactivar)) {
            $mensaje = "No existe usuario registrado con ese email";
            return $this->render('error', ['mensaje' => $mensaje]);
        } else {
            if(!Yii::$app->user->isGuest){Yii::$app->user->logout();}
            $msg = "";
            $model = new FormUpload();
            if ($model->load(Yii::$app->request->post())) {
                $model->file = UploadedFile::getInstances($model, 'file');
                $usuarioAactivar->legajo = $model->legajo;
                $usuarioAactivar->password = $model->password;
                $usuarioAactivar->id_estado = 6;

                if ($model->file && $model->validate()) {
                    foreach ($model->file as $file) {
                        $guardarEn = 'archivos/usuario/' . $usuarioAactivar->id . '.' . $file->extension;
                        $file->saveAs($guardarEn);
                        $usuarioAactivar->imagen = $guardarEn;
                        $usuarioAactivar->save();
                        $modelo = new LoginForm();
                        $modelo->clave = $model->password;
                        $modelo->email = $usuarioAactivar->email;
                        if ($modelo->login()) {
                            return $this->goHome();
                        }
                    }
                }
            }
            return $this->render('Activacionform', ['model' => $model, "msg" => $msg]);
        }
    }

    public function actionInicioautomatico() {

        if (!empty($_POST["pass"]) && !empty($_POST["id"]) && !empty($_POST["legajo"])) {
            $password = $_POST["pass"];
            $id = $_POST["id"];
            $legajo = $_POST["legajo"];
            $usuario = Usuario::findOne($id);
            $usuario->password = $password;
            $usuario->id_estado = 6;
            $usuario->legajo = $legajo;
            $usuario->save();
            $model = new LoginForm();
            $model->clave = $password;
            $model->email = $usuario->email;
            if ($model->login()) {
                return $this->goHome();
            }
            $model->clave = '';
            $usuario->password = "";
        } else {
            $mensaje = "Error al activar cuenta";
            return $this->render('error', ['mensaje' => $mensaje]);
        }
    }

    public function actionEnviaremail() {
        $usuario = new Usuario();
        $mensaje = "";
        $siNo = false;
        if (!empty($_POST['datos'])) {
            $data = json_decode($_POST['datos'], true);
            $email = $data["email"] . "@est.fi.uncoma.edu.ar";
            $nombre = $data["nombre"];
            $apellido = $data["apellido"];
            $password = $data["password"];
            if (empty($usuario->find()->where(["email" => $email])->one())) {
                $codigo = $this->random_str(10);
                $usuario->email = $email;
                $usuario->authKey = $codigo;
                $usuario->nombre = $nombre;
                $usuario->apellido = $apellido;
                $usuario->password = $password;
                $usuario->idrol = 5;
                $usuario->id_estado = 7;
                Yii::$app->mail->compose()
                        ->setFrom('cefaiwebprueba@gmail.com')
                        ->setTo($email)
                        ->setSubject('CEFAIWEB: Correo de Verificacion')
                        ->setHTMLBody('<a href="http://localhost/MASTER/cefaiweb/web/index.php?r=site%2Factivarcuenta&user=' . $email . '&cod=' . $codigo . '">Activar Cuenta</a>')
                        ->send();
                $usuario->save();
                $mensaje = "Enviamos un email de verificacion a su correo, abralo para activar su cuenta";
                $siNo = true;
            } else {
                $mensaje = "Ya existe una cuenta con ese email";
                $siNo = false;
            }
        }
        return json_encode(["mensaje" => $mensaje, "siNo" => $siNo]);
    }

    public function actionRegistro() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->render('registro');
    }
    public function actionMasinfo() {
        return $this->render('masinfo');
    }

    public function actionEstadodecuenta() {

        if (!empty($_SESSION["__id"])) {
            $usuario = Usuario::findOne($_SESSION["__id"]);

            if ($usuario->id_estado == 7) {
                Yii::$app->user->logout();
                $msg = "Aun falta activar su cuenta, activela atravez del enlace que fue enviado a su correo.";
                return $this->render('error', ["mensaje" => $msg]);
            } else if ($usuario->id_estado == 8) {
                Yii::$app->user->logout();
                $msg = "Su cuenta se encuentra bloqueada";
                return $this->render('error', ["mensaje" => $msg]);
            } else {
                Yii::$app->user->logout();
                return $this->goHome();
            }
        }
        return $this->goHome();
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces [] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

}
