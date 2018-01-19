<?php
require ('conexion.php');

//Insert
$resultado = $db->query('INSERT INTO personas (nombre) VALUES ("José"),("Luís")');
echo "(Insert) resultado: ".$resultado."<br>";

//Delete
$resultado = $db->query('DELETE FROM personas WHERE id>3');
echo "(Delete) resultado: ".$resultado."<br>";

//Update
$registros = $db->query('UPDATE personas SET activo=1 WHERE activo=0');
if ($registros){
    echo "(Update)Se han activado $db->affected_rows registros.";
}
echo "";


//Select en un array con claves asociativas y numéricas (con MYSQLI_STORE_RESULT, da igual ponerlo que no)
$resultado = $db->query('SELECT * FROM personas');
$personas = $resultado->fetch_array(MYSQLI_BOTH); //O también $resultado->fetch_array()
while ($personas != null){ //Recorro el resultado
    echo $personas['id']." ".$personas[1]." ".$personas['activo']."";
    $personas = $resultado->fetch_array(MYSQLI_BOTH);
}
$resultado->free(); //Libero de la memoria
echo "";

//Select en un array con claves asociativas y numéricas (con MYSQLI_USE_RESULT)
$resultado = $db->query('SELECT * FROM personas', MYSQLI_USE_RESULT);
$personas = $resultado->fetch_array(MYSQLI_BOTH); //O también $resultado->fetch_array()
while ($personas != null){ //Recorro el resultado
    echo $personas['id']." ".$personas[1]." ".$personas['activo']."";
    $personas = $resultado->fetch_array(MYSQLI_BOTH);
}
$resultado->free(); //Libero de la memoria
echo "";

//Select en un array con claves asociativas
$resultado = $db->query('SELECT * FROM personas');
$personas = $resultado->fetch_array(MYSQLI_ASSOC); //O también $resultado->fetch_assoc()
while ($personas != null){ //Recorro el resultado
    echo $personas['id']." ".$personas['nombre']." ".$personas['activo']."";
    $personas = $resultado->fetch_array(MYSQLI_ASSOC);
}
$resultado->free(); //Libero de la memoria
echo "";

//Select en un array con claves numéricas
$resultado = $db->query('SELECT * FROM personas');
$personas = $resultado->fetch_array(MYSQLI_NUM); //O también $resultado->fetch_row()
while ($personas != null){ //Recorro el resultado
    echo $personas[0]." ".$personas[1]." ".$personas[2]."";
    $personas = $resultado->fetch_array(MYSQLI_NUM);
}
$resultado->free(); //Libero de la memoria
echo "";

//Select en un objeto
$resultado = $db->query('SELECT * FROM personas');
$personas = $resultado->fetch_object();
while ($personas != null){ //Recorro el resultado
    echo $personas->id." ".$personas->nombre." ".$personas->activo."";
    $personas = $resultado->fetch_object();
}
$resultado->free(); //Libero de la memoria
echo "";

//Select con un objeto, real_query y store_result
$booleano = $db->real_query('SELECT * FROM personas');
if ($booleano){
    $resultado = $db->store_result(); //Almaceno el resultado de la última consulta
    $personas = $resultado->fetch_object();
    while ($personas != null){ //Recorro el resultado
        echo $personas->id." ".$personas->nombre." ".$personas->activo."";
        $personas = $resultado->fetch_object();
    }
    $resultado->free(); //Libero de la memoria
    echo "";
}

//Select con un objeto, real_query y use_result
$booleano = $db->real_query('SELECT * FROM personas');
if ($booleano){
    $resultado = $db->use_result(); //Uso el resultado de la última consulta
    $personas = $resultado->fetch_object();
    while ($personas != null){ //Recorro el resultado
        echo $personas->id." ".$personas->nombre." ".$personas->activo."";
        $personas = $resultado->fetch_object();
    }
    $resultado->free(); //Libero de la memoria
    echo "";
}

//Cierro la conexión
$db->close();