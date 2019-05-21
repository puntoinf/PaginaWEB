<?php ?>

<div class="form-group col-md-12" align="center">
    <h3><?= $rol ?></h3>
    <div class="col-md-6 col-md-offset-3">

        <?php
        foreach ($permisos as $key => $unPermiso) {

            if ($unPermiso != "x") {
                ?>
                <div class="form-group">
                    <div class="col-md-12 col-offset-1">
                        <?= ($key == "f") ? '<h3 class="col-md-12"><a class="btn btn-info btn-lg" href="">Foros</a></h3>' : "" ?>
                        <?= ($key == "n") ? '<h3 class="col-md-12"><a class="btn btn-info btn-lg" href="">Noticias</a></h3>' : "" ?>
                        <?= ($key == "p") ? '<h3 class="col-md-12"><a class="btn btn-info btn-lg" href="">Pasantias</a></h3>' : "" ?>
                        <?= ($key == "i") ? '<h3 class="col-md-12"><a class="btn btn-info btn-lg" href="">Inventario</a></h3>' : "" ?>
                        <?= ($key == "u") ? '<h3 class="col-md-12"><a class="btn btn-info btn-lg" href="">Usuarios</a></h3>' : "" ?>
                        <?= ($key == "c") ? '<h3 class="col-md-12"><a class="btn btn-info btn-lg" href="">Consultas</a></h3>' : "" ?>
                        <?= ($key == "m") ? '<h3 class="col-md-12"><a class="btn btn-info btn-lg" href="">Materias</a></h3>' : "" ?>
                        <?= ($key == "e") ? '<h3 class="col-md-12"><a class="btn btn-info btn-lg" href="">Eventos</a></h3>' : "" ?>
                    </div>
                </div>
            <?php }
        }
        ?>
    </div></div>