
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Foros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div  class="form-group col-md-11" align="center"><h1 class="col-md-4 col-md-offset-4">Foros</h1></div>


<div class="form-horizontal form-group col-md-10 col-md-offset-1">
    <?php
    $options="";
    if (!Yii::$app->user->isGuest) {
        $categorias = app\models\Categoria_Foro::find()->all();
        foreach ($categorias as $cat) {
            $options .= '<option value="' . $cat->id . '">' . $cat->descripcion . '</option>';
        }
        echo '<div class="col-md-5">
        <div class="form-group">
            <div data-toggle="collapse" data-target="#crearforo" id="createForoExpand" class="btn btn-info btn-block">Crear Foro</div>
        </div>

        <div id="crearforo" class="collapse col-md-12">
            <div class="form-group has-feedback">
                <label for="Titulo">Titulo</label>
                <input type="text" id="Titulo" class="form-control">
                <div id="tituloR" class="help-block with-errors"></div>
            </div>
            <div class="form-group">
                <label for="Categoria">Categoria</label>
                <select id="Categoria" class="form-control">' .
        $options
        . '</select>
                <div id="categoriaR" class="help-block with-errors"></div>
            </div>
            <div class="form-group has-feedback">
                <label for="Descripcion">Descripcion</label>
                <textarea id = "Descripcion" class="form-control"></textarea>
                <div id="descripcionR" class="help-block with-errors"></div>
            </div>
            <div class="btn btn-success btn-block" id="crearForo">Crear Foro</div>
        </div>

    </div>';
    }
    ?>




    <?php if (!Yii::$app->user->isGuest) {
        echo '<div id="buscar" class="col-md-5  col-md-offset-1">';
    } else {
        echo '<div id="buscar" class="col-md-11 ">';
    } ?>

    <div class="form-group has-feedback">
        <input type="text" placeholder="Buscar" name="buscar" id="buscarI" class="form-control">
        <span class="glyphicon glyphicon-search form-control-feedback"></span>
    </div>
</div>


</div>

<div id="g2PrimerForo"></div>
<div id="g2TodosLosForos">
<?php foreach ($g2Foros as $g2UnForo) { ?>



        <div class=" form-horizontal col-md-10 col-md-offset-1">
            <div class="form-group col-md-2 vertical-center" style="border-width: 1px; border-style: solid; border-color: lightgrey;border-radius: 3px 0px 0px 3px; background: #f1f3f6;min-height: 250px" align="center">
                <div class="col-md-12" style="display:block;">
                    <a href="index.php?r=usuario%2Fperfil&id=<?= $g2UnForo->getUsuario()->id ?>" style="text-decoration:none">
                    <img width="100px" src="<?= $g2UnForo->getUsuario()->imagen ?>">
                    <h5><?= $g2UnForo->getUsuario()->nombre . ' ' . $g2UnForo->getUsuario()->apellido ?></h5>
                    </a>
                    <h5><?= (new DateTime($g2UnForo->fecha))->format("d-m-Y") ?></h5>
                </div>
            </div>
            <div class="form-group col-md-10" style="border-width:1px 1px 1px 0px; border-style: solid; border-color: lightgrey;border-radius: 0px 3px 3px 0px;min-height: 250px">
                <h4 class="col-md-offset-1"><?= $g2UnForo->titulo ?></h4>
                <hr style="width:90%;margin-right:25px;">
                <p class="col-md-offset-1"><?= $g2UnForo->texto ?></p>
                <div class="form-group col-md-offset-1 acc" style="left:120px;bottom: 8px">
                    <b>Categoria:</b> <i><?= $g2UnForo->getCategoria()->descripcion ?></i>
                </div>
                <div class="form-group col-md-12 acc" align="right">
                    <a class="btn btn-info btn-md" href="index.php?r=foro%2Fver&id=<?= $g2UnForo->id ?>">Acceder</a>
                </div>
            </div>

        </div>

    <?php $ultimo = $g2UnForo->id;
} ?>
</div>



<script>
    ultimo = <?= $ultimo ?>;
</script>

<div>
    <div id="g2CargarMasForo"  class="form-group col-md-9 col-md-offset-5">
        <h4 class="btn btn-success btn-lg">Cargar Mas</h4>
    </div>
</div>



<style>
    .vertical-center {
        min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
        min-height: 100vh; /* These two lines are counted as one 🙂       */
        display: flex;
        align-items: center;
    }

    .acc{
        position:absolute;
        bottom: 0;
    }

</style>

