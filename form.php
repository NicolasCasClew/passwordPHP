<?php
//creamos la cookie que maneja los intentos de login
if (!isset($_COOKIE['login_tries'])) {
    setcookie("login_tries", 5, 2147483647);
    echo "coocke creada";
}

?>
<h1>Login</h1>
<form action="manage_form.php" method="post" enctype="multipart/form-data" style="display: flex; flex-direction:column; max-width: 200px;">
    <label for="mail">Correo electronico: </label>
    <input type=" text" id="mail" name="mail" <?php echo isset($_COOKIE['timeOut']) ? "disabled" : "";  ?>>
    <label for="text">Contraseña</label>

    <input type="password" id="pass" name="pass" <?php echo isset($_COOKIE['timeOut']) ? "disabled" : "";  ?>>
    </br>
    <input type="submit" value="Enviar" <?php echo isset($_COOKIE['timeOut']) ? "disabled" : "";  ?>>
</form>

<h3><?php echo !isset($_COOKIE['timeOut']) ? "Tienes " . $_COOKIE['login_tries'] . "  intentos restantes" : "Castigado 3 minutos por hacer el tonto"; ?></h3>
<style>
    body {
        background-color: #<?php
                            echo $color = (isset($_COOKIE['color_fondo'])) ?  $_COOKIE['color_fondo'] :  "ffffff";
                            ?>
    }
</style>


<?php

?>