
<?php 
    require('../view/partials/menu.php');
?>


<div class="tablaUsuarios">
    <div class="">
        <ul class="titulos">
            <li class="">USUARIO</li>
            <li class="">ACCIONES</li>
        </ul>    
        <?php foreach ($datos as $dato){ ?>
            <ul class="">
                <li class="">
                    <a href="">
                        <?php echo $dato->usuario ?>
                    </a>    
                </li>
                <li class="">
                    <a href="">editar</a>
                    <a href="">activar</a>
                    <a href="">borrar</a>
                </li>
            </ul>    
        <?php } ?>
    </div>  
</div>