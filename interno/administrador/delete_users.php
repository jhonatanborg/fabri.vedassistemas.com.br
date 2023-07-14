<?php



include_once("../conexao_bd.php");





$id2 = $_POST['id'];









$result_users = "UPDATE usuarios SET nivel = '6' WHERE id = '$id2'";

$resultado_users = mysqli_query($conn,$result_users);



if ($resultado_impres = true) {

	header('Location:usuarios.php');

	

}



else {



	header('Location:inicio.php');



}

?>