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

 $VarUnidade = $_SESSION['s_unidade'];



$sql_unidades = "SELECT * FROM unidades";
$result = mysqli_query($conn, $sql_unidades);

$optionsArray = [];
while ($row = mysqli_fetch_assoc($result)) {
    $optionsArray[] = $row;
}




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

    <link rel="stylesheet" href="./css/style.css">

    </script>

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



                    <li><a href="index.php">SOLICITADOS</a></li>

                    <li class="active"><a href="usuarios.php">USUÁRIOS</a></li>



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

                <div class="col-sm-5">

                    <h2>Usúarios cadastrados</b></h2>

                </div>

                <div class="col-sm-7">

                    <a href="#Adicionar" class="btn btn-primary" data-toggle="modal"><i
                            class="material-icons">&#xE147;</i> <span>Novo usuário</span></a>



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
                        $result_users = "SELECT usuarios.nome,usuarios.login,usuarios.senha,
                        usuarios.nivel,usuarios.id,usuarios.matricula,usuarios.unidade,
                        unidades.name as unidade_nome,
                        case when usuarios.nivel=2 then 'Solicitante'
                        when usuarios.nivel=5 then 'Técnico'
                        when usuarios.nivel=6 then 'Inativo' end as nivel_descricao
                        FROM usuarios 
                        JOIN unidades ON usuarios.unidade = unidades.id
                        WHERE usuarios.unidade= $VarUnidade AND usuarios.nivel=2 ORDER BY usuarios.nome";
                        $resultado_users = mysqli_query($conn, $result_users);
                     ?>

                <?php while($rows_users = mysqli_fetch_assoc($resultado_users)){ ?>

                <tr>
                    <td><?php echo $rows_users['matricula']; ?></td>

                    <td><?php echo $rows_users['nome']; ?></td>

                    <td><?php echo $rows_users['login']; ?></td>

                    <td><?php echo $rows_users['senha']; ?></td>

                    <td><?php echo $rows_users['nivel_descricao']; ?></td>

                    <td><?php echo $rows_users['unidade_nome']; ?></td>

                    <td>









                        <a href="#" class="settings" title="Settings"><i type="button" class="material-icons"
                                data-toggle="modal" title="Edit" data-target="#Editar"
                                data-whatever="<?php echo $rows_users['id']; ?>"
                                data-whatevermatricula="<?php echo $rows_users['matricula']; ?>"
                                data-whatevernome="<?php echo $rows_users['nome']; ?>"
                                data-whateverlogin="<?php echo $rows_users['login'];?>"
                                data-whateversenha="<?php echo $rows_users['senha']; ?>"
                                data-whatevernivel="<?php echo $rows_users['nivel']; ?>"
                                data-whateverunidade="<?php echo $rows_users['unidade']; ?>" ">&#xE8B8;</i></a>



<a href=" #" class="delete"><i type="button" class="material-icons" data-toggle="modal" title="Delete"
                                    data-target="#deleteEmployeeModal" data-whatever="<?php echo $rows_users['id']; ?>"
                                    data-whatevernome="<?php echo $rows_users['nome']; ?>"
                                    data-whateverlogin="<?php echo $rows_users['login'];?>"
                                    data-whateversenha="<?php echo $rows_users['senha']; ?>">&#xE872;</i></a>



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

                    <form method="POST" action="update_users.php">

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

                            <input type="password" class="form-control" required name="senha" id="senha">

                        </div>

                        <select class="browser-default custom-select" name="nivel" id="nivel">

                            <option selected>Selecionar Nivel</option>




                            <option value="2">Solicitante</option>





                        </select>
                        <select class="browser-default custom-select" name="unidade" id="unidade">

                            <option selected>Selecionar UNIDADE</option>
                            <?php foreach ($optionsArray as $option) : ?>
                            <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
                            <?php endforeach; ?>





                        </select>

                        <input name="id" type="hidden" class="form-control" id="id" value="">



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

                            <small>Fazendo isso você deleterá o usuário permanentemente</small>
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

    <!-- Edit Modal HTML -->

    <div id="Adicionar" class="modal fade">

        <div class="modal-dialog">

            <div class="modal-content">

                <form method="POST" action="user_cad.php">

                    <div class="modal-header">

                        <h4 class="modal-title">Adicionar Usuário</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                    </div>

                    <div class="modal-body">

                        <div class="form-group">

                            <label>Matricula</label>

                            <input type="text" class="form-control" required name="matricula">

                        </div>

                        <div class="form-group">

                            <label>Nome</label>

                            <input type="text" class="form-control" required name="nome">

                        </div>



                        <div class="form-group">

                            <label>Login</label>

                            <input type="text" class="form-control" required name="login" placeholder="@usuario">

                        </div>



                        <div class="form-group">

                            <label>Senha</label>

                            <input type="password" class="form-control" required name="senha">

                        </div>

                        <select class="browser-default custom-select" name="nivel">

                            <option selected>Selecionar Nivel</option>




                            <option value="2">Solicitante</option>





                        </select>
                        <select class="browser-default custom-select" name="unidade">

                            <option selected>Selecionar UNIDADE</option>
                            <?php foreach ($optionsArray as $option) : ?>
                            <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
                            <?php endforeach; ?>




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
$('#Editar').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)

    var recipient = button.data('whatever') // Extract

    var recipientmatricula = button.data('whatevermatricula')

    var recipientnome = button.data('whatevernome')

    var recipientlogin = button.data('whateverlogin')

    var recipientsenha = button.data('whateversenha')

    var recipientnivel = button.data('whatevernivel')

    var recipientunidade = button.data('whateverunidade')


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
$('#deleteEmployeeModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)

    var recipient = button.data('whatever') // Extract

    var recipientnome = button.data('whatevernome')

    var recipientlogin = button.data('whateverlogin')

    var recipientsenha = button.data('whateversenha')

    var recipientnivel = button.data('whatevernivel')



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