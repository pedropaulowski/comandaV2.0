<?php
session_start();

if(!isset($_SESSION['nome']) || empty($_SESSION['nome']))
    header("Location: ../login/");


require '../../partials/header/index.php';
?>
<html>
<head>
    <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container container-lg d-flex justify-content-center">
    <div class="card-group">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">A entregar</h5>
                        <p class="card-text">Todos os pedidos que ainda não estão prontos para serem entregues.</p>
                        <a href="../cozinha/" class="btn btn-primary">Ver Pedidos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Novo Pedido</h5>
                        <p class="card-text">Fazer novo pedido para alguma mesa e enviar para cozinha.</p>
                        <a href="../fazerpedido/" class="btn btn-primary">Novo Pedido</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Prontos</h5>
                        <p class="card-text">Todos os pedidos que já estão prontos para serem entregues.</p>
                        <a href="../prontos/" class="btn btn-primary">Ver Pedidos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Estoque</h5>
                        <p class="card-text">Todos os produtos do estoque, suas respectivas quantidades e área para dar baixa.</p>
                        <a href="../estoque/" class="btn btn-primary">Ver Estoque</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recebimentos Pendentes</h5>
                        <p class="card-text">Todos os pedidos que ainda não fora pagos pelos clientes.</p>
                        <a href="../pagamento/" class="btn btn-primary">Ver Pedidos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="./scripts/index.js"></script>
</body>
</html>