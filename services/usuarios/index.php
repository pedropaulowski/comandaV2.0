<?php 

session_start();
date_default_timezone_set('America/Sao_Paulo');

require '../../vendor/autoload.php';
require '../../config.php';

use Dao\UsuarioMySql;

$hora = date("Y-m-d H:i:s");

$method = $_SERVER['REQUEST_METHOD'];
$header = getallheaders();
$error_array = ['error' => 'access deined'];


$usuarioDb = new UsuarioMySql($pdo);

switch($method) {
    case 'PUT':
        $parametros = (json_decode(file_get_contents("php://input"), true));
        echo json_encode($error_array);
    break;

    case 'DELETE':
        $parametros = (json_decode(file_get_contents("php://input"), true));
        $id = $parametros['id_usuario'];
        
        /**
        * Parametro "id_usuario"
        */

        $usuarioDb->delete($id);

    break;

    case 'POST':
        $parametros = (json_decode(file_get_contents("php://input"), true));

        $login_success_array = [
            'login'=> true,
        ];

        $login_error_array = [
            'login'=> false,
        ];

        $singup_success_array = [
            'singup'=> true,
        ];

        $singup_error_array = [
            'singup'=> false,
        ];
        /**
         * Parametros "acao" : "entrar" ou "cadastrar",
         * "nome":
         * "senha":
         */


        $acao = $parametros['acao'];

        if($acao == 'sair') {
            unset($_SESSION['nome']);
            exit;
        }

        $nome = $parametros['nome'];
        $senha = $parametros['senha'];
        $id_usuario = md5($nome.$hora);

        if($acao == 'entrar') {
            if($usuarioDb->logIn($nome, $senha)) {
                $_SESSION['nome'] = $nome;
                echo json_encode($login_success_array);
            } else {
                echo json_encode($login_error_array);
            }
        } else if($acao == 'cadastrar') {
            $usuario = new Classes\Usuario;

            $usuario->setId($id_usuario);
            $usuario->setNome($nome);
            $usuario->setSenha($senha);

            if($usuarioDb->add($usuario) == true) {
                $_SESSION['nome'] = $nome;
                echo json_encode($singup_success_array);
            } else {
                echo json_encode($singup_error_array);

            }
        }

    break;

    case 'GET':
        $parametros = (json_decode(file_get_contents("php://input"), true));
        /**
         * Parametro opcional "id_usuario"
         */
        if(isset($parametros['id_usuario']))
            echo json_encode($usuarioDb->getUserById($parametros['id_usuario']));
        else
            echo json_encode($usuarioDb->getAllUsers());
    break;

    default:
        echo json_encode($error_array);
    break;

}


