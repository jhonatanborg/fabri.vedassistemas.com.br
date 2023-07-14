<?php



include_once("../conexao_bd.php");




$matricula = filter_input(INPUT_POST,'matricula', FILTER_SANITIZE_STRING);

$nome = filter_input(INPUT_POST,'nome', FILTER_SANITIZE_STRING);

$login = filter_input(INPUT_POST,'login', FILTER_SANITIZE_STRING);

$senha = filter_input(INPUT_POST,'senha', FILTER_SANITIZE_STRING);

$senha= md5($senha);

$nivel = filter_input(INPUT_POST,'nivel', FILTER_SANITIZE_STRING);

$unidade = filter_input(INPUT_POST,'unidade', FILTER_SANITIZE_STRING);



$result_usuario = "INSERT INTO usuarios (matricula, nome, login, senha, nivel, unidade, status) VALUES ('$matricula', '$nome', '$login', '$senha', '$nivel', '$unidade', '0'  )";



$resultado_usuario = mysqli_query($conn,$result_usuario);



if ($resultado_usuario = true) {

echo '<script>location.href="usuarios.php"</script>';
}
?>