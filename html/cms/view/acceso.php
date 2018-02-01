<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
</head>
<body>
    <div class="contenedor">
        <div class="login">
            <h2>Bienvenido a la zona admin</h2>
            <h4><?php echo $datos->mensaje ?></h4>
            <form method="POST">
                <div>
                    <input class="uc" type="text" name="usuario" placeholder="usuario">
                </div>
                <div>
                    <input class="uc" type="password" name="clave" placeholder="contraseña">
                </div>
                <button name="acceso">acceder</button>
            </form>
        </div>
    </div>
</body>
</html>