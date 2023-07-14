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


$id = filter_input(INPUT_POST,'id', FILTER_SANITIZE_STRING);
$descricao = filter_input(INPUT_POST,'descricao', FILTER_SANITIZE_STRING);
$quantidade = filter_input(INPUT_POST,'quantidade', FILTER_SANITIZE_STRING);


$id_produto = "SELECT id, quantidade FROM produtos WHERE id= '$id'";
$resultado_produto = mysqli_query($conn,$id_produto);

while($lista_id = mysqli_fetch_assoc($resultado_produto)) {
	$lista = $lista_id["id"];
	$estoque = $lista_id["quantidade"];
}

$dispon = "SELECT SUM(quantidade) AS quantidade FROM impressao WHERE id_produto = '$lista' AND NOT status = 2 AND NOT status = 0 AND NOT status = 5";
$disponivel = mysqli_query($conn, $dispon);
while ($row_disp = mysqli_fetch_assoc($disponivel)) {
	$qntd_dispon = $row_disp["quantidade"];
}
$dispon_final = $estoque - $qntd_dispon;

if ($quantidade <= $dispon_final) {
	$result_impres = "INSERT INTO impressao (descricao, quantidade, id_produto,status, id_professor, unidade) VALUES ('$descricao', '$quantidade','$lista','0', '$VarID', '$VarUnidade')";
$resultado_impres = mysqli_query($conn,$result_impres);

if ($resultado_impres = true) {
	header("Location:index.php");
}
}
else {
echo '<script>alert(\'Quantidade em estoque indisponível, tente uma quantidade menor\');parent.location =\'solicitar_servico.php\';</script>';
}
?>
