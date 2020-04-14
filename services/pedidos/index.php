<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
header("Access-Control-Allow-Origin: *");
require '../../vendor/autoload.php';
require '../../config.php';

use Classes\Produto;
use Dao\PedidoMySql;
use Dao\UsuarioMySql;

$hora = date("Y-m-d H:i:s");

$method = $_SERVER['REQUEST_METHOD'];
$header = getallheaders();
$error_arry = ['error' => 'access deined'];

if(isset($_SESSION['nome']) && !empty($_SESSION['nome'])) {
    $usuario = new UsuarioMySql($pdo);
    $id = $usuario->getIdByNome($_SESSION['nome']);
    $ultimoAcesso = $usuario->getUltimoAcesso($id);
}

$pedidoDb = new PedidoMySql($pdo);


switch($method) {
    case 'PUT':
        $parametros = (json_decode(file_get_contents("php://input"), true));
        $id = $parametros['id_pedido'];
        $estado = $parametros['estado'];

        /*
        * Precisa requeceber "id_pedido" e "estado", sendo 0 ou 1, sendo 1 pronto e 0 não pronto
        */

        $pedidoDb->alterarEstado($id, $estado, $hora);
    break;

    case 'DELETE':
        $parametros = (json_decode(file_get_contents("php://input"), true));
        
        $id = $parametros['id_pedido'];

        /*
        * Precisa apenas do "id_pedido"
        */
        if(isset($_SESSION['nome']) && !empty($_SESSION['nome']))
            $pedidoDb->delete($id);        
        else
            echo json_encode($error_arry);
    break;

    case 'POST':
        $pedido = new Classes\Pedido;
        $parametros = (json_decode(file_get_contents("php://input"), true));
        
        $mesa = $parametros['mesa'];
        $pedidos = $parametros['pedidos'];
        $precos = $parametros['precos'];
        $obs = $parametros['obs'];

        $pedido->setMesa($mesa);
        $pedido->setPedidos($pedidos);
        $pedido->setPrecos($precos);
        $pedido->setObs($obs);
        $pedido->setTotal($precos);
        $pedido->setHora($hora);


        //if(isset($_SESSION['nome']) && !empty($_SESSION['nome']))
            $pedidoDb->add($pedido);
        //else 
        //    echo json_encode($error_arry);

    break;

    case 'GET':
        $parametros = (json_decode(file_get_contents("php://input"), true));
        $tipo = ($parametros['tipo']) ?? $_GET['tipo'];
        /**
         * Precisa do parametro "tipo" com valor "prontos" ou "todos"
         */

        switch($tipo) {
            case 'prontos':
                echo json_encode($pedidoDb->getAllPedidosProntos($ultimoAcesso));
                $agora = date("Y-m-d H:i:s");
    
                $usuario->setUltimoAcesso($id, $agora);
            break;
            case 'prontos 0':
                echo json_encode($pedidoDb->getAllPedidosProntos(0));
                $agora = date("Y-m-d H:i:s");
    
                $usuario->setUltimoAcesso($id, $agora);
            break;
            case 'todos':
                echo json_encode($pedidoDb->getAllPedidos());

            break;
            case 'afazer':
                echo json_encode($pedidoDb->getAllPedidosAFazer($ultimoAcesso));
                $agora = date("Y-m-d H:i:s");
    
                $usuario->setUltimoAcesso($id, $agora);
            break;
            case 'afazer 0':
                echo json_encode($pedidoDb->getAllPedidosAFazer(0));
                $agora = date("Y-m-d H:i:s");
    
                $usuario->setUltimoAcesso($id, $agora);
            break;
        }
        
    break;

    default:
        echo json_encode($error_arry);
    break;

}


