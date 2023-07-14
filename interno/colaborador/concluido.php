  <?php

include_once("../conexao_bd.php");




$VarID    = $_SESSION['s_id'];

 $VarLogin = $_SESSION['s_login'];

 $VarNome  = $_SESSION['s_nome'];

 $VarNivel = $_SESSION['s_nivel'];





$id = mysqli_real_escape_string($conn, $_POST['id']);

$result_produtos = "UPDATE impressao SET status = '4', data=NOW() WHERE id = '$id'"; 

$resultado_produtos = mysqli_query($conn, $result_produtos);



echo '<script>location.href="index.php"</script>';



?>

