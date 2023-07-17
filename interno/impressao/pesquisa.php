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

 $sql_unidades = "SELECT * FROM unidades";
$result = mysqli_query($conn, $sql_unidades);

$optionsArray = [];
while ($row = mysqli_fetch_assoc($result)) {
    $optionsArray[] = $row;
}

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
                    <li><a href="unidades.php">UNIDADES</a></li>
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
                                <option value="all">TODOS</option>
                                <?php foreach ($optionsArray as $option) : ?>
                                <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
                                <?php endforeach; ?>
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
                    <div class="form-group col-md-2">
                        <div class="input-group">
                            <label for="">Status</label>
                            <select class="form-control" name="status">
                                <option value="all">TODOS</option>
                                <option value="4">Concluido</option>
                                <option value="8">Recebidos</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group  col-md-2">
                        <div class="input-group">
                            <label for="">Data</label>
                            <input required class="form-control" type="month" id="start" name="data" min="2023-07"
                                value="2023-07">
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