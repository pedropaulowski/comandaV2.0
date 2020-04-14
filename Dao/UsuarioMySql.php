<?php
namespace Dao;
use PDO;
use Classes\Usuario;
use Interfaces\UsuarioDao;

class UsuarioMySql implements UsuarioDao {

    private $pdo;

    public function __construct(PDO $p) {
        $this->pdo = $p;
    }

    public function add(Usuario $u):bool {
        if( $this->existeNome($u->getNome()) == false) {
            $sql = "INSERT INTO usuarios (id_usuario, nome, senha) VALUES (:id_usuario, :nome, :senha)";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":id_usuario", $u->getId());
            $sql->bindValue(":nome", $u->getNome());
            $sql->bindValue(":senha", $u->getSenha());
            $sql->execute();

            return true;
        } else {
            return false;
        }
    }
    public function logIn(string $nome, string $senha):bool {
        $senhaDB = $this->getSenha($nome);
        if($senhaDB != false) {
            $sql = "SELECT * FROM usuarios WHERE nome = :nome";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":nome", $nome);
            $sql->execute();

            $sql = $sql->fetch();

            if(password_verify($senha, $senhaDB)) 
                return true;
            else 
                return false;
        } else {
            return false;
        }
    }

    public function editarSenha(string $nome, string $senha):bool {
        if($this->existeNome($nome) == true) {
            $sql = "UPDATE usuarios SET senha = :senha WHERE nome = : nome";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":senha", $senha);
            $sql->bindValue(":nome", $nome);
            $sql->execute();

            return true;

        } else {
            return false;
        }

    }

    public function getSenha(string $nome){
        $sql = "SELECT * FROM usuarios WHERE nome = :nome";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":nome", $nome);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            return $sql['senha'];
        } else {
            return false;
        }

    }

    public function getAllUsers():array {
        $usuarios = [];
        $sql = "SELECT * FROM usuarios";
        $sql = $this->pdo->query($sql);
        
        if($sql->rowCount() > 0) {
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC); 
            foreach($sql as $usuario) {
                $usuarios[] = [
                    'id_usuario' => $usuario['id_usuario'],
                    'nome' => $usuario['nome'],
                    'ultimo_acesso' => $usuario['ultimoa_acesso']
                ];
            }
        }

        return $usuarios;
    }

    public function getUserById(string $id):array {
        $usuario = [];
        $sql = "SELECT * FROM usuarios WHERE id_usuario = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch(PDO::FETCH_ASSOC); 
            return [
                'id_usuario' => $sql['id_usuario'],
                'nome' => $sql['nome']
            ];
        }

        return $usuario;
    }

    

    
    public function existeNome(string $nome):bool {
        $sql = "SELECT * FROM usuarios WHERE nome = :nome";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":nome", $nome);
        $sql->execute();

        if($sql->rowCount() > 0)
            return true; 
        else
            return false;
    }

    public function delete(string $id): bool {
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        return true;
    }

    public function getUltimoAcesso(string $id): string {
        $sql = "SELECT * FROM usuarios WHERE id_usuario = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        $sql = $sql->fetch();
        
        return $sql['ultimo_acesso'];
    }

    public function setUltimoAcesso(string $id, string $hora):bool {
        $sql = "UPDATE usuarios SET ultimo_acesso = :hora WHERE id_usuario = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":hora", $hora);
        $sql->execute();

        return true;
    }

    public function getIdByNome(string $nome): string {
        $sql = "SELECT * FROM usuarios WHERE nome = :nome";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":nome", $nome);
        $sql->execute();

        $sql = $sql->fetch();
        
        return $sql['id_usuario'];
    }
    
}