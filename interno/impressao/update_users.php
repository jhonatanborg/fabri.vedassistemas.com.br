<?php



include_once("../conexao_bd.php");





	$id = mysqli_real_escape_string($conn, $_POST['id']);

	$matricula = mysqli_real_escape_string($conn, $_POST['matricula']);


	$nome = mysqli_real_escape_string($conn, $_POST['nome']);

	$login = mysqli_real_escape_string($conn, $_POST['login']);

	$senha = mysqli_real_escape_string($conn, $_POST['senha']);

    $senha= md5($senha);

	$nivel = mysqli_real_escape_string($conn, $_POST['nivel']);

	$unidade = mysqli_real_escape_string($conn, $_POST['unidade']);




	



	$result_users = "UPDATE usuarios SET matricula='$matricula', nome='$nome', login='$login', senha='$senha', nivel='$nivel', unidade='$unidade' WHERE id = '$id'";

	

	$resultado_users = mysqli_query($conn, $result_users);



	header("Location:usuarios.php"); exit;

?>

