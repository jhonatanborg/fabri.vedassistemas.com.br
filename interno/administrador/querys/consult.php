<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function realizarConsulta($VarID, $mes, $ano) {
$VarUnidade = $_SESSION['s_unidade'];
include("../conexao_bd.php");

  
$sql2= "SELECT 
  i.id,
  i.descricao,
  i.quantidade,
  i.status,
  i.id_produto,
  i.data_inicio,
  p.descricao_prod,
  p.codigo,
  p.valor_unidade,
  CASE i.status
    WHEN 0 THEN 'AGUARDANDO'
    WHEN 1 THEN 'AUTORIZADO'
    WHEN 2 THEN 'RECUSADO'
    WHEN 3 THEN 'EXECUTANDO'
    WHEN 4 THEN 'CONCLUÍDO'
    WHEN 5 THEN 'CANCELADO'
    WHEN 8 THEN 'RECEBIDO'
  END AS Status,
  i.data,
  i.id_professor,
  u.nome AS Solicitante,
  u2.nome AS Executor
  FROM impressao i
LEFT JOIN produtos p ON p.id = i.id_produto
LEFT JOIN usuarios u ON i.id_professor = u.id
LEFT JOIN usuarios u2 ON i.status = u2.id
WHERE i.status IN (0, 1, 2, 3, 4, 5, 8)
  AND EXTRACT(MONTH FROM i.data) = '$mes'
  AND EXTRACT(YEAR FROM i.data) = '$ano'
  AND i.id_unidade = '$VarUnidade';
  ";
  // Executar a consulta
  $result = mysqli_query($conn, $sql2);


  // Obter os resultados da consulta
  $rows = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  // Fechar a conexão com o banco de dados
  mysqli_close($conn);

  // Retornar os resultados da consulta
  return $rows;
}

function getUnidade() {
include("../conexao_bd.php");
 $VarUnidade = $_SESSION['s_unidade'];
 $sql = "SELECT * FROM unidades WHERE id = '$VarUnidade'";
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 $VarUnidadeNome = $row['name'];
 return $VarUnidadeNome;
}

function getSaldo(){
  include("../conexao_bd.php");
  
  $VarUnidade = $_SESSION['s_unidade'];
  $sql = "SELECT
  impressao.id_unidade,
  impressao.id,
  SUM(impressao.quantidade) AS totquantidade,
  produtos.valor_unidade AS valortotal,
  SUM(impressao.quantidade * produtos.valor_unidade) AS valortotal,
  usuarios.nome AS nome_professor,
  (SELECT name FROM unidades WHERE id = impressao.id_unidade) AS unidade_nome
FROM impressao
JOIN produtos ON impressao.id_produto = produtos.id
JOIN usuarios ON impressao.id_professor = usuarios.id
WHERE impressao.id_unidade = '$VarUnidade'
AND impressao.status IN (0, 1, 3, 4, 8)";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $sql_unidade = "SELECT * FROM unidades WHERE id = '$VarUnidade'";
  $result_unidade = mysqli_query($conn, $sql_unidade);
  $row_unidade = mysqli_fetch_assoc($result_unidade);
  $VarSaldo = $row_unidade['value'] - $row['valortotal'];
  $formatedCurrency = number_format($VarSaldo, 4, ',', '.');
  return $formatedCurrency;
}
?>