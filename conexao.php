<?php
$servidor = "localhost";
$usuario  = "root";
$senha    = "root";
$banco    = "BD_GRUPOS_TCC";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
