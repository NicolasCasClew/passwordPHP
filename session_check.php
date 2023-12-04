<?php


if (!isset($_SESSION["nombre"])) {
    header("Location: form.php");
}
