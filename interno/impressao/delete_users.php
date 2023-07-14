<?php



include_once("../conexao_bd.php");

session_start();



$id2 = $_POST['id'];



$result_impres2 = "SELECT id_professor FROM impressao";

$resultado_impres2 = mysqli_query($conn,$result_impres2);



while ( $lista_id = mysqli_fetch_assoc( $resultado_impres2 ) ) {

	$id_produto_impressao = $lista_id[ "id_professor"];

}





if ($id_produto_impressao != $id2) {

	$result_users = "UPDATE usuarios SET nivel = '6' WHERE id = '$id2'";

	$resultado_users = mysqli_query($conn,$result_users);





if ($resultado_impres = true) {

	header('Location:usuarios.php');

}

}

else {

	echo '<script>alert(\'Usuario possui registro em pedidos de impressão\');parent.location =\'inicio.php\';</script>';

}

?>