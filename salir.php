<h1 style="color: green;">Sesion cerrada</h1>

<?php
require("session_check.php");
session_start();


session_unset();
session_destroy();
?>
<br>
<a href="form.php">Login</a>
<a></a>
<style>
body {background-color:#<?php echo$_COOKIE['color_fondo'];?>;}
</style>