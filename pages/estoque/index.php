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
        <h1>Estoque</h1>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="btn btn-danger" data-toggle="modal" data-target="#modalAdd" type="button" id="adicionar"><i class="fas fa-plus"></i></button>
            </div>
            <input type="text" class="form-control" placeholder="">
        </div>
        <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicional Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success" id="adicionou" >
                        Produto adicionadao
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Produto:</label>
                            <input type="text" class="form-control" id="produtoNome">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Descrição:</label>
                            <textarea class="form-control" id="produtoDescricao"></textarea>
                        </div>
                        <div class="form-group">
                        <div class="form-row">
                            <div class="form-group col-sm-3">
                                    <label for="produtoPreco">Preço</label>
                                    <input type="number" class="form-control" id="produtoPreco">
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="produtoQuantidade">Quantidade</label>
                                    <input type="number" class="form-control" id="produtoQuantidade">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button onclick="adicionarProduto()" type="button" class="btn btn-success">Adicionar</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div id="lista" class="container container-lg d-flex flex-column justify-content-center align-items-center">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">PRODUTO</th>
                <th scope="col">PREÇO</th>
                <th scope="col">QUANTIDADE</th>
                <th scope="col">AÇÃO</th>
            </tr>
        </thead>
        <tbody id="tbody">

        </tbody>
    </table>
    </div>


   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="./scripts/index.js"></script>    

</body>
</html>