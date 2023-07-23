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

$statusName = "Geral";



$data = $_POST['data'];
$ano = substr($data, 0, 4);
$mes = substr($data, 5, 2);


$unidade = $_POST['unidade'];

$user = $_POST['usuario'];

$status = $_POST['status'];


$month = $mes; {
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

if ($user !== "all") {
  
  $usuarioCondition = "AND impressao.id_professor = '$user'";
} else {
  $usuarioCondition = "";
}

if ($status !== "all") {
    if ($status == "4") {
        $statusName = "Concluído";
    } else if ($status == "8") {
        $statusName = "Recebido";
    } 
  $statusCondition = "AND impressao.status = '$status'";
} else {
  $statusCondition = "";
}

// Verificar se a variável $unidade é diferente de "all"
if ($unidade !== "all") {
  $unidadeCondition = "AND impressao.id_unidade = '$unidade'";
} else {
  $unidadeCondition = "";
}


$result_impres = "SELECT
  impressao.id_unidade,
  impressao.id,
  SUM(impressao.quantidade) AS totquantidade,
  produtos.valor_unidade AS valortotal,
  SUM(impressao.quantidade * produtos.valor_unidade) AS valortotal,
  impressao.id_produto,
  produtos.descricao_prod,
  produtos.valor_unidade,
  produtos.codigo,
  impressao.id_professor,
  usuarios.nome AS nome_professor,
  (SELECT name FROM unidades WHERE id = impressao.id_unidade) AS unidade_nome
FROM impressao
JOIN produtos ON impressao.id_produto = produtos.id
JOIN usuarios ON impressao.id_professor = usuarios.id
WHERE EXTRACT(MONTH FROM impressao.data) = '$mes'
  AND EXTRACT(YEAR FROM impressao.data) = '$ano'
  $unidadeCondition
  $statusCondition
  $usuarioCondition
GROUP BY impressao.id_unidade, impressao.id_produto, produtos.descricao_prod, produtos.valor_unidade, produtos.codigo, impressao.id_professor, usuarios.nome
ORDER BY impressao.id_unidade
";

$resultado_impres = mysqli_query($conn, $result_impres);
$total = 0;

?>







<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administrador</title>



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>





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

                    <li><a href="inicio.php">PRODUTOS</a></li>

                    <li><a href="solicitados.php">SOLICITADOS</a></li>

                    <li><a href="usuarios.php">USUÁRIOS</a></li>

                    <li><a href="solicitar-servicos.php">SOLICITAR SERVIÇO</a></li>


                    <li class="active"><a href="pesquisa.php">RELÁTORIOS</a></li>



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

                    <h2>Serviços <?php echo  $statusName ?></b></h2>
                    <span><?php echo "Relátorio de {$month} {$ano}" ?></span>

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


                    <th>#ID</th>
                    <th>Unidade</th>
                    <th>Solicitante</th>


                    <th>Código</th>

                    <th>Serviço</th>

                    <th>Quantidade total</th>

                    <th>Valor Unitário</th>

                    <th>Total</th>
                </tr>

            </thead>

            <tbody>





                <?php while($rows_impres = mysqli_fetch_assoc($resultado_impres)){
   $total_price += $rows_impres['valortotal'];
  
	?>

                <tr style="font-size: 12px">

                    <td><?php echo $rows_impres['id']; ?></td>

                    <td><?php echo $rows_impres['unidade_nome']; ?></td>
                    <td><?php echo $rows_impres['nome_professor']; ?></td>

                    <td><?php echo $rows_impres['codigo']; ?></td>

                    <td><?php echo $rows_impres['descricao_prod']; ?></td>

                    <td><?php echo $rows_impres['totquantidade']; ?></td>

                    <td>R$<?php echo $rows_impres['valor_unidade']; ?></td>

                    <td> R$<?php echo $rows_impres['valortotal']; ?></td>



                </tr>

                <?php }?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>VALOR TOTAL </td>
                    <td>
                        <strong>R$<?php echo $total_price; ?></strong>
                    </td>
                </tr>


            </tbody>

        </table>



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



    <!-- Importando o js do bootstrap -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>



</body>
<style type="text/css">
.col-sm-6 {

    width: 100%;

}

body {

    color: #566787;

    background: #f5f5f5;

    font-family: 'Varela Round', sans-serif;

    font-size: 13px;

}

.table-wrapper {

    background: #fff;

    padding: 20px 25px;

    margin: 30px 0;

    border-radius: 3px;

    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);

}

.table-title {

    padding-bottom: 15px;

    background: #09a567;

    color: #fff;

    padding: 16px 30px;

    margin: -20px -25px 10px;

    border-radius: 3px 3px 0 0;

}

.table-title h2 {

    margin: 5px 0 0;

    font-size: 24px;

}

.table-title .btn-group {

    float: right;

}

.table-title .btn {

    color: #fff;

    float: right;

    font-size: 13px;

    border: none;

    min-width: 50px;

    border-radius: 2px;

    border: none;

    outline: none !important;

    margin-left: 10px;

}

.table-title .btn i {

    float: left;

    font-size: 21px;

    margin-right: 5px;

}

.table-title .btn span {

    float: left;

    margin-top: 2px;

}

table.table tr th,
table.table tr td {

    border-color: #e9e9e9;

    padding: 12px 15px;

    vertical-align: middle;

}

table.table tr th:first-child {

    width: 10px;

}

table.table tr th:last-child {

    width: 80px;

}

table.table-striped tbody tr:nth-of-type(odd) {

    background-color: #fcfcfc;

}

table.table-striped.table-hover tbody tr:hover {

    background: #f5f5f5;

}

table.table th i {

    font-size: 13px;

    margin: 0 5px;

    cursor: pointer;

}

table.table td:last-child i {

    opacity: 0.9;

    font-size: 22px;

    margin: 0 5px;

}

table.table td a {

    font-weight: bold;

    color: #566787;

    display: inline-block;

    text-decoration: none;

    outline: none !important;

}

table.table td a:hover {

    color: #2196F3;

}

table.table td a.edit {

    color: #FFC107;

}

table.table td a.delete {

    color: #F44336;

}

table.table td i {

    font-size: 19px;

}

table.table .avatar {

    border-radius: 50%;

    vertical-align: middle;

    margin-right: 10px;

}



.hint-text {

    float: left;

    margin-top: 10px;

    font-size: 13px;

}





/* Modal styles */

.modal .modal-dialog {

    max-width: 400px;

}

.modal .modal-header,
.modal .modal-body,
.modal .modal-footer {

    padding: 20px 30px;

}

.modal .modal-content {

    border-radius: 3px;

}

.modal .modal-footer {

    background: #ecf0f1;

    border-radius: 0 0 3px 3px;

}

.modal .modal-title {

    display: inline-block;

}

.modal .form-control {

    border-radius: 2px;

    box-shadow: none;

    border-color: #dddddd;

}

.modal textarea.form-control {

    resize: vertical;

}

.modal .btn {

    border-radius: 2px;

    min-width: 100px;

}

.modal form label {

    font-weight: normal;

}
</style>

</html>