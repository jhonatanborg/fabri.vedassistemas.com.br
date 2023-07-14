<?php

if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['s_login'])) {

  session_destroy();

  header("Location:logout.php"); exit;



}
include_once("../conexao_bd.php");

 $VarID    = $_SESSION['s_id'];

 $VarLogin = $_SESSION['s_login'];

 $VarNome  = $_SESSION['s_nome'];

 $VarNivel = $_SESSION['s_nivel'];

$mes = date ("m");

 $ano = date ("Y");

?>







<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
    body {

        color: #566787;

        background: #f5f5f5;

        font-family: 'Roboto', sans-serif;

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

        background: #435d7d;

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

        width: 60px;

    }

    table.table tr th:last-child {

        width: 100px;

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

                    <li class="active"><a href="inicio.php">PRODUTOS</a></li>
                    <li><a href="unidades.php">UNIDADES</a></li>

                    <li><a href="solicitados.php">SOLICITADOS</a></li>
                    <li><a href="unidades.php">SOLICITADOS</a></li>

                    <li><a href="solicitar-servicos.php">SOLICITAR SERVIÇO</a></li>

                    <li><a href="pesquisa.php">RELÁTORIOS</a></li>



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

        <div class="table-wrapper">

            <div class="table-title">

                <div class="row">

                    <div class="col-sm-6">

                        <h2>Serviços</b></h2>

                    </div>

                    <div class="col-sm-6">

                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                class="material-icons">&#xE147;</i> <span>Novo Serviço</span></a>



                    </div>

                </div>

            </div>

            <table class="table table-striped table-hover">

                <thead>

                    <tr>



                        <th>Código</th>

                        <th>Quantidade</th>

                        <th>Valor UNIT(R$)</th>


                        <th>Descrição</th>

                        <th>Ação</th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                		$result_produtos = "SELECT * FROM produtos WHERE status ='0'ORDER BY id DESC";

                	    $resultado_produtos = mysqli_query($conn, $result_produtos);



                     ?>





                    <?php while($rows_produto = mysqli_fetch_assoc($resultado_produtos)){ ?>

                    <tr>



                        <td><?php echo $rows_produto['codigo']; ?></td>

                        <td><?php echo $rows_produto['quantidade']; ?></td>

                        <td>R$<?php echo $rows_produto['valor_unidade']; ?></td>

                        <td><?php echo $rows_produto['descricao_prod']; ?></td>



                        <td>



                            <a href="#" class="edit"><i type="button" class="material-icons orange600"
                                    data-toggle="modal" title="Edit" data-target="#exampleModal"
                                    data-whatever="<?php echo $rows_produto['id']; ?>"
                                    data-whatevercodigo="<?php echo $rows_produto['codigo']; ?>"
                                    data-whateverquantidade="<?php echo $rows_produto['quantidade'];?>"
                                    data-whatevervalor_unidade="<?php echo $rows_produto['valor_unidade'];?>"
                                    data-whateverdescricao="<?php echo $rows_produto['descricao_prod']; ?>">
                                    &#xE254;</i></a>





                            <a href="#" class="delete"><i type="button" class="material-icons" data-toggle="modal"
                                    title="Delete" data-target="#deleteEmployeeModal"
                                    data-whatever="<?php echo $rows_produto['id']; ?>"
                                    data-whatevercodigo="<?php echo $rows_produto['codigo']; ?>"
                                    data-whateverquantidade="<?php echo $rows_produto['quantidade'];?>"
                                    data-whatevervalor_unidade="<?php echo $rows_produto['valor_unidade'];?>"
                                    data-whateverdescricao="<?php echo $rows_produto['descricao_prod']; ?>">&#xE872;</i></a>



                        </td>

                    </tr>

                    <?php }?>





                </tbody>

            </table>



        </div>

    </div>

    <!-- Edit Modal HTML -->

    <div id="addEmployeeModal" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="POST" action="cad_prod.php">

                    <div class="modal-header">

                        <h4 class="modal-title">Adicionar Serviço</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    </div>

                    <div class="modal-body">

                        <div class="form-group">

                            <label>CÓDIGO</label>

                            <input type="text" class="form-control" required name="codigo" id="codigo"
                                onkeyup="somenteNumeros(this);">

                        </div>



                        <div class="form-group">

                            <label>QUANTIDADE</label>

                            <input type="text" class="form-control" required name="quantidade"
                                onkeyup="somenteNumeros(this);">

                        </div>
                        <div class="form-group">

                            <label>Valor Unitario</label>

                            <input type="text" class="form-control" required name="valor_unidade"
                                onkeyup="somenteNumeros(this);">

                        </div>


                        <div class="form-group">

                            <label>DESCRIÇÃO</label>

                            <input type="text" class="form-control" required name="descricao_prod">

                        </div>





                    </div>

                    <div class="modal-footer">

                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">

                        <input type="submit" class="btn btn-success" value="Confirmar">

                    </div>

                </form>

            </div>

        </div>

    </div>

    <!-- Edit Modal HTML -->

    <div id="exampleModal" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="modal-title"></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>

                <div class="modal-body">



                    <form method="POST" action="send_update.php" enctype="multipart/form-data">

                        <div class="form-group">

                            <label>CÓDIGO</label>

                            <input type="text" class="form-control" name="codigo" required id="recipient-codigo">

                        </div>

                        <div class="form-group">

                            <label>QUANTIDADE</label>

                            <input type="text" class="form-control" required name="quantidade" id="quantidade"
                                onkeyup="somenteNumeros(this);">

                        </div>
                        <div class="form-group">

                            <label>Valor Unidade</label>

                            <input type="text" class="form-control" required name="valor_unidade" id="valor_unidade">

                        </div>

                        <div class="form-group">

                            <label>DESCRIÇÃO</label>

                            <input type="text" class="form-control" required name="descricao_prod" id="descricao">

                        </div>



                        <input name="id" type="hidden" class="form-control" id="id" value="">





                        <div class="modal-footer">

                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">

                            <input type="submit" class="btn btn-info" value="Salvar">

                    </form>

                </div>



            </div>



        </div>

    </div>

    </div>

    </div>

    <!-- Delete Modal HTML -->

    <div id="deleteEmployeeModal" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="POST" action="delete.php">

                    <div class="modal-header">

                        <h4 class="modal-title">Deletar serviço</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    </div>

                    <div class="modal-body">

                        <p>Tem certeza que deseja deletar o serviço selecionado?</p>

                        <input type="hidden" class="form-control" id="id" name="id">

                        <p class="text-warning">

                            <small>Fazendo isso você deleterá o serviço permanentemente</small>
                        </p>

                    </div>

                    <div class="modal-footer">

                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                        <input type="submit" class="btn btn-danger" value="Delete">

                    </div>

                </form>

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

    <script>
    function somenteNumeros(num) {

        var er = /[^0-9.,]/;


        var campo = num;

        if (er.test(campo.value)) {

            campo.value = "";

        }

    }
    </script>

    <script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var recipient = button.data('whatever') // Extract

        var recipientcodigo = button.data('whatevercodigo')

        var recipientquantidade = button.data('whateverquantidade')

        var recipientvalor_unidade = button.data('whatevervalor_unidade')


        var recipientdescricao = button.data('whateverdescricao')



        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        var modal = $(this)

        modal.find('.modal-title').text('Código:' + recipientcodigo)

        modal.find('#id').val(recipient)

        modal.find('#recipient-codigo').val(recipientcodigo)

        modal.find('#quantidade').val(recipientquantidade)

        modal.find('#valor_unidade').val(recipientquantidade)


        modal.find('#descricao').val(recipientdescricao)

    })
    </script>

    <script type="text/javascript">
    $('#deleteEmployeeModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var recipient = button.data('whatever') // Extract

        var recipientcodigo = button.data('whatevercodigo')

        var recipientquantidade = button.data('whateverquantidade')

        var recipientvalor_unidade = button.data('whatevervalor_unidade')

        var recipientdescricao = button.data('whateverdescricao')



        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        var modal = $(this)

        modal.find('.modal-title').text('Código:' + recipientcodigo)

        modal.find('#id').val(recipient)

        modal.find('#recipient-codigo').val(recipientcodigo)

        modal.find('#quantidade').val(recipientquantidade)

        modal.find('#valor_unidade').val(recipientvalor_unidade)

        modal.find('#descricao').val(recipientdescricao)

    })
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>



</body>

</html>