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





$ANO = date('y');

$MES = date('m');



?>







<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Colaborador</title>

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

    font-family: 'Varela Round', sans-serif;

    font-size: 13px;

  }

  .table-wrapper {

        background: #fff;

        padding: 20px 25px;

        margin: 30px 0;

    border-radius: 3px;

        box-shadow: 0 1px 1px rgba(0,0,0,.05);

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

    table.table tr th, table.table tr td {

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

  .modal .modal-header, .modal .modal-body, .modal .modal-footer {

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

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

              <span class="sr-only">Toggle navigation</span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

              <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand" href="#">Fabri Gráfica Digital</a>

          </div>

          <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav">

              <li class="active"><a href="index.php">INICIO</a></li>
              <li><a href="relatorio-detalhado.php">Relatório detalhado</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

             

             

              <li><a href="#"><?php echo "$VarNome"; ?></a></li>

              <li><a href="../administrador/logout.php">SAIR</a></li>

            </ul>

          </div><!--/.nav-collapse -->

        </div><!--/.container-fluid -->

      </nav>

        <div class="table-wrapper">

            <div class="table-title">

                <div class="row">

                    <div class="col-sm-6">

            <h2>Serviços Confirmados</b></h2>

          </div>

         

                </div>

            </div>

            <table class="table table-striped table-hover">

                <thead>

                    <tr>

                        <th  style="width: 140px">Data Inicio</th>

                        <th>Código</th>

                        <th>Solicitante</th>

                        <th>Quantidade</th>

                        <th>Disponivel</th>

                        <th>Descrição</th>    

                        <th>Serviço</th>

                        <th>Atualização</th>

                        <th>Status</th>

                        <th>Ação</th>     

                    </tr>

                </thead>

                <tbody>

                   <?php


    $result_impres= "SELECT impressao.id,impressao.descricao,

impressao.quantidade,impressao.status,



produtos.quantidade-

(select coalesce(sum(impressao2.quantidade),0) from impressao impressao2 

    where (impressao2.status=1 or

impressao2.status=3 or impressao2.status=4) and extract(month FROM impressao2.data)='$MES'

and extract(year FROM impressao2.data)=' $ANO' and impressao2.id_produto=impressao.id_produto)



as disponivel,

impressao.id_produto,impressao.data_inicio,produtos.descricao_prod, produtos.codigo,

case when impressao.status=0 then 'AGUARDANDO'

when impressao.status=1 then 'CONFIRMADO'

when impressao.status=2 then 'RECUSADO'

when impressao.status=3 then 'EXECUTANDO'

when impressao.status=4 then 'CONCLUÍDO' end as Status,

impressao.data, impressao.id_professor, usuarios.nome as Solicitante, usuarios2.nome as Executor FROM impressao

left join produtos on (produtos.id=impressao.id_produto)

left join usuarios on (impressao.id_professor = usuarios.id)

left join usuarios usuarios2 on (impressao.status = usuarios2.id)

WHERE  impressao.status=1 OR impressao.status = 3

ORDER BY 1 DESC";

    $resultado_impres = mysqli_query($conn, $result_impres);

    ?>



    <?php while($rows_impres = mysqli_fetch_assoc($resultado_impres)){ 

    ?>

            <tr>

            <td><?php echo $rows_impres['data_inicio']; ?></td>

            <td><?php echo $rows_impres['codigo']; ?></td>

            <td><?php echo $rows_impres['Solicitante']; ?></td>

            <td><?php echo $rows_impres['quantidade']; ?></td>

            <td><?php echo $rows_impres['disponivel']; ?></td>

            <td><?php echo $rows_impres['descricao']; ?></td>  

            <td><?php echo $rows_impres['descricao_prod']; ?></td> 

           <td><?php echo $rows_impres['data']; ?></td>

          <td><?php echo $rows_impres['Status']; ?></td>


                        <td>

                   





<a href="#" class="delete"><i type="button" class="fa fa-print" data-toggle="modal" title="Executando"

data-target="#deleteEmployeeModal"

data-whatever="<?php echo $rows_impres['id']; ?>" 

data-whatevernome="<?php echo $rows_impres['Solicitante']; ?>" 

data-whatevercodigo="<?php echo $rows_impres['codigo']; ?>"

data-whateverquantidade="<?php echo $rows_impres['quantidade'];?>"

data-whateverdescricao="<?php echo $rows_impres['descricao']; ?>"

data-whateverdescricao_prod="<?php echo $rows_impres['descricao_prod']; ?>"



></i></a> 

<a href="#" class="send"><i class="fa fa-check" type="button" class="material-icons" data-toggle="modal" title="Concluir"

data-target="#confirmar"

data-whatever="<?php echo $rows_impres['id']; ?>" 

data-whatevernome="<?php echo $rows_impres['Solicitante']; ?>" 

data-whatevercodigo="<?php echo $rows_impres['codigo']; ?>"

data-whateverquantidade="<?php echo $rows_impres['quantidade'];?>"

data-whateverdescricao="<?php echo $rows_impres['descricao']; ?>"

data-whateverdescricao_prod="<?php echo $rows_impres['descricao_prod']; ?>"

>

</i></a>





                        </td>

                         </tr>

                  <?php }?>

        

                </tbody>

            </table>

      

        </div>

    </div>




  <div id="deleteEmployeeModal" class="modal fade">

    <div class="modal-dialog">

      <div class="modal-content">

        <form method="POST" action="executando.php">

          <div class="modal-header">            

            <h4 class="modal-title"></h4>

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

          </div>

          <div class="modal-body">          

            <p>Tem certeza que deseja executar a solicitação selecionada?</p>

            <input type="hidden" class="form-control" id="id" name="id">

            <input name="descricao_prod" type="hidden" class="form-control" id="descricao_prod">

            <input name="Solicitante" type="hidden" class="form-control" id="Solicitante">

            <input name="codigo" type="hidden" class="form-control" id="codigo">



            <p class="text-warning">

            <small>Fazendo isso voce trocará o status para EXECUTANDO</small></p>

          </div>

          <div class="modal-footer">

            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

            <input type="submit" class="btn btn-success" value="Confirmar">

          </div>

        </form>

      </div>

    </div>

  </div> 



<div id="confirmar" class="modal fade">

    <div class="modal-dialog">

      <div class="modal-content">

        <form method="POST" action="concluido.php">

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



            <small>Ao confirmar essa solitação, o serviço será encaminhado direto para a Fabri Gráfica Digital</small></p>

          </div>

          <div class="modal-footer">

            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

            <input type="submit" class="btn btn-success" value="Confirmar">

          </div>

        </form>

      </div>

    </div>

  </div> 

  <script type="text/javascript">

$('#exampleModal').on('show.bs.modal', function (event) {var button = $(event.relatedTarget) 

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

$('#deleteEmployeeModal').on('show.bs.modal', function (event) {var button = $(event.relatedTarget) 

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

$('#confirmar').on('show.bs.modal', function (event) {var button = $(event.relatedTarget) 

  var recipient = button.data('whatever') // Extract 

  var recipientnome = button.data('whatevernome')

  var recipientquantidade = button.data('whateverquantidade')

  var recipientdescricao = button.data('whateverdescricao')

  var recipientdescricao_prod = button.data('whateverdescricao_prod')



      

      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).

      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

      var modal = $(this)

      modal.find('.modal-title').text('Confirmar solicitação de:' + recipientnome)

      modal.find('#id').val(recipient)

      modal.find('#recipient-codigo').val(recipientcodigo)

      modal.find('#quantidade').val(recipientquantidade)

      modal.find('#descricao').val(recipientdescricao)

      modal.find('#descricao_prod').val(recipientdescricao)



    })

 </script>

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

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



</body>

</html>                                                               