<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

require '../../vendor/autoload.php';
require '../../config.php';

use Dao\ProdutoMysql;

$hora = date("Y-m-d H:i:s");

$method = $_SERVER['REQUEST_METHOD'];
$header = getallheaders();
$error_arry = ['error' => 'access deined'];


$produtoDb = new ProdutoMysql($pdo);

switch($method) {
    case 'PUT':
        $produto = new Classes\Produto;

        $parametros = (json_decode(file_get_contents("php://input"), true));
        $id_produto = $parametros['id_produto'];
        $quantidade = $parametros['quantidade'];
        $descricao = $parametros['descricao'];
        $nome = $parametros['produto'];
        $preco = $parametros['preco'];

        $produto->setId($id_produto);
        $produto->setQuantidade($quantidade);
        $produto->setDescricao($descricao);
        $produto->setProduto($nome);
        $produto->setPreco($preco);
    


        $produtoDb->alterar($produto);


    break;

    case 'DELETE':
        $parametros = (json_decode(file_get_contents("php://input"), true));
        $id = $parametros['id_produto'];

        /*
        * Precisa apenas do "id_produto" 
        */
        
        if(isset($_SESSION['nome']) && !empty($_SESSION['nome']))
            $produtoDb->delete($id);
        else 
            echo json_encode($error_arry);

    break;

    case 'POST':
        $produto = new Classes\Produto;
        $parametros = (json_decode(file_get_contents("php://input"), true));

        /*
        * Precisa dos parametros "produto", "preco", "quantidade", "descricao"
        */
        
        $produto->setProduto($parametros['produto']);
        $produto->setPreco($parametros['preco']);
        $produto->setQuantidade($parametros['quantidade']);
        $produto->setDescricao($parametros['descricao']);
        
        $produto->setId(md5($parametros['produto'].$hora));

        if(isset($_SESSION['nome']) && !empty($_SESSION['nome'])) {
            $produtoDb->add($produto);
            echo json_encode(["id_produto" => $produto->getId()]);
        } else {
            echo json_encode($error_arry);
        }

    break;

    case 'GET':
        $parametros = (json_decode(file_get_contents("php://input"), true));

        /**
         * Parametro opcional "id_produto"
         */

        if(isset($parametros['id_produto']))
            echo json_encode($produtoDb->getProduto($parametros['id_produto']));
        else
            echo json_encode($produtoDb->getAllProdutos());
    break;

    default:
        echo json_encode($error_arry);
    break;

}


