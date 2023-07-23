<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function getSaldo() {
include("../conexao_bd.php");

$sql = "SELECT
  u.id AS id_unidade,
  u.name AS nome_unidade,
  u.value AS valor_unidade,
  COALESCE(SUM(i.quantidade * p.valor_unidade), 0) AS saldo_gasto
FROM
  unidades u
LEFT JOIN impressao i ON u.id = i.id_unidade
LEFT JOIN produtos p ON i.id_produto = p.id AND i.status IN (0, 1, 3, 4, 8)
GROUP BY
  u.id, u.name";

    // Executar a consulta
    $result = mysqli_query($conn, $sql);

    // Obter os resultados da consulta
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    return $rows;

}

?>