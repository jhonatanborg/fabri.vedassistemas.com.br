  <?php



include_once("../conexao_bd.php");




$id = mysqli_real_escape_string($conn, $_POST['id']);

$result_produtos = "UPDATE impressao SET status = '2', data=NOW() WHERE id = '$id'"; 

$resultado_produtos = mysqli_query($conn, $result_produtos);


echo '<script>location.href="index.php"</script>';


?>

