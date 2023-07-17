<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function realizarConsulta($VarID, $mes, $ano) {
include_once("../conexao_bd.php");

  // Consulta SQL
  $sql = "SELECT impressao.id, impressao.descricao, impressao.quantidade, impressao.status,
          produtos.quantidade - (
            SELECT COALESCE(SUM(impressao2.quantidade), 0)
            FROM impressao impressao2 
            WHERE (impressao2.status = 1 OR impressao2.status = 3 OR impressao2.status = 4) 
            AND EXTRACT(MONTH FROM impressao2.data) = '$mes'
            AND EXTRACT(YEAR FROM impressao2.data) = '$ano' 
            AND impressao2.id_produto = impressao.id_produto
          ) AS disponivel,
          impressao.id_produto, impressao.data_inicio, produtos.descricao_prod, produtos.codigo,
          CASE 
            WHEN impressao.status = 0 THEN 'AGUARDANDO'
            WHEN impressao.status = 1 THEN 'CONFIRMADO'
            WHEN impressao.status = 2 THEN 'RECUSADO'
            WHEN impressao.status = 3 THEN 'EXECUTANDO'
            WHEN impressao.status = 4 THEN 'CONCLUÍDO'
            WHEN impressao.status = 5 THEN 'CANCELADO'
            WHEN impressao.status = 8 THEN 'RECEBIDO'
          END AS Status,
          impressao.data, impressao.id_professor, usuarios.nome AS Solicitante, usuarios2.nome AS Executor
          FROM impressao
          LEFT JOIN produtos ON produtos.id = impressao.id_produto
          LEFT JOIN usuarios ON impressao.id_professor = usuarios.id
          LEFT JOIN usuarios usuarios2 ON impressao.status = usuarios2.id
          WHERE NOT impressao.status = 5 AND usuarios.id = '$VarID' AND NOT produtos.status = 1";

  // Executar a consulta
  $result = mysqli_query($conn, $sql);



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
?>