<?php

//$username = $_POST["name"];
$correo = $_POST["mail"];
$password = $_POST["pass"];


$dbData = array(
    "servername" => "",
    "username" => "",
    "password" => "",
    "dbname" => ""
);
$defaultFile = fopen("user_data.txt", "r");

foreach ($dbData as $index => $value) {
    $newLine = fgets($defaultFile);
    $dbData[$index] = trim($newLine);
}
//nos conectamos a la base de datos
$mysqli = new mysqli($dbData["servername"], $dbData["username"], $dbData["password"], $dbData["dbname"]);


if ($mysqli->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}
//creamos la base de datos en caso de no tenerla (hace falta popularla)
$query = "CREATE TABLE IF NOT EXISTS  `users` ( 
        `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        `nombre` varchar(50) NOT NULL, 
        `correo_electronico` varchar(100) NOT NULL UNIQUE KEY, 
        `contrasena_hash` varchar(255) NOT NULL ),
        `color_fondo` varchar(10) NULL;";

$res = $mysqli->query($query);


$query = "SELECT nombre, correo_electronico, contrasena_hash, color_fondo FROM users 
WHERE correo_electronico = '$correo'";

$result = $mysqli->query($query);

$row = $result->fetch_assoc();
if ($row != null) {
    $nombre = $row['nombre'];
    $mail = $row['correo_electronico'];
    $pass = $row['contrasena_hash'];
    $color = $row['color_fondo'];

    //verificamos contraseña
    if (password_verify($password, $pass)) {

        //iniciamos sesion
        session_start();
        $_SESSION["nombre"] = $nombre;
        echo "<h1 style= color:green;>CONTRASEÑA CORRECTA</h1>";
        echo "<h2 style= color:black;>Inicio de sesion autorizado</h2>";

        //Creamos la cookie para el color
        $color == "" ? $color = "808080" : null;
        setcookie("color_fondo", $color, time() + 86400); //un dia en segundos
        echo "<h2>Tu color favorito es $color</h2>";
        echo "<br><a href= 'indice.php'>Menu Principal</a>";
    } else {
        echo '<h1 style=" color:red;">CONTRASEÑA INCORRECTA</h1>';
        echo "<h2 style= color:black;>Vuelva a intentarlo</h2>";
        echo "<a href= form.php>Volver</a>";

        //comprobar si se han superado los intentos
        if ($_COOKIE['login_tries'] <= 1) {

            //reseteamos la cookie contadora y creamos una cookie que deshabilita los inputs
            setcookie("timeOut", "UPS", time() + 120);
            setcookie("login_tries", 5, time() + 2147483647);
        } else {

            //restamos 1 al contador de intentos
            $newTries =  $_COOKIE['login_tries'] - 1;
            setcookie("login_tries", $newTries, time() + 2147483647);
        }
    }
} else {
    echo '<h1 style=" color:red;">USUARIO NO ENCONTRADO</h1>';
    echo "<h2 style= color:black;>Vuelva a intentarlo</h2>";
    echo "<a href= form.php>Volver</a>";
}
?>
<style>
    body {
        background-color: #<?php
                            //cambiamos el color de fondo por el ontenido en la base de datos.
                            //De no exitir la cookie elegimos el blanco por defecto
                            echo $color = (isset($_COOKIE['color_fondo'])) ?  $_COOKIE['color_fondo'] :  "ffffff";
                            ?>
    }
</style>