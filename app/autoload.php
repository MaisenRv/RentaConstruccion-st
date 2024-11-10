<?php
// autoload.php
spl_autoload_register(function ($class) {
    // Cambiar los backslashes a barras diagonales
    $class = str_replace('\\', '/', $class);

    // Incluir el archivo de la clase
    require_once __DIR__ . '/' . $class . '.php';
});
