<?php

include_once("../conexao_bd.php");


 $VarID    = $_SESSION['s_id'];
 $VarLogin = $_SESSION['s_login'];
 $VarNome  = $_SESSION['s_nome'];
 $VarNivel = $_SESSION['s_nivel'];

 	$id = mysqli_real_escape_string($conn, $_POST['id']);
	$quantidade = mysqli_real_escape_string($conn, $_POST['quantidade']);
	$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
	$descricao_prod = mysqli_real_escape_string($conn, $_POST['descricao_prod']);

$id_produto = "SELECT id FROM produtos WHERE descricao_prod= '$descricao_prod'";
$resultado_produto = mysqli_query($conn,$id_produto);

while($lista_id = mysqli_fetch_assoc($resultado_produto)) {
	$lista = $lista_id["id"];
}
	$result_produtos = "UPDATE impressao SET id_produto = '$lista',data=NOW(), quantidade='$quantidade', descricao='$descricao' WHERE id = '$id'";
	
	$resultado_produtos = mysqli_query($conn, $result_produtos);

	header("Location:aguardando.php"); exit;
?>