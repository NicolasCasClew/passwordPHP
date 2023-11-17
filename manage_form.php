<h1 style="color: red;"></h1>
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
$mysqli = new mysqli($dbData["servername"], $dbData["username"], $dbData["password"], $dbData["dbname"]);


if ($mysqli->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

$query = "CREATE TABLE IF NOT EXISTS  `users` ( 
        `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        `nombre` varchar(50) NOT NULL, 
        `correo_electronico` varchar(100) NOT NULL UNIQUE KEY, 
        `contrasena_hash` varchar(255) NOT NULL );";

$res = $mysqli->query($query);


$query = "SELECT nombre, correo_electronico, contrasena_hash FROM users 
WHERE correo_electronico = '$correo'";

$result = $mysqli->query($query);


while ($row = $result->fetch_assoc()) {

    $nombre = $row['nombre'];
    $mail = $row['correo_electronico'];
    $pass = $row['contrasena_hash'];
    echo "<br>";

    if (password_verify($password, $pass)) {
        session_start();
        $_SESSION["correo"] = $mail;
        echo "<h1 style= color:green;>CONTRASEÑA CORRECTA</h1>";
        echo "<h2 style= color:black;>Inicio de sesion autorizado</h2>";
        echo "<br><a href= 'indice.php'>Menu Principal</a>";
        //header("Location: indice.php");
    } else {
        echo '<h1 style=" color:red;">CONTRASEÑA INCORRECTA</h1>';
        echo "<h2 style= color:black;>Vuelva a intentarlo</h2>";
        echo "<a href= form.php>Volver</a>";
    }
}
