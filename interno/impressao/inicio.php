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
 

$result_produtos = "SELECT * FROM produtos WHERE status ='0'ORDER BY id ASC";

$resultado_produtos = mysqli_query($conn, $result_produtos);

$produtos = [];
while ($row_produtos = mysqli_fetch_assoc($resultado_produtos)) {
  $produtos[] = $row_produtos;
}
$produtos_json = json_encode($produtos);


                     
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
    <link rel="stylesheet" href="../administrador/css/style.css">

</head>

<body>
    <div id="app">
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
                        <li><a href="usuarios.php">USUÁRIOS</a></li>

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
                            <th>Un. de medida</th>

                            <th>Ação</th>

                        </tr>

                    </thead>

                    <tbody>









                        <tr v-for="(product, key) in products">
                            <td v-text="product.codigo"></td>
                            <td v-text="product.quantidade"></td>
                            <td v-text="formatCurrency(product.valor_unidade)"></td>
                            <td v-text="product.descricao_prod"></td>
                            <td v-text="product.un_medida"></td>
                            <td>
                                <a @click="handleEdit(product.id)" href="#" class="edit"><i type="button"
                                        class="material-icons orange600" data-toggle="modal" title="Edit"
                                        data-target="#exampleModal">
                                        &#xE254;</i></a>

                                <a @click="deleteProduct(product.id)" class="delete cursor-pointer"><i type="button"
                                        class="material-icons" data-toggle="modal" title="Delete"
                                        data-target="#deleteEmployeeModal">&#xE872;</i></a>

                            </td>

                        </tr>
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
                            <div class="form-group">

                                <label>Unidade de fornecimento</label>

                                <select v-model="form.un_medida" name="un_medida" class="form-control" required>
                                    <option value="Unidade">Unidade</option>
                                    <option value="Metro Linear">Metro Linear</option>
                                </select>

                            </div>


                            <input type="hidden" class="form-control" required name="id" value="form.id">


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

        <div ref="myModal" id="exampleModal" class="modal fade">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h4 class="modal-title"></h4>

                        <button id="closeModal" type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>

                    </div>

                    <div class="modal-body">


                        <div>

                            <div class="form-group">

                                <label>CÓDIGO</label>

                                <input v-model="form.codigo" type="text" class="form-control" name="codigo" required
                                    id="recipient-codigo">

                            </div>

                            <div class="form-group">

                                <label>QUANTIDADE</label>

                                <input v-model="form.quantidade" type="text" class="form-control" required
                                    name="quantidade" id="quantidade" onkeyup="somenteNumeros(this);">

                            </div>
                            <div class="form-group">

                                <label>Valor Unidade</label>

                                <input v-model="form.valor_unidade" type="text" class="form-control" required
                                    name="valor_unidade" id="valor_unidade">

                            </div>

                            <div class="form-group">

                                <label>DESCRIÇÃO</label>

                                <input v-model="form.descricao_prod" type="text" class="form-control" required
                                    name="descricao_prod" id="descricao">

                            </div>
                            <div class="form-group">

                                <label>Unidade de fornecimento</label>

                                <select v-model="form.un_medida" name="un_medida" class="form-control" required>
                                    <option value="Unidade">Unidade</option>
                                    <option value="Metro Linear">Metro Linear</option>
                                </select>

                            </div>


                            <div class="modal-footer">

                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">

                                <input @click="saveForm" class="btn btn-info" value="Salvar">

                            </div>

                        </div>



                    </div>



                </div>

            </div>

        </div>

        <!-- Delete Modal HTML -->

        <div ref="myModal" id="deleteEmployeeModal" class="modal fade">

            <div class="modal-dialog" id="deleteEmployeeModal">

                <div class="modal-content">

                    <form>

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

                            <input class="btn btn-default" data-dismiss="modal" value="Cancel">

                            <input @click="confirmDelete" class="btn btn-danger" value="Excluir">

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <footer>

            <div class="footer" id="footer">
                <div class="container">
                    <p class="pull-left"> Copyright © Vedas Sistemas 2023. Todos os direitos reservados. </p>
                </div>

            </div>

    </div>

    </footer>
    </div>

    <!-- Static navbar -->
    <script src="../administrador/js/utils.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <script>
    var app = new Vue({
        el: '#app',
        mounted() {
            const modalElement = this.$refs.myModal;

            // Adicione o ouvinte de evento para o evento 'show.bs.modal'
            modalElement.addEventListener('show.bs.modal', this.handleModalOpen);
        },
        data: {
            products: <?php echo $produtos_json; ?>,
            form: {
                codigo: '',
                valor_unidade: '',
                quantidade: '',
                descricao_prod: '',
                id: '',
                un_medida: '',
            },
            productSelected: {
                id: '',
            }
        },
        methods: {
            handleEdit(id) {
                const product = this.products.find(product => product.id === id)
                this.form = {
                    id: product.id,
                    codigo: product.codigo,
                    valor_unidade: product.valor_unidade,
                    quantidade: product.quantidade,
                    descricao_prod: product.descricao_prod,
                    un_medida: product.un_medida,
                }
            },
            deleteProduct(id) {
                this.form.id = id
                this.productSelected.id = id
            },
            confirmDelete() {

                const payload = {
                    id: this.productSelected.id,
                }
                fetch('delete.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(payload),
                    })
                    .then(response => response.json())
                    .then(resp => {
                        if (resp.status === 'success') {
                            this.products = this.products.filter(product => product.id !== this.form.id)
                            location.reload();
                        }
                    })
                    .catch(error => {
                        // Tratamento de erro
                        console.error(error);
                    });
            },
            formatCurrency(value) {
                return formatCurrency(value)
            },
            saveForm() {
                const response = fetch('send_update.php', {
                    method: 'POST',
                    body: JSON.stringify(this.form)
                }).then((resp) => {
                    location.reload();

                    console.log("🚀 ~ file: inicio.php:545 ~ saveForm ~ resp:", resp)
                }).catch((err) => {
                    console.log(err)
                })

            },

        }
    }, )
    </script>
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
    $('#exampleModal').on('show.bs.modal')
    $('#deleteEmployeeModal').on('show.bs.modal')
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>