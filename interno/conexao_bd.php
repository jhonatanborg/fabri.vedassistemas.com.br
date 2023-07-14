<?php

$host = "vedassistemas.com.br";
$usuario = "vedas213_AdmD";
$senha = "12345";
//$bd = "vedas213_acesso";
$bd = "vedas213_UfmtCuiaba";

$conn = new mysqli($host, $usuario, $senha, $bd);


if($conn->connect_errno) 
	echo "Erro ao se conectar: (".$conn->connect_errno.") ".$conn->connect_error;
	 
?>