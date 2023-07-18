<?php

require("./querys/consult.php");


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


 $mes = date ("m");

 $ano = date ("Y");
 function loadData(){
  global $VarID, $mes, $ano;
  $resultado = realizarConsulta($VarID, $mes, $ano);
  return $resultado;
 };
 
if (isset($_POST['filtrar'])) {
   
  // Chamar a função PHP aqui
  $data = $_POST['data'];
  $ano = substr($data, 0, 4);
  $mes = substr($data, 5, 2);
  $resultado = loadData();
 
} else {
    $resultado = loadData();
    
}
 $unidade_name = getUnidade();
?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOLICITANTE</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../administrador/css/style.css">
    <style>

    </style>
</head>

<body>
    <div id="app">
        <div class="modal fade in" :class="{'d-block': isModalOpen }">
            <div class="modal-dialog" v-if="impressSelected">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirmação de recebimento</h4>
                        <button type="button" class="close" @click="closeModal" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja confirmar que o serviço código <b> #{{impressSelected}} </b> foi
                            entregue
                            corretamente?</p>
                        <p class="text-warning"><small>Esta ação não pode ser desfeita.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="closeModal" class="btn btn-default"
                            data-dismiss="modal">Cancelar</button>
                        <button @click="confirmReceived" type="button" class="btn btn-danger">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>

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

                <ul class="nav navbar-nav">

                    <li><a href="inicio.php">PRODUTOS</a></li>
                    <li><a href="unidades.php">UNIDADES</a></li>

                    <li class="active"><a href="solicitados.php">SOLICITADOS</a></li>

                    <li><a href="usuarios.php">USUÁRIOS</a></li>

                    <li><a href="solicitar-servicos.php">SOLICITAR SERVIÇO</a></li>


                    <li><a href="pesquisa.php">RELÁTORIOS</a></li>



                </ul>
                <ul class="nav navbar-nav navbar-right">


                    <li><a href="#"><?php echo "$VarNome"; ?></a></li>
                    <li><a href="#"><?php echo "$unidade_name"; ?></a></li>
                    <li><a href="../administrador/logout.php">SAIR</a></li>
                </ul>
                <!--/.nav-collapse -->

            </div>
            <!--/.container-fluid -->

        </nav>

        <div class="table-wrapper">

            <div class="table-title">

                <div class="row align-items-center">
                    <div class="col-sm-1">
                        <h2>Serviços</b></h2>

                    </div>
                    <form class="col-sm-3 row" method="POST" action="">
                        <div class="form-group col-sm-6">
                            <div class="input-group">
                                <input required class="form-control" type="month" id="start" name="data" min="2023-07"
                                    value="<?php echo $ano.'-'.$mes; ?>">
                            </div>


                        </div>
                        <div class="col-sm-3">
                            <a> <button type="submit" name="filtrar" class="btn btn-lg btn-info"><i
                                        class="fa fa-search"></i></button></a>
                        </div>

                    </form>
                    <div class="col-sm-8">

                        <div class="row">
                            <div class="row ">
                                <div>
                                    <a href='javascript:window.print()' class="btn btn-success" data-toggle="modal"><i
                                            class="fa fa-print"></i> <span>IMPRIMIR RECIBO</span></a>

                                </div>
                                <a><button @click="filter = '2'" class="btn btn-danger">Recusados</button></a>
                                <a><button @click="filter = '8'" class="btn btn-info">Recebidos</button></a>
                                <a><button @click="filter = '4'" class="btn btn-success">Concluido</button></a>
                                <a><button @click="filter = '1'" class="btn btn-warning">Autorizados</button></a>
                                <a> <button @click="filter = '0'" class="btn btn-info">Aguardando</button></a>
                                <a><button @click="filter = ''" class="btn btn-primary">Todos</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th style="width: 10px;">#ID</th>
                    <th style="width: 10px;">Codigo</th>
                    <th style="width: 120px;">Data Inicio</th>
                    <th style="width: 10px;">Quantidade</th>
                    <th style="width: 10px;">Descrição</th>
                    <th style="width: 390px;">Serviço</th>
                    <th>Valor unidade</th>
                    <th>Total</th>
                    <th>Atualização</th>
                    <th style="width: 140px;">Status</th>
                    <th style="width: 140px;">Ação</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(item, key) in listimpress">
                    <td v-text="item.id"></td>
                    <td v-text="item.codigo"></td>
                    <td v-text="item.data_inicio"></td>
                    <td v-text="item.quantidade"></td>
                    <td v-text="item.descricao"></td>
                    <td v-text="item.descricao_prod"></td>
                    <td v-text="formatCurrency(item.valor_unidade)"></td>
                    <td v-text="formatCurrency(item.quantidade * item.valor_unidade)"></td>
                    <td v-text="item.data"></td>
                    <td style="width: 140px;">
                        <div class="row align-items-center justify-content-between"
                            :class="{'cursor-pointer font-bold': item.status === '4'}">
                            <div class="col-sm-8">
                                <span v-text="item.Status"></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div @click="openModal(item.id)" class="col-sm-4 cursor-pointer"
                            v-if="item.status === '4' && Number(item.id_professor) === id">
                            <span class="material-symbols-outlined  color-red">
                                receipt_long
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright © Vedas Sistemas 2023. Todos os direitos reservados. </p>
        </div>
    </div>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="../administrador/js/utils.js"></script>

<script>
var app = new Vue({
    el: '#app',
    data: {
        list: <?php echo json_encode($resultado); ?>,
        filter: '',
        isModalOpen: false,
        impressSelected: null,
        id: <?php echo $VarID; ?>
    },
    watch: {
        isModalOpen() {
            if (this.isModalOpen) {
                document.body.classList.add('modal-open');
                // ADD ELEMENT <div class="modal-backdrop fade in"></div>
                let div = document.createElement('div');
                div.classList.add('modal-backdrop', 'fade', 'in');
                document.body.appendChild(div);

            } else {
                document.body.classList.remove('modal-open');
                // REMOVE ELEMENT <div class="modal-backdrop fade in"></div>
                document.body.removeChild(document.querySelector('.modal-backdrop'));

            }
        },


    },
    computed: {
        listimpress() {
            if (this.filter === '')
                return this.list
            if (this.filter !== '')
                return this.list.filter(item => item.status == this.filter)
        }
    },
    methods: {
        formatCurrency(value) {
            return formatCurrency(value)
        },
        openModal(id) {
            this.isModalOpen = true;
            this.impressSelected = id;
        },

        closeModal() {
            this.isModalOpen = false;
            this.impressSelected = null;
        },


        async confirmReceived() {
            let id = this.impressSelected;

            fetch('../models/form_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id,
                        status: 8,
                    }),
                })
                .then(response => response.json())
                .then(resp => {
                    window.location.reload();
                })
                .catch(error => {
                    // Tratamento de erro
                    console.log(error);
                });
        },

    },
});
</script>

</html>