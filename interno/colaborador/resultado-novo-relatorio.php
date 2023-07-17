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


$mes = $_POST['mes'];
$ano = $_POST['ano'];
$status = $_POST['status'];

$statusCondition = "";

if ($status !== "all") {
  $statusCondition = "AND impressao.status = '$status'";
} else {
  $statusCondition = "";
};
$month = $_POST['mes']; {
    switch ($month) {
        case "1":
            $month = "JANEIRO";
            break;
        case "2":
        $month ="FEVEREIRO";
            break;
        case "3":
        $month = "MARÇO";
            break;
        case "4":
        $month = "ABRIL";
            break;
        case "5":
        $month = "MAIO";
            break;
        case "6":
        $month = "JUNHO";
            break;
        case "7":
        $month = "JULHO";
            break;
        case "8":
        $month = "AGOSTO";
            break;
        case "9":
        $month = "SETEMBRO";
            break;
        case "10":
        $month = "OUTUBRO";
            break;
        case "11":
        $month = "NOVEMBRO";
            break;
        case "12":
        $month = "DEZEMBRO";
            break;
        default:
        $month = "erro";
    }
}
function formatCurrency($value){
   // string R$ + number_format
 return "R$ " . number_format($value, '4', ',','.');

};
$result_impres = "SELECT
  impressao.id_unidade,
  SUM(impressao.quantidade) AS totquantidade,
  produtos.valor_unidade AS valortotal,
  SUM(impressao.quantidade * produtos.valor_unidade) AS valortotal,
  impressao.id_produto,
  produtos.descricao_prod,
  produtos.valor_unidade,
  produtos.codigo,
  impressao.id_professor,
  usuarios.nome AS nome_professor,
  unidades.name as unidade_nome,
  impressao.status
FROM impressao
JOIN produtos ON impressao.id_produto = produtos.id
JOIN usuarios ON impressao.id_professor = usuarios.id
JOIN unidades ON usuarios.unidade = unidades.id
WHERE  EXTRACT(MONTH FROM impressao.data) = '$mes'
  AND EXTRACT(YEAR FROM impressao.data) = '$ano'
  AND impressao.status = '4'
  $statusCondition
GROUP BY impressao.id_unidade, impressao.id_produto, produtos.descricao_prod, produtos.valor_unidade, produtos.codigo, impressao.id_professor, usuarios.nome
ORDER BY impressao.id_unidade LIMIT 0,100
";

$resultado_impres = mysqli_query($conn, $result_impres);
$total = 0;
$total_price =0;

function Status($status) {
	switch($status){
        case 1:
            return "CONFIRMADO";
          
        case 4:
            return "CONCLUIDO";
    }
}
?>







<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Coordenador</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../administrador/css/style.css">


</head>

<body>

    <!-- Static navbar -->

    <nav class="navbar navbar-default">

        <div class="container-fluid">

            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a class="navbar-brand" href="#">Fabri Gráfica Digital</a>

            </div>

            <div id="navbar" class="navbar-collapse collapse">

                <ul class="nav navbar-nav">

                    <li><a href="index.php">INICIO</a></li>
                    <li class="active"><a href="relatorio-detalhado.php">Relatorio detalhado</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><?php echo "$VarNome"; ?></a></li>

                    <li><a href="../administrador/logout.php">SAIR</a></li>

                </ul>

            </div>
            <!--/.nav-collapse -->

        </div>
        <!--/.container-fluid -->

    </nav>

    <div class="table-wrapper">

        <div class="table-title">

            <div class="row">

                <div class="col-sm-6">
                    <h5> Serviços concluidos mês <?php echo $month ?></h5>
                </div>
                <div class="col-sm-6">

                    <div class="row ">


                        <div class="rounded-btn">

                            <a href='javascript:window.print()'><button class="btn btn-lg btn-success"
                                    target="_blank"><i class="material-icons">&#xE147;</i>Extrair Relatório</button></a>
                        </div>

                    </div>

                </div>



            </div>

        </div>


        <table class="table table-striped table-hover" id="product_data">

            <thead>

                <tr>

                    <th style="width: 140px;">Codigo</th>
                    <th>Solicitante</th>
                    <th>Quantidade</th>
                    <th>Serviço</th>
                    <th>Valor unidade</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>



                <?php while($rows_impres = mysqli_fetch_assoc($resultado_impres)){
                 $total_price += $rows_impres['valortotal'];
	?>

                <tr style="font-size: 12px">

                    <td><?php echo $rows_impres['codigo']; ?></td>
                    <td><?php echo $rows_impres['nome_professor']; ?></td>
                    <td><?php echo $rows_impres['totquantidade']; ?></td>
                    <td><?php echo $rows_impres['descricao_prod']; ?></td>
                    <td>R$ <?php echo $rows_impres['valor_unidade']; ?></td>
                    <td> R$ <?php echo $rows_impres['valortotal']; ?></td>
                    <td><?php echo Status($rows_impres['status']); ?></td>
                </tr>

                <?php }?>
            </tbody>
        </table>
        <div class="row justify-end">
            <div class="col-sm-5">
                <span>Total</span>
                <h5><?php echo formatCurrency($total_price) ?></h5>
            </div>
        </div>
    </div>

    </div>
    <footer>

        <div class="footer" id="footer">

            <div class="container">

                <p class="pull-left"> Copyright © Vedas Sistemas 2019. Todos os direitos reservados. </p>
            </div>

        </div>

        </div>

    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>


</body>

</html>