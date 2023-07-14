
  <?php

include_once("../conexao_bd.php");

 $VarID    = $_SESSION['s_id'];

 $VarLogin = $_SESSION['s_login'];

 $VarNome  = $_SESSION['s_nome'];

 $VarNivel = $_SESSION['s_nivel'];


$disponivel = $_POST['disponivel'];

$id = mysqli_real_escape_string($conn, $_POST['id']);

$result_produtos = "UPDATE impressao SET status = '1', data=NOW() WHERE id = '$id' AND NOT status = '4' "; 

$resultado_produtos = mysqli_query($conn, $result_produtos);

echo '<script>location.href="solicitados.php"</script>';

?>



