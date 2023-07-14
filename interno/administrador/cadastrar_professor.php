<?php
include_once("../conexao_bd.php");


$nome = filter_input(INPUT_POST,'nome', FILTER_SANITIZE_STRING);
$login = filter_input(INPUT_POST,'login', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST,'senha', FILTER_SANITIZE_STRING);
$senha= md5($senha);

$result_usuario = "INSERT INTO usuarios (nome, login, senha, nivel) VALUES ('$nome', '$login', '$senha', '2'  )";
$resultado_usuario = mysqli_query($conn,$result_usuario);

if ($resultado_usuario = true) {
	header('Location:index.php');
}
?>

