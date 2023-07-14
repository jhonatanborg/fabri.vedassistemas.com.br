<?php



include_once("../conexao_bd.php");





$codigo = filter_input(INPUT_POST,'codigo', FILTER_SANITIZE_STRING);

$descricao = filter_input(INPUT_POST,'descricao_prod', FILTER_SANITIZE_STRING);

$quantidade = filter_input(INPUT_POST,'quantidade', FILTER_SANITIZE_STRING);

$valor_unidade = filter_input(INPUT_POST,'valor_unidade', FILTER_SANITIZE_STRING);


$result_impres = "INSERT INTO produtos (codigo, descricao_prod, quantidade, valor_unidade, status) VALUES ($codigo, '$descricao', '$quantidade','$valor_unidade', '0')";

$resultado_impres = mysqli_query($conn,$result_impres);



if ($resultado_impres = true) {

	header('Location:inicio.php');

}

if (!$resultado_impres) {

	echo "erro";

}



?>

