<?php
session_start();

require("session_check.php");

echo "<h3> Sesión iniciada como = '$_SESSION[nombre]'</h3>";
?>


<h1>Listado de ventanas</h1>

<ul>
    <li>
        <a href="salir.php">Cerrar sesion</a>
    </li>
    <li>
        <a href=""></a>
    </li>
    <li>
        <a href=""></a>
    </li>
</ul>
<style>
body {background-color:#<?php echo$_COOKIE['color_fondo'];?>;}
</style>