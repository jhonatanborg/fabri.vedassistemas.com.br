<?php
session_start();
include_once("../conexao_bd.php");


$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];

$result_list_impressao ="SELECT * FROM impressao WHERE impressao.id_produto = '$id' LIMIT 1";
$resultado_list_impressao = mysqli_query($conn, $result_list_impressao);

// delete product only if it has no impressions
if(mysqli_num_rows($resultado_list_impressao) == 0){
	$result_produtos = "UPDATE produtos SET status = '1' WHERE id = '$id'";
	$resultado_produtos = mysqli_query($conn, $result_produtos);
}
$response = array();

if($resultado_produtos){
	$response['status'] = 'success';
	$response['message'] = 'Produto excluído com sucesso!';
}else{
	$response['status'] = 'error';
	$response['message'] = 'Não foi possível excluir o produto!';
}


header('Content-type: application/json');
echo json_encode($response);


?>