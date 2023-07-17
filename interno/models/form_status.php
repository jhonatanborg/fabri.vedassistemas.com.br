<?php



function confirmReceive($id) {
  include_once("../conexao_bd.php");
  
  $sql_update = "UPDATE impressao SET status = '8', data=NOW() WHERE id = '$id'"; 
  $resultUpdate = mysqli_query($conn, $sql_update);
  $response = [
	'success' => true,
	'message' => 'Solicitado com sucesso!',
	
];

header('Content-Type: application/json');
if ($resultUpdate) {
	echo json_encode($response);
} else {
	echo json_encode(['success' => false, 'message' => 'Erro ao solicitar !', 'error' => mysqli_error($conn)]);
}
  
}

$data = json_decode(file_get_contents('php://input'), true);

// Acessar os valores específicos do payload

$id = $data['id'];

if($id) {
 
  confirmReceive($id);
}


?>