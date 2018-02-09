<?php
    require('../view/partials/menu.php');
?>
<div class="contenedor_editar">
    <div class="editar">
        <h2>Editar usuario</h2>
        <form method="POST">
            <span>Usuario</span><br>
            <input type="text" name="usuario" value="<?php echo $datos->usuario; ?>"><br><br>
            <span>Clave</span><br>
            <input type="checkbox" name="cambiar_clave">
            (Marcar para cambiar la clave)<br>
            <input type="password" name="clave"><br><br>
            <span>Permisos</span><br>
            <?php $usuarios = ($datos->usuarios == 1) ? 'checked' : ''; ?>
            <?php $noticias = ($datos->noticias == 1) ? 'checked' : ''; ?>
            <input type="checkbox" name="noticias" <?php echo $noticias; ?>>Noticias<br>
            <input type="checkbox" name="usuarios" <?php echo $usuarios; ?>>Usuarios<br><br>
            <a class="btn" type="button" href="<?php echo $_SESSION['home'] ?>panel/usuarios">volver</a>
            <input class="btn" type="submit" value="guardar" name="guardar">
            
        </form>
    </div>
</div>
