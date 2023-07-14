<?php



include_once("../conexao_bd.php");





	$id = mysqli_real_escape_string($conn, $_POST['id']);

	$codigo = mysqli_real_escape_string($conn, $_POST['codigo']);

	$quantidade = mysqli_real_escape_string($conn, $_POST['quantidade']);

	$descricao = mysqli_real_escape_string($conn, $_POST['descricao_prod']);



	



	$result_produtos = "UPDATE produtos SET codigo='$codigo', quantidade =  '$quantidade', descricao_prod='$descricao' WHERE id = '$id'";

	

	$resultado_produtos = mysqli_query($conn, $result_produtos);



	header("Location:inicio.php"); exit;

?>

