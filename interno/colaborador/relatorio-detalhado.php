<?php
include_once("../conexao_bd.php");

if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['s_login'])) {
    session_destroy();
    header("Location:logout.php");
    exit;
}
$VarID    = $_SESSION['s_id'];
$VarLogin = $_SESSION['s_login'];
$VarNome  = $_SESSION['s_nome'];
$VarNivel = $_SESSION['s_nivel'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Relatorio detalhado</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
}
</style>

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
                    <li class="active"><a href="relatorio-detalhado.php">Relatório detalhado</a></li>
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
    <div class="container">
        <h1>Pesquisar</h1>
        <form method="POST" class="row" action="resultado-novo-relatorio.php">
            <div class="form-group form-group-multiple-selectsp col-xs-11 col-sm-8 col-md-5 ">
                <div class="input-group input-group-multiple-selectp col-xs-8">
                    <select class="form-control" name="ano" required>
                        <option value="">Selecione o Ano</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                    </select>

                </div>
            </div>
            <div class="form-group form-group-multiple-selectsp col-xs-11 col-sm-8 col-md-4 ">
                <div class="input-group input-group-multiple-selectp col-xs-8">

                    <select class="form-control" name="mes" required>
                        <option value="">Selecione o mês</option>
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>


                    </select>

                </div>

            </div>
            <div class="form-group form-group-multiple-selectsp col-xs-11 col-sm-8 col-md-4 ">
                <div class="input-group">
                    <label for="">Status</label>
                    <select class="form-control" name="status">
                        <option value="all">TODOS</option>
                        <option value="4">Concluido</option>
                        <option value="1">Confirmado</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-danger"> Consultar
            </button>
    </div>
    </div>
    </div>
    </div>
    </form>

</body>

</html>