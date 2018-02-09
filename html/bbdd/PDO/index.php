<?php

require("conexion.php");

//Insert
$registros = $db->exec('INSERT INTO personas (nombre) VALUES ("José"),("Luís")');
if ($registros){
    echo "Se han activado $registros registros.";
}

//Delete
$registros = $db->exec('DELETE FROM personas WHERE id>3');
if ($registros){
    echo "Se han activado $registros registros.";
}

//Update
$registros = $db->exec('UPDATE personas SET activo=1 WHERE activo=0');
if ($registros){
    echo "Se han activado $registros registros.";
}
echo "";

//Select con BOTH
$resultado = $db->query('SELECT * FROM personas');
while ($personas = $resultado->fetch()){ //O bien ($resultado->fetch(PDO::FETCH_BOTH)
    echo $personas['id']." ".$personas[1]." ".$personas['activo']."<br>";
}

//Select con ASSOC
$resultado = $db->query('SELECT * FROM personas');
while ($personas = $resultado->fetch(PDO::FETCH_ASSOC)){ //Recorro el resultado
    echo $personas['id']." ".$personas['nombre']." ".$personas['activo']."<br>";
}

//Select con NUM
$resultado = $db->query('SELECT * FROM personas');
while ($personas = $resultado->fetch(PDO::FETCH_NUM)){ //Recorro el resultado
    echo $personas[0]." ".$personas[1]." ".$personas[2]."<br>";
}

//Select con OBJ
$resultado = $db->query('SELECT * FROM personas');
while ($personas = $resultado->fetch(PDO::FETCH_OBJ)){ //Recorro el resultado
    echo $personas->id." ".$personas->nombre." ".$personas->activo."<br>";
}

//Select con LAZY
$resultado = $db->query('SELECT * FROM personas');
while ($personas = $resultado->fetch(PDO::FETCH_LAZY)){ //Recorro el resultado
    echo $personas[0]." ".$personas['nombre']." ".$personas->activo."<br>";
}

//Select con BOUND
$resultado = $db->query('SELECT * FROM personas');
$resultado->bindColumn(1, $id);
$resultado->bindColumn(2, $nombre);
$resultado->bindColumn(3, $activo);
while ($personas = $resultado->fetch(PDO::FETCH_BOUND)){ //Recorro el resultado
    echo $id." ".$nombre." ".$activo."<br>";
}

//Iniciamos la trasnacción para que no ejecute cada una de ellas por separado
$db->beginTransaction();
//Declaramos todas las consultas
$resultado = $db->exec('INSERT INTO personas (nombre) VALUES ("José"),("Luís")');
$resultado = $db->exec('DELETE FROM personas WHERE id>3');
$resultado = $db->exec('UPDATE personas SET activo=1 WHERE activo=0');
//Realizamos el commit para que se ejecuten todas las consultas
$db->commit();
//Mensaje
if ($resultado){
    echo "Se han activado $resultado registros.";
}
echo "";

//Consulta preparada
$nombres = ['Jorgito', 'Juanito', 'Jaimito'];
$resultado = $db->prepare('INSERT INTO personas (nombre) VALUES (?)');
//O bien $resultado = $db->prepare('INSERT INTO personas (nombre) VALUES (:nombre)');
foreach ($nombres as $nombre){
    $resultado->bindParam(1, $nombre); //O bien $resultado->bindParam(':nombre', $nombre);
    $resultado->execute();
}

$db = null;