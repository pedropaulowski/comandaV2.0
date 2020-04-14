<?php
namespace Dao;

use PDO;
use Classes\Mesa;
use Interfaces\MesaDao;

class MesaMySql implements MesaDao {
    private $pdo;

    public function __construct(PDO $p) {
        $this->pdo = $p;
    }

    public function setMesa(Mesa $m):bool {
        if($this->existeMesa($m->getId()) == false) {
            $sql = "INSERT INTO mesas (id_mesa, numero) VALUES (:id_mesa, :numero)";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(":id_mesa", $m->getId());
            $sql->bindValue(":numero", $m->getNumero());
            $sql->execute();

            if($this->existeMesa($m->getId()) == true)
                return true;
            else 
                return false;

        } else {
            return false;
        }
    }

    public function existeMesa(string $id):bool {
        $sql = "SELECT * FROM mesas WHERE id_mesa = :id_mesa";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id_mesa", $id);
        $sql->execute();

        if($sql->rowCount() > 0)
            return true;
        else
            return false;
    }

    public function delete(string $id):bool {
        $sql = "DELETE FROM mesas WHERE id_mesa = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id_mesa", $id);
        $sql->execute();

        if($this->existeMesa($id) == false)
            return true;
        else 
            return false;
    }

    public function getAllMesas():array {
        $mesas = [];
        $sql = "SELECT * FROM mesas";
        $sql = $this->pdo->query($sql);
        
        if($sql->rowCount() > 0) {
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($sql as $mesa) {
                $mesas[] = [
                    'id_mesa' => $mesa['id_mesa'],
                    'numero' => $mesa['numero']
                ];
            }
        }

        return $mesas;
    }

    
    
}