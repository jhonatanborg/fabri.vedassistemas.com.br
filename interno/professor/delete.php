<?php

include_once("../conexao_bd.php");





$id2 = $_POST['id'];

$codigo = $_POST['codigo'];

$descricao = $_POST['quantidade'];

$quantidade = $_POST['descricao'];





$result_impres = "UPDATE impressao SET status = '5' WHERE id = '$id2'";

$resultado_impres = mysqli_query($conn,$result_impres);






if ($resultado_impres = true) {

echo '<script>location.href="aguardando.php"</script>';

	

}

?>