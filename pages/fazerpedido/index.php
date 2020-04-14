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
<body onload="carregar()">   
    <div class="container container-lg d-flex flex-column justify-content-center align-items-center">
        <h1>Fazer novo pedido</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID DO PRODUTO</th>
                    <th scope="col">PRODUTO</th>
                    <th scope="col">PREÇO</th>
                    <th scope="col">DESCRICAO</th>
                </tr>
            </thead>
            <tbody id="tbody">
                
            </tbody>

        </table>
        <div class="form-group mb-2">
            <input id="mesa" type="number" class="form-control" placeholder="Numero da Mesa">
            <textarea id="obs" class="form-control" placeholder="Observações"></textarea>
        </div>
        <a onclick="fazerPedido()" type="submit" class="btn btn-primary mb-2">Terminar Pedido</a>
    </div>

   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="./scripts/index.js"></script>    

</body>
</html>