<?php

include_once("../conexao_bd.php");
//include_once("pesquisar_date.php");


if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['s_login'])) {

	session_destroy();

	header("Location:logout.php"); exit;



}

$VarID    = $_SESSION['s_id'];

$VarLogin = $_SESSION['s_login'];

$VarNome  = $_SESSION['s_nome'];

$VarNivel = $_SESSION['s_nivel'];


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

                    <li class="active"><a href="solicitados.php">SOLICITADOS</a></li>

                    <li><a href="usuarios.php">USUÁRIOS</a></li>

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

    <div class="table-wrapper">

        <div class="table-title">

            <div class="row">

                <div class="col-sm-6">

                    <h2>Serviços Concluidos</b></h2>

                </div>

                <div class="col-sm-6">

                    <div class="row ">





                        <div class="rounded-btn">

                            <a href="relatorio.php"><button class="btn btn-lg btn-success" target="_blank"><i
                                        class="material-icons">&#xE147;</i>Extrair Relatório</button></a>


                            <a href="#"><button class="btn btn-lg btn-success">CUVG</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FAACC</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FAAZ</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FACC</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FAEN</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FAET</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FAGEO</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FANUT</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FAVET</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FD</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FE</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FEF</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FENF</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">FM</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">IB</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">IC</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">ICET</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">ICHS</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">IE</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">IGHD</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">IL</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">ISC</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">PRAE</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">PROADI</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">PROCEV</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">PROEG</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">PROPG</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">PROPLAN</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">PROPEQ</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">Reitoria</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">SECRI</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">SECOM</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">SETEC</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">SGP</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">STI</button></a>
                            <a href="#"><button class="btn btn-lg btn-success">ViceReitoria</button></a>





                        </div>

                    </div>

                </div>



            </div>

        </div>

        <table class="table table-striped table-hover" id="product_data">

            <thead>

                <tr>


                    <th>Unidade</th>


                    <th>Código</th>

                    <th>Serviço</th>

                    <th>Quantidade total</th>

                    <th>Valor Unitário</th>

                    <th>Total</th>
                </tr>

            </thead>

            <tbody>

                <?php

$result_impres = "SELECT
impressao.id_unidade,
sum(impressao.quantidade) as totquantidade,
produtos.valor_unidade as valortotal,
sum(impressao.quantidade*produtos.valor_unidade) as valortotal,
impressao.id_produto,produtos.descricao_prod, produtos.valor_unidade, produtos.codigo,

case When impressao.id_unidade = 1 then 'CUVG'
When impressao.id_unidade = 2 then 'FAACC'
When impressao.id_unidade = 3 then 'FAAZ'
When impressao.id_unidade = 4 then 'FACC'
When impressao.id_unidade = 5 then 'FAEN'
When impressao.id_unidade = 6 then 'FAET'
When impressao.id_unidade = 7 then 'FAGEO'
When impressao.id_unidade = 8 then 'FANUT'
When impressao.id_unidade = 9 then 'FAVET'
When impressao.id_unidade = 10 then 'FD'
When impressao.id_unidade = 11 then 'FE'
When impressao.id_unidade = 12 then 'FEF'
When impressao.id_unidade = 13 then 'FENF'
When impressao.id_unidade = 14 then 'FM'
When impressao.id_unidade = 15 then 'IB'
When impressao.id_unidade = 16 then 'IC'
When impressao.id_unidade = 17 then 'ICET'
When impressao.id_unidade = 18 then 'ICHS'
When impressao.id_unidade = 19 then 'IE'
When impressao.id_unidade = 20 then 'IGHD'
When impressao.id_unidade = 21 then 'IL'
When impressao.id_unidade = 22 then 'ISC'
When impressao.id_unidade = 23 then 'PRAE'
When impressao.id_unidade = 24 then 'PROADI'
When impressao.id_unidade = 25 then 'PROCEV'
When impressao.id_unidade = 26 then 'PROEG'
When impressao.id_unidade = 27 then 'PROPG'
When impressao.id_unidade = 28 then 'PROPLAN'
When impressao.id_unidade = 29 then 'PROPEQ'
When impressao.id_unidade = 30 then 'Reitoria'
When impressao.id_unidade = 31 then 'SECRI'
When impressao.id_unidade = 32 then 'SECOM'
When impressao.id_unidade = 33 then 'SETEC'
When impressao.id_unidade = 34 then 'SGP'
When impressao.id_unidade = 35 then 'STI'
When impressao.id_unidade = 36 then 'ViceReitoria'
end as unidade
FROM impressao, produtos
WHERE impressao.status=4
AND impressao.id_produto = produtos.id
AND extract(month FROM impressao.data_inicio)='$mes'
AND extract(year FROM impressao.data_inicio)='$ano'
group by 1,5
order by 1
";
$resultado_impres = mysqli_query($conn, $result_impres);

?>



                <?php while($rows_impres = mysqli_fetch_assoc($resultado_impres)){ 

	?>

                <tr style="font-size: 12px">


                    <td><?php echo $rows_impres['unidade']; ?></td>

                    <td><?php echo $rows_impres['codigo']; ?></td>

                    <td><?php echo $rows_impres['descricao_prod']; ?></td>

                    <td><?php echo $rows_impres['totquantidade']; ?></td>

                    <td> R$<?php echo $rows_impres['valor_unidade']; ?></td>

                    <td> R$<?php echo $rows_impres['valortotal']; ?></td>



                </tr>

                <?php }?>



            </tbody>

        </table>



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



                    <form method="POST" action="update_envio.php" enctype="multipart/form-data">



                        <div class="form-group">

                            <label>QUANTIDADE</label>

                            <input type="text" class="form-control" required name="quantidade" id="quantidade"
                                onkeyup="somenteNumeros(this);">

                        </div>

                        <div class="form-group">

                            <label>DESCRIÇÃO</label>

                            <input type="text" class="form-control" required name="descricao" id="descricao">

                        </div>





                        <input name="id" type="hidden" class="form-control" id="id" value="">

                        <select name="descricao_prod" class="browser-default custom-select my-3" id="">

                            <option selected>Tipo de impressão</option>



                            <?php

						$result_produtos = "SELECT * FROM produtos WHERE status = '0'";

						$resultado_produtos = mysqli_query($conn, $result_produtos);

						while($row_produtos = mysqli_fetch_assoc($resultado_produtos)){ ?>

                            <option value="<?php echo $row_produtos['descricao_prod']; ?>">

                                <?php echo $row_produtos['descricao_prod'];?></option> <?php

							}

							?>

                        </select>

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







    <div id="deleteEmployeeModal" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="POST" action="recusar.php">

                    <div class="modal-header">

                        <h4 class="modal-title"></h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    </div>

                    <div class="modal-body">

                        <p>Tem certeza que deseja deletar o solicitação selecionada?</p>

                        <input type="hidden" class="form-control" id="id" name="id">

                        <input name="descricao_prod" type="hidden" class="form-control" id="descricao_prod">

                        <input name="Solicitante" type="hidden" class="form-control" id="Solicitante">

                        <input name="codigo" type="hidden" class="form-control" id="codigo">



                        <p class="text-warning">

                            <small>Fazendo isso você recusará a solicitação permanentemente</small>
                        </p>

                    </div>

                    <div class="modal-footer">

                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                        <input type="submit" class="btn btn-danger" value="Recusar">

                    </div>

                </form>

            </div>

        </div>

    </div>



    <div id="confirmar" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="POST" action="confirmar.php">

                    <div class="modal-header">

                        <h4 class="modal-title"></h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    </div>

                    <div class="modal-body">

                        <p>Confirmar solicitação?</p>

                        <input type="hidden" class="form-control" id="id" name="id">

                        <input name="descricao_prod" type="hidden" class="form-control" id="descricao_prod">

                        <input name="Solicitante" type="hidden" class="form-control" id="Solicitante">

                        <input name="codigo" type="hidden" class="form-control" id="codigo">





                        <p class="text-warning">

                            <small>Ao confirmar essa solitação, o serviço será encaminhado direto para a Fabri Gráfica
                                Digital</small>
                        </p>

                    </div>

                    <div class="modal-footer">

                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

                        <input type="submit" class="btn btn-success" value="Confirmar">

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

    <script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var recipient = button.data('whatever') // Extract 

        var recipientnome = button.data('whatevernome')

        var recipientcodigo = button.data('whatevercodigo')

        var recipientquantidade = button.data('whateverquantidade')

        var recipientdescricao = button.data('whateverdescricao')

        var recipientdescricao_prod = button.data('whateverdescricao_prod')



        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        var modal = $(this)

        modal.find('.modal-title').text('Solicitação de:' + recipientnome)

        modal.find('#id').val(recipient)

        modal.find('#recipient-codigo').val(recipientcodigo)

        modal.find('#quantidade').val(recipientquantidade)

        modal.find('#descricao').val(recipientdescricao)

        modal.find('#descricao_prod').val(recipientdescricao_prod)



    })
    </script>

    <script type="text/javascript">
    $('#deleteEmployeeModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var recipient = button.data('whatever') // Extract 

        var recipientnome = button.data('whatevernome')

        var recipientquantidade = button.data('whateverquantidade')

        var recipientdescricao = button.data('whateverdescricao')

        var recipientdescricao_prod = button.data('whateverdescricao_prod')





        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        var modal = $(this)

        modal.find('.modal-title').text('Solicitação de:' + recipientnome)

        modal.find('#id').val(recipient)

        modal.find('#recipient-codigo').val(recipientcodigo)

        modal.find('#quantidade').val(recipientquantidade)

        modal.find('#descricao').val(recipientdescricao)

        modal.find('#descricao_prod').val(recipientdescricao)



    })
    </script>

    <script type="text/javascript">
    $('#confirmar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var recipient = button.data('whatever') // Extract 

        var recipientnome = button.data('whatevernome')

        var recipientquantidade = button.data('whateverquantidade')

        var recipientdescricao = button.data('whateverdescricao')

        var recipientdescricao_prod = button.data('whateverdescricao_prod')

        var recipientdisponivel = button.data('whateverdisponivel')





        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        var modal = $(this)

        modal.find('.modal-title').text('Confirmar solicitação de:' + recipientnome)

        modal.find('#id').val(recipient)

        modal.find('#recipient-codigo').val(recipientcodigo)

        modal.find('#quantidade').val(recipientquantidade)

        modal.find('#descricao').val(recipientdescricao)

        modal.find('#descricao_prod').val(recipientdescricao)

        modal.find('#disponivel').val(recipientdisponivel)



    })
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



    <!-- Importando o js do bootstrap -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>



</body>

</html>