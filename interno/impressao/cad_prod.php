<?php



include_once("../conexao_bd.php");





$codigo = filter_input(INPUT_POST,'codigo');

$descricao = filter_input(INPUT_POST,'descricao_prod');

$quantidade = filter_input(INPUT_POST,'quantidade');

$valor_unidade = filter_input(INPUT_POST,'valor_unidade');
$un_medida = filter_input(INPUT_POST,'un_medida');


$result_impres = "INSERT INTO produtos (codigo, descricao_prod, quantidade, valor_unidade, status, un_medida) VALUES ($codigo, '$descricao', '$quantidade','$valor_unidade', '0', '$un_medida')";

$resultado_impres = mysqli_query($conn,$result_impres);



if ($resultado_impres = true) {

	header('Location:inicio.php');

}

if (!$resultado_impres) {

	echo "erro";

}



?>