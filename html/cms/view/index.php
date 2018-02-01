
<h3>Id: 
    <?php echo "$datos->id" ?>
</h3>

<h3>Usuario: 
    <?php echo "$datos->usuario" ?>
</h3>

<h3>Clave: 
    <?php echo crypt("$datos->clave","do u know da wae?") ?>
</h3>

<h3>
    Fecha de acceso: <?php echo "$datos->fecha_acceso" ?>
</h3>

<h3>
    Activo: <?php echo "$datos->activo" ?>
</h3>

<h3>
    Usuarios: <?php echo "$datos->usuarios" ?>
</h3>

<?php 
    if (hash_equals($datos->clave, crypt('1', $datos->clave))) {
        echo "¡You know da wae!";
    }else{
        echo "¡You don't know da wae!";
    }
?>
