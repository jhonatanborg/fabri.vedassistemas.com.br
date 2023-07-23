<?php



include_once("../conexao_bd.php");


$data = json_decode(file_get_contents('php://input'), true);

// Acessar os valores específicos do payload
$codigo = $data['codigo'];
$quantidade = $data['quantidade'];
$descricao = $data['descricao_prod'];
$valor_unidade = $data['valor_unidade'];
$un_medida = $data['un_medida'];
$id = $data['id'];




	$result_produtos = "UPDATE produtos SET codigo='$codigo', quantidade =  '$quantidade', descricao_prod='$descricao', valor_unidade='$valor_unidade', un_medida = '$un_medida' WHERE id = '$id'";
	$resultado_produtos = mysqli_query($conn, $result_produtos);
	$response = [
		'status' => 'success',
		'message' => 'Produto atualizado com sucesso!'
	];
	
	if(!$resultado_produtos){
		$response = [
			'status' => 'error',
			'message' => 'Erro ao atualizar produto!'
		];
	}
echo $id;
header('Content-type: application/json');
echo json_encode($response);

?>