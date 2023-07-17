<?php

include_once("../conexao_bd.php");

if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['s_login'])) {
  session_destroy();
  header("Location:logout.php"); exit;
}

$data = json_decode(file_get_contents('php://input'), true);

// Acessar os valores específicos do payload
$value = $data['value'];
$id = $data['id'];
print_r($data['value'], $data['id']);

$sql = "UPDATE unidades SET value = '$value' WHERE id = '$id'";
$result_update = mysqli_query($conn, $sql);

$sql_unity_list = "SELECT * FROM unidades";
$result = mysqli_query($conn, $sql_unity_list);

$unity_list = [];
while ($row = mysqli_fetch_assoc($result)) {
  $unity_list[] = $row;
}

$response = [
    'success' => true,
    'message' => 'Unidade atualizada com sucesso!',
    'data' => $unity_list
];

header('Content-Type: application/json');
if ($result_update) {
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar unidade!']);
}

?>