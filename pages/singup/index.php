<?php
session_start();

if(isset($_SESSION['nome']) && !empty($_SESSION['nome']))
    header("Location: ../controlpanel/");
?>
<html>
<head>
    <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container container-lg d-flex justify-content-center">
    <div class="d-flex flex-column container-sm">
        <div class="alert alert-danger" id="alert" role="alert">
            Usuario já existente
            <a class="btn btn-secondary" href="../login/">Log In</a>
        </div>
        <div class="alert alert-danger" id="alert2" role="alert">
            As senhas devem ser iguais!
        </div>
        <form>
            <div class="form-group">
                <label>Nome</label>
                <input type="email" autocomplete="off" class="form-control" id="nome">
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" id="senha">
            </div>
            <div class="form-group">
                <label>Repita a Senha</label>
                <input type="password" class="form-control" id="senha_r">
            </div>
        </form>
        <div class="form-group">
            <button onclick="cadastrar()" class="btn btn-primary">Cadastrar</button>
            <a class="btn btn-secondary" href="../login/">Log In</a>
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