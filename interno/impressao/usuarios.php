<?php

include_once('../conexao_bd.php');

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

<title>Usúarios</title>

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

		background: #299be4;

		color: #fff;

		padding: 16px 30px;

		margin: -20px -25px 10px;

		border-radius: 3px 3px 0 0;

    }

    .table-title h2 {

		margin: 5px 0 0;

		font-size: 24px;

	}

	.table-title .btn {

		color: #566787;

		float: right;

		font-size: 13px;

		background: #fff;

		border: none;

		min-width: 50px;

		border-radius: 2px;

		border: none;

		outline: none !important;

		margin-left: 10px;

	}

	.table-title .btn:hover, .table-title .btn:focus {

        color: #566787;

		background: #f2f2f2;

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

	}

	table.table td a:hover {

		color: #2196F3;

	}

	table.table td a.settings {

        color: #2196F3;

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

	.status {

		font-size: 30px;

		margin: 2px 2px 0 0;

		display: inline-block;

		vertical-align: middle;

		line-height: 10px;

	}

    .text-success {

        color: #10c469;

    }

    .text-info {

        color: #62c9e8;

    }

    .text-warning {

        color: #FFC107;

    }

    .text-danger {

        color: #ff5b5b;

    }

    .pagination {

        float: right;

        margin: 0 0 5px;

    }

    .pagination li a {

        border: none;

        font-size: 13px;

        min-width: 30px;

        min-height: 30px;

        color: #999;

        margin: 0 2px;

        line-height: 30px;

        border-radius: 2px !important;

        text-align: center;

        padding: 0 6px;

    }

    .pagination li a:hover {

        color: #666;

    }

    .pagination li.active a, .pagination li.active a.page-link {

        background: #03A9F4;

    }

    .pagination li.active a:hover {

        background: #0397d6;

    }

	.pagination li.disabled i {

        color: #ccc;

    }

    .pagination li i {

        font-size: 16px;

        padding-top: 6px

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

<script type="text/javascript">

$(document).ready(function(){

	$('[data-toggle="tooltip"]').tooltip();

});

</script>

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

              <li ><a href="inicio.php">PRODUTOS</a></li>

              <li><a href="solicitados.php">SOLICITADOS</a></li>

              <li class="active"><a href="usuarios.php">USUÁRIOS</a></li>

              <li><a href="solicitar-servicos.php">SOLICITAR SERVIÇO</a></li>


              <li><a href="pesquisa.php">RELÁTORIOS</a></li>



            </ul>

            <ul class="nav navbar-nav navbar-right">





              <li><a href="#"><?php echo "$VarNome"; ?></a></li>

              <li><a href="../administrador/logout.php">SAIR</a></li>

            </ul>

          </div><!--/.nav-collapse -->

        </div><!--/.container-fluid -->

      </nav>

    <div class="container">

        <div class="table-wrapper">

            <div class="table-title">

                <div class="row">

                    <div class="col-sm-5">

						<h2>Usúarios cadastrados</b></h2>

					</div>

					<div class="col-sm-7">

						<a href="#Adicionar" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Novo usuário</span></a>



					</div>

                </div>

            </div>

            <table class="table table-striped table-hover">

                <thead>

                    <tr>

                       <th>Matricula</th>

                        <th>Nome</th>

						            <th>Login</th>

						            <th>Senha</th>

                        <th>Nivel</th>

                        <th>Unidade</th>

                        <th></th>

                    </tr>

                </thead>

                <tbody>

                    <?php

                        $result_users = "SELECT usuarios.id,usuarios.nome,usuarios.login,usuarios.senha,

                        usuarios.nivel,usuarios.matricula,usuarios.unidade,usuarios.matricula,


                        case 
when usuarios.unidade = 1 then 'CUVG'                       
when usuarios.unidade = 2 then 'FAACC'
when usuarios.unidade = 3 then 'FAAZ'
when usuarios.unidade = 4 then 'FACC'
when usuarios.unidade = 5 then 'FAEN'
when usuarios.unidade = 6 then 'FAET'
when usuarios.unidade = 7 then 'FAGEO'
when usuarios.unidade = 8 then 'FANUT'                       
when usuarios.unidade = 9 then 'FAVET'
when usuarios.unidade = 10 then 'FD'
when usuarios.unidade = 11 then 'FE'
when usuarios.unidade = 12 then 'FEF'
when usuarios.unidade = 13 then 'FENF'
when usuarios.unidade = 14 then 'FM'
when usuarios.unidade = 15 then 'IB'                       
when usuarios.unidade = 16 then 'IC'
when usuarios.unidade = 17 then 'ICET'
when usuarios.unidade = 18 then 'ICHS'
when usuarios.unidade = 19 then 'IE'
when usuarios.unidade = 20 then 'IGHD'
when usuarios.unidade = 21 then 'IL'
when usuarios.unidade = 22 then 'ISC'                       
when usuarios.unidade = 23 then 'PRAE'
when usuarios.unidade = 24 then 'PROADI'
when usuarios.unidade = 25 then 'PROCEV'
when usuarios.unidade = 26 then 'PROEG'
when usuarios.unidade = 27 then 'PROPG'
when usuarios.unidade = 28 then 'PROPLAN'
when usuarios.unidade = 29 then 'PROPEQ'                       
when usuarios.unidade = 30 then 'Reitoria'
when usuarios.unidade = 31 then 'SECRI'
when usuarios.unidade = 32 then 'SECOM'
when usuarios.unidade = 33 then 'SETEC'
when usuarios.unidade = 34 then 'SGP'
when usuarios.unidade = 35 then 'STI'
when usuarios.unidade = 36 then 'ViceReitoria'

                        end as unidade,







                        case when usuarios.nivel=1 then 'Administrador'

                        when usuarios.nivel=2 then 'Usuario'

                        when usuarios.nivel=3 then 'Coordenador'

                        when usuarios.nivel=4 then 'Colaborador'

                        when usuarios.nivel=5 then 'Técnico'

                        when usuarios.nivel=6 then 'Inativo' end as nivel_descricao

                        FROM usuarios WHERE NOT usuarios.nivel = 1 AND usuarios.nivel<>6 ORDER BY usuarios.nome";

                        $resultado_users = mysqli_query($conn, $result_users);



                     ?>





                    <?php while($rows_users = mysqli_fetch_assoc($resultado_users)){ ?>

                    <tr>
                    <td><?php echo $rows_users['matricula']; ?></td>

                      <td><?php echo $rows_users['nome']; ?></td>

                        <td><?php echo $rows_users['login']; ?></td>

                        <td><?php echo $rows_users['senha']; ?></td>

                        <td><?php echo $rows_users['nivel_descricao']; ?>

                        </td>
                        <td><?php echo $rows_users['unidade']; ?>

                        </td>
                         <td>









<a href="#" class="settings" title="Settings"><i type="button" class="material-icons" data-toggle="modal" title="Edit" data-target="#Editar"

data-whatever="<?php echo $rows_users['id']; ?>"

data-whatevermatricula="<?php echo $rows_users['matricula']; ?>"


data-whatevernome="<?php echo $rows_users['nome']; ?>"

data-whateverlogin="<?php echo $rows_users['login'];?>"

data-whateversenha="<?php echo $rows_users['senha']; ?>"

data-whatevernivel="<?php echo $rows_users['nivel']; ?>"

data-whateverunidade="<?php echo $rows_users['unidade']; ?>"

              ">&#xE8B8;</i></a>



<a href="#" class="delete"><i type="button" class="material-icons" data-toggle="modal" title="Delete"

data-target="#deleteEmployeeModal"

data-whatever="<?php echo $rows_users['id']; ?>"

data-whatevernome="<?php echo $rows_users['nome']; ?>"

data-whateverlogin="<?php echo $rows_users['login'];?>"

data-whateversenha="<?php echo $rows_users['senha']; ?>"

>&#xE872;</i></a>



						</td>

                    </tr>



                        <?php }?>

                </tbody>

            </table>

        </div>

    </div>

      <!-- Edit Modal HTML -->

  <div id="Editar" class="modal fade">

    <div class="modal-dialog">

      <div class="modal-content">

          <div class="modal-header">

            <h4 class="modal-title"></h4>

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

          </div>

          <div class="modal-body">

                    <form  method="POST" action="update_users.php">

                   <input type="hidden" class="form-control" id="id" value="" name="id" >

                   <div class="form-group">

                    <label>Matricula</label>

                    <input type="text" class="form-control" required name="matricula" id="matricula">

                    </div>

                    <div class="form-group">

                    <label>Nome</label>

                    <input type="text" class="form-control" required name="nome" id="recipient-nome">

                    </div>



                  <div class="form-group">

                  <label>Login</label>

                  <input type="text" class="form-control" required name="login" id="login">

                  </div>



                  <div class="form-group">

                  <label>Senha</label>

                  <input type="password" class="form-control" required name="senha" id="senha" >

                  </div>

     <select class="browser-default custom-select"  required name="nivel" id="nivel">

  <option selected>Selecionar Nivel</option>

  <option value="1">Administrador</option>

  <option value="2">Usuario</option>

  <option value="3">Coordenador</option>

  <option value="4">Colaborador</option>

  <option value="5">Técnico</option>


</select>
 <select class="browser-default custom-select" required name="unidade" id="unidade">

  <option selected>Selecionar UNIDADE</option>

  <option value="1">CUVG</option>
<option value="2">FAACC</option>
<option value="3">FAAZ</option>
<option value="4">FACC</option>
<option value="5">FAEN</option>
<option value="6">FAET</option>
<option value="7">FAGEO</option>
<option value="8">FANUT</option>
<option value="9">FAVET</option>
<option value="10">FD</option>
<option value="11">FE</option>
<option value="12">FEF</option>
<option value="13">FENF</option>
<option value="14">FM</option>
<option value="15">IB</option>
<option value="16">IC</option>
<option value="17">ICET</option>
<option value="18">ICHS</option>
<option value="19">IE</option>
<option value="20">IGHD</option>
<option value="21">IL</option>
<option value="22">ISC</option>
<option value="23">PRAE</option>
<option value="24">PROADI</option>
<option value="25">PROCEV</option>
<option value="26">PROEG</option>
<option value="27">PROPG</option>
<option value="28">PROPLAN</option>
<option value="29">PROPEQ</option>
<option value="30">Reitoria</option>
<option value="31">SECRI</option>
<option value="32">SECOM</option>
<option value="33">SETEC</option>
<option value="34">SGP</option>
<option value="35">STI</option>
<option value="36">ViceReitoria</option>



</select>




                    </div>

                    <div class="modal-footer">

                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">

                        <input type="submit" class="btn btn-success" value="Confirmar">

                    </div>

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

        <form method="POST" action="delete_users.php">

          <div class="modal-header">

            <h4 class="modal-title">Deletar usuário</h4>

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

          </div>

          <div class="modal-body">

            <p>Tem certeza que deseja deletar o usuário selecionado?</p>

            <input type="hidden" class="form-control" id="id" name="id">

            <p class="text-warning">

            <small>Fazendo isso você deleterá o usuário permanentemente</small></p>

          </div>

          <div class="modal-footer">

            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">

            <input type="submit" class="btn btn-danger" value="Delete">

          </div>

        </form>

      </div>

    </div>

  </div>

    <!-- Edit Modal HTML -->

    <div id="Adicionar" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form  method="POST" action="user_cad.php">

                    <div class="modal-header">

                        <h4 class="modal-title">Adicionar Usuário</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    </div>

                    <div class="modal-body">

                       <div class="form-group">

                    <label>Matricula/Registro</label>

                <input type="text" class="form-control" required name="matricula">

                        </div>

                    <div class="form-group">

                    <label>Nome</label>

                <input type="text" class="form-control" required name="nome">

                        </div>



                        <div class="form-group">

                            <label>Login</label>

                            <input type="text" class="form-control" required name="login" placeholder="@usuario" >

                        </div>



                        <div class="form-group">

                            <label>Senha</label>

                            <input type="password" class="form-control" required name="senha">

                        </div>

     <select class="browser-default custom-select" name="nivel">

  <option selected>Selecionar Nivel</option>

  <option value="1">Administrador</option>

  <option value="2">Usuario</option>

  <option value="3">Coordenador</option>

  <option value="4">Colaborador</option>

  <option value="5">Técnico</option>


</select>
     <select class="browser-default custom-select" name="unidade">

  <option selected>Selecionar UNIDADE</option>

  <option value="1">CUVG</option>
<option value="2">FAACC</option>
<option value="3">FAAZ</option>
<option value="4">FACC</option>
<option value="5">FAEN</option>
<option value="6">FAET</option>
<option value="7">FAGEO</option>
<option value="8">FANUT</option>
<option value="9">FAVET</option>
<option value="10">FD</option>
<option value="11">FE</option>
<option value="12">FEF</option>
<option value="13">FENF</option>
<option value="14">FM</option>
<option value="15">IB</option>
<option value="16">IC</option>
<option value="17">ICET</option>
<option value="18">ICHS</option>
<option value="19">IE</option>
<option value="20">IGHD</option>
<option value="21">IL</option>
<option value="22">ISC</option>
<option value="23">PRAE</option>
<option value="24">PROADI</option>
<option value="25">PROCEV</option>
<option value="26">PROEG</option>
<option value="27">PROPG</option>
<option value="28">PROPLAN</option>
<option value="29">PROPEQ</option>
<option value="30">Reitoria</option>
<option value="31">SECRI</option>
<option value="32">SECOM</option>
<option value="33">SETEC</option>
<option value="34">SGP</option>
<option value="35">STI</option>
<option value="36">ViceReitoria</option>




</select>



                    </div>

                    <div class="modal-footer">

                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">

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



</body>

<script type="text/javascript">

$('#Editar').on('show.bs.modal', function (event) {var button = $(event.relatedTarget)

      var recipient = button.data('whatever') // Extract

    var recipientmatricula = button.data('whatevermatricula')

    var recipientnome = button.data('whatevernome')

    var recipientlogin = button.data('whateverlogin')

    var recipientsenha= button.data('whateversenha')

    var recipientnivel= button.data('whatevernivel')

    var recipientunidade= button.data('whateverunidade')


      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).

      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

      var modal = $(this)

          modal.find('.modal-title').text('Editar usuário:' + recipientnome)

          modal.find('#id').val(recipient)

          modal.find('#matricula').val(recipientmatricula)

          modal.find('#recipient-nome').val(recipientnome)

          modal.find('#login').val(recipientlogin)

          modal.find('#senha').val(recipientsenha)

          modal.find('#nivel').val(recipientnivel)
          modal.find('#unidade').val(recipientunidade)

    })

 </script>

 <script type="text/javascript">

$('#deleteEmployeeModal').on('show.bs.modal', function (event) {var button = $(event.relatedTarget)

    var recipient = button.data('whatever') // Extract

    var recipientnome = button.data('whatevernome')

    var recipientlogin = button.data('whateverlogin')

    var recipientsenha= button.data('whateversenha')

    var recipientnivel= button.data('whatevernivel')



          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).

          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

          var modal = $(this)

          modal.find('.modal-title').text('Deseja excluir o usuário:' + recipientnome)

          modal.find('#id').val(recipient)

          modal.find('#recipient-nome').val(recipientnome)

          modal.find('#login').val(recipientlogin)

          modal.find('#senha').val(recipientsenha)

          modal.find('#nivel').val(recipientnivel)

        })

 </script>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script src="../js/bootstrap.min.js"></script>

</html>
