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

 $result_users = "SELECT * FROM usuarios";
 $resultado_users = mysqli_query($conn, $result_users);

 
?>

<!DOCTYPE html>
<html lang="pt-br">

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
    <script src="./js/report.js"></script>

</head>
<style type="text/css">
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Varela Round', sans-serif;
    font-size: 13px;
}

.d-flex {
    display: flex;
    flex-wrap: wrap;
}

.container-fluid {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
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
    <div class="container">


        <h3>Gerar relatório</h3>
        <div>
            <form method="POST" action="pesquisar_date.php">
                <div class="row">
                    <div class="form-group col-md-2">
                        <div class="input-group">
                            <label for="">Unidade</label>
                            <select id="select" class="form-control" name="unidade">
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <div class="input-group">
                            <label for="">Usuário</label>
                            <select class="form-control" name="usuario">
                                <option value="all">TODOS</option>
                                <?php while($rows_users = mysqli_fetch_assoc($resultado_users)){ ?>
                                <?php echo 
                                "<option value=".$rows_users['id'].">".$rows_users['nome']."</option>"; ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group  col-md-2">
                        <div class="input-group">
                            <label for="">Ano</label>
                            <select class="form-control" name="ano">
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
                    <div class="form-group col-md-2">
                        <div class="input-group">
                            <label for="">Mes</label>
                            <select class="form-control" name="mes">
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

                </div>
                <button type="submit" class="btn btn-danger"> Consultar
                </button>
        </div>
    </div>

    </form>
    </div>
    </div>
</body>
<script>

</script>

</html>