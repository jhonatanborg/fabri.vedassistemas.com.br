<?php
session_start();
include_once("../conexao_bd.php");


$id2 = $_POST['id'];

$result_impres2 = "SELECT id_produto FROM impressao";
$resultado_impres2 = mysqli_query($conn,$result_impres2);

while ( $lista_id = mysqli_fetch_assoc( $resultado_impres2 ) ) {
	$id_produto_impressao = $lista_id[ "id_produto" ];
}

if ($id_produto_impressao === $id2) {
echo '<script>alert(\'Produto possui registro em pedidos de impressão\');parent.location =\'inicio.php\';</script>';
}
else if ($id_produto_impressao != $id2) {
	
	$result_impres = "UPDATE produtos SET status = '1' WHERE id = '$id2'";
	$resultado_impres = mysqli_query($conn,$result_impres);

if ($resultado_impres = true) {
	header('Location:inicio.php');
	
}
	
}

?>