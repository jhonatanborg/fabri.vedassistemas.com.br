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

 $mes = date ("m");
 $ano = date ("Y");
 $sql = "SELECT * FROM unidades WHERE id = '$VarUnidade'";
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 $VarUnidadeNome = $row['name'];
 $unidade_value = $row['value'];


 $result_produtos = "SELECT * FROM produtos WHERE  status ='0' ORDER BY id ASC";
 $resultado_produtos = mysqli_query($conn, $result_produtos);
 $produtos = [];
    while ($row_produtos = mysqli_fetch_assoc($resultado_produtos)) {
        $produtos[] = $row_produtos;
    }

 $sql_list_impressao = "SELECT * FROM impressao ORDER BY id DESC"; 
 $result_list_impressao = mysqli_query($conn, $sql_list_impressao);
 $listimpress = [];

    while ($row = mysqli_fetch_assoc($result_list_impressao)) {
        $listimpress[] = $row;
    }
    // impresse error 
    

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Solicitante</title>
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
                        <li class="active"><a href="solicitar_servico.php.php">SOLICITAR SERVIÇO</a></li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">


                        <li><a href="#"><?php echo "$VarNome"; ?></a></li>
                        <li><a href="#"><?php echo "$VarUnidadeNome"; ?></a></li>
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
                        <h2>Serviços Disponiveis </b></h2>
                    </div>

                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>

                        <th>Código</th>
                        <th>Quantidade</th>
                        <th>Valor por unidade</th>
                        <th>Descrição</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="(product, index) in products">
                        <td v-text="product.codigo"></td>
                        <td v-text="product.quantidade"></td>
                        <td v-text="formatCurrency(product.valor_unidade)"></td>
                        <td v-text="product.descricao_prod"></td>
                        <td>
                            <a @click="addService(product)" href="#" class="edit"><i type="button"
                                    class="material-icons orange600" data-toggle="modal" title="Adicionar"
                                    data-target="#Adicionar">
                                    &#xE147;</i></a>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="Adicionar" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="send_impres.php">
                        <div class="modal-header">
                            <h4 class="modal-title">Solicitar Serviço</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div>
                                Codigo do serviço: <b v-text="productSelected.codigo"></b>
                            </div>

                            <div>Quantidade do serviço disponivel: <b>{{productSelected.quantidade}}</div>
                            <hr class="my-2">

                            <input v-model="form.id" name="id" type="hidden" class="form-control" id="id"
                                value="form.id">

                            <div class="form-group">
                                <label>Quantidade</label>
                                <input v-model="form.quantidade" required class="form-control" placeholder="Quantidade"
                                    name="quantidade" type="number">
                            </div>

                            <div class=" form-group">
                                <label>Descrição</label>
                                <input v-model="form.descricao" required type="text" class="form-control"
                                    placeholder="Descreva a impressão" name="descricao">
                            </div>
                            <div>
                                Total do pedido <b v-text="formatCurrency(totalRequest)"></b>
                            </div>
                            <div class="title">
                                <p>CRÉDITO <?php echo $VarUnidadeNome ?> :
                                    <b>{{formatCurrency(valueAvaiableUnity)}}</b>
                                </p>
                            </div>
                            <div class="alert alert-danger" v-if="!isDisabled.isValid">
                                <span v-text="isDisabled.message"></span>
                            </div>
                        </div>
                        <div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                <input @click="saveForm" class="btn btn-success"
                                    :class="{'disabled': !isDisabled.isValid}" value="Confirmar">
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="footer-bottom">
        <div class="container">
            <p class="pull-left"> Copyright © Vedas Sistemas 2019. Todos os direitos reservados. </p>
        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
    $('#Adicionar').on('show.bs.modal', function(event) {})
    </script>
    <script src="../administrador/js/utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script>
    var app = new Vue({
        el: '#app',
        data: {
            impressList: <?php echo json_encode($listimpress); ?>,
            unityValue: <?php echo $unidade_value ?>,
            unityId: <?php echo $VarUnidade ?>,
            products: <?php echo json_encode($produtos); ?>,
            form: {},
            valueAvaiableUnity: 0,
            productSelected: {}

        },
        computed: {
            totalRequest() {
                return this.form.quantidade * this.form.valor_unidade || 0
            },
            isDisabled() {
                let isValid = false
                let message = ''
                if (this.totalRequest < this.valueAvaiableUnity) {
                    isValid = true
                    message =
                        'Informamos que a sua unidade não possui saldo suficiente para atender a essa solicitação.'
                }
                if (this.totalRequest > this.valueAvaiableUnity) {
                    isValid = false
                    message =
                        'Informamos que a sua unidade não possui saldo suficiente para atender a essa solicitação.'
                }
                if (Number(this.form.quantidade) > Number(this.productSelected.quantidade)) {
                    isValid = false
                    message = 'Quantidade solicitada maior que a quantidade disponivel'
                }
                return {
                    isValid,
                    message
                }
            }
        },

        mounted() {
            this.impressList = this.impressList.map(impress => {
                const product = this.products.find(product => impress.id_produto == product.id);
                if (product) {
                    impress.status = Number(impress.status);
                    console.log([0, 1, 3, 4, 8].includes(impress.status))
                    if ([0, 1, 3, 4, 8].includes(impress.status)) {
                        product.quantidade -= impress.quantidade;
                    }
                    const updatedImpress = {
                        ...impress,
                        name_produto: product.descricao_prod,
                        total: Number(impress.quantidade) * Number(product.valor_unidade),
                    };
                    return updatedImpress;
                }
                return impress;
            });

            const totalQuantityPerUnity = this.impressList.reduce((total, impress) => total + Number(impress
                .total), 0)



            this.valueAvaiableUnity = this.unityValue - totalQuantityPerUnity

            setTimeout(function() {
                window.location.reload(1);
            }, 10000);
        },
        methods: {
            formatCurrency(value) {
                return formatCurrency(value)
            },
            addService(product) {
                this.productSelected = {}
                this.productSelected = product
                this.form.id = product.id
                this.form.valor_unidade = product.valor_unidade
                this.form.codigo = product.codigo
            },
            async saveForm() {
                const payload = {
                    id: this.productSelected.id,
                    quantidade: this.form.quantidade,
                    descricao: this.form.descricao,
                }
                fetch('send_impres.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(payload),
                    })
                    .then(response => response.json())
                    .then(resp => {
                        window.location.reload()
                    })
                    .catch(error => {
                        // Tratamento de erro
                        console.error(error);
                    });
            }
        },
    })
    </script>
    <!-- Importando o js do bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

</body>

</html>