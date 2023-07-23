<?php
require("./querys/saldo.php");

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





  $resultado = getSaldo();
?>







<!DOCTYPE html>

<html lang="pt-br">

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
    <link href="../administrador/css/style.css" rel="stylesheet">
</head>


<body>
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
                    <li class="active"><a href="unidades.php">UNIDADES</a></li>

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
    <div id="app">

        <div class="container">
            <div>
                <h4>Unidades</h4>
            </div>

            <div class="d-flex">
                <div class="col-sm-6" v-for="(unity, key) in unitys">
                    <div v-if="!unity.isEdit" class="card-unity">
                        <div class="card-header-unity">
                            <div>
                                <span class="card-unity-title" v-text="unity.nome_unidade"></span>
                            </div>
                            <div class="pointer" @click="handleEditUnity(key)">
                                <i class="material-icons">edit</i>
                            </div>
                        </div>
                        <div class="card-body-unity row">
                            <div class="col-sm-9">
                                <span class="card-body-text">Crédito Total: <b
                                        v-text="formatCurrency(unity.valor_unidade)">
                                    </b> </span>
                                <div class=" rounded-4">
                                    <span class="card-body-text">Consumido: <b
                                            v-text="formatCurrency(unity.saldo_gasto)">
                                        </b> </span>
                                </div>
                            </div>
                            <div class="col-sm-3 rounded-4">
                                <div>
                                    <small>
                                        Disponivel:
                                    </small>
                                </div>
                                <span class=""><b v-text="formatCurrency(unity.valor_unidade - unity.saldo_gasto)">
                                    </b> </span>
                            </div>
                        </div>
                    </div>
                    <div v-if="unity.isEdit" class="card-unity">
                        <div class="card-header-unity">
                            <div>
                                <span class="card-unity-title" v-text="unity.nome_unidade">ICHS</span>
                            </div>
                            <div @click="unitys[key].isEdit = false">
                                <i class="material-icons">close</i>
                            </div>
                        </div>
                        <div class="card-body-unity">
                            <div class="form-group" :class="{ focused: isInputFocused }">
                                <label class="form-label" for="last">Crédito</label>
                                <input v-model="inputValue" value="unity.valor_unidade" @focus="handleInputFocus"
                                    @blur="handleInputBlur" id="last" class="form-input" type="number" />
                            </div>
                            <div>
                                <button @click="saveForm(unity.id_unidade)" class="btn btn-primary">
                                    Confirmar
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <footer>
            <div class="footer" id="footer">
                <div class="container">
                    <p class="pull-left"> Copyright © Vedas Sistemas 2023. Todos os direitos reservados. </p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="./js/utils.js"></script>

    <script>
    var app = new Vue({
        el: '#app',
        data: {
            inputValue: '',
            isInputFocused: false,
            unitys: <?php echo json_encode($resultado); ?>,
        },
        async mounted() {
            const unitys = await this.handlindList(this.unitys);
            this.unitys = unitys;
        },
        methods: {
            formatCurrency(value) {
                return formatCurrency(value)
            },
            handleInputFocus() {
                this.isInputFocused = true;
            },
            handleInputBlur() {
                if (this.inputValue === '') {
                    this.isInputFocused = false;
                }
            },
            async handlindList(list) {
                const newUnity = list.map(unity => {
                    return {
                        ...unity,
                        isEdit: false,
                    }
                })
                return newUnity;
            },
            async handleEditUnity(key) {
                this.unitys.map((unity, index) => {
                    if (index === key) {
                        this.unitys[index].isEdit = true;
                    } else {
                        this.unitys[index].isEdit = false;
                    }
                })
                this.inputValue = this.unitys[key].valor_unidade;
            },
            async saveForm(id) {
                const payload = {
                    value: this.inputValue,
                    id: id,
                }

                fetch('./save_unity.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(payload),
                    })
                    .then(response => response.json())
                    .then(resp => {
                        console.log(resp.data)
                        const newUnitys = resp.data.map(
                            unity => {
                                return {
                                    ...unity,
                                    isEdit: false,
                                }
                            }
                        )
                        this.unitys = newUnitys;
                    })
                    .catch(error => {
                        // Tratamento de erro
                        console.error(error);
                    });

            }
        }
    })
    </script>
</body>



</html>