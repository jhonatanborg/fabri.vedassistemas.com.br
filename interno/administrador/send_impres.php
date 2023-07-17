<?php



include_once("../conexao_bd.php");



if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['s_login'])) {

  session_destroy();

  header("Location:logout.php"); exit;

}



 $VarID    = $_SESSION['s_id'];

 $VarLogin = $_SESSION['s_login'];

 $VarNome  = $_SESSION['s_nome'];

 $VarNivel = $_SESSION['s_nivel'];

 $VarUnidade = $_SESSION['s_unidade'];


$data = json_decode(file_get_contents('php://input'), true);

// Acessar os valores específicos do payload

$descricao = $data['descricao'];
$id = $data['id'];
$quantidade = $data['quantidade'];

$result_impres = "INSERT INTO impressao (descricao, quantidade, id_produto,status, id_professor, id_unidade) VALUES ('$descricao', '$quantidade','$id','0', '$VarID', '$VarUnidade')";

$resultado_impres = mysqli_query($conn,$result_impres);



$response = [
	'success' => true,
	'message' => 'Solicitado com sucesso!',
	
];

header('Content-Type: application/json');
if ($resultado_impres) {
	echo json_encode($response);
} else {
	echo json_encode(['success' => false, 'message' => 'Erro ao solicitar !', 'error' => mysqli_error($conn)]);
}

?>