
<?php 
    require('../view/partials/menu.php');
    require('../view/partials/mensajes.php');
?>


<div class="tablaUsuarios">   
    <div class="titulos">
        <label class="titulo1">USUARIO</label>
        <a class="añadirus" href="<?php echo $_SESSION['home'] ?>panel/usuarios/crear">AÑADIR USUARIO</a>
        <label class="titulo2">ACCIONES</label>
    </div>    
    <?php foreach ($datos as $dato){ ?>
        <div class="usuarios">
            <div class="usuario">
                <a href="">
                    <?php echo $dato->usuario ?>
                </a>    
            </div>
            <div class="acciones">
                <a class="accion1" href="">editar</a>
                <?php $color = ($dato->activo == 1) ? 'activo' : 'inactivo'; ?>
                <?php $texto = ($dato->activo == 1) ? 'desactivar' : 'activar'; ?>
                <?php $ruta = $_SESSION['home']."panel/usuarios/".$texto."/".$dato->id ?>
                <a class="<?php echo $color ?>" id="accion1" href="<?php echo $ruta ?>" title="<?php echo $texto ?>">
                    <span class="far fa-check-square"></span>
                </a>
                <a class="accion1" href="">borrar</a>
            </div>
        </div>    
    <?php } ?>    
</div>