<?php
namespace Dao;

use PDO;
use Classes\Pedido;



class PedidoMySql implements \Interfaces\PedidoDao{
    private $pdo;

    public function __construct(PDO $p) {
        $this->pdo = $p;
    }


    public function add(Pedido $p): bool {
        $pedidos = json_encode($p->getPedidos(), JSON_FORCE_OBJECT);
        $precos = json_encode($p->getPrecos(), JSON_FORCE_OBJECT);

        $sql = "INSERT INTO pedidos (mesa, pedidos, precos, obs, total, hora) 
        VALUES (:mesa, :pedidos, :precos, :obs, :total, :hora)";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":mesa", $p->getMesa());
        $sql->bindValue(":pedidos", $pedidos);
        $sql->bindValue(":precos", $precos);
        $sql->bindValue(":obs", $p->getObs());
        $sql->bindValue(":total", $p->getTotal());
        $sql->bindValue(":hora", $p->getHora());
        $sql->execute();

        return true;

    }

    public function delete(string $id): bool {
        $sql = "DELETE FROM pedidos WHERE id_pedido = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        return true;
    }

    public function getAllPedidos(): array {
        $pedidos = [];
        $sql = "SELECT * FROM pedidos";
        $sql = $this->pdo->query($sql);

        if($sql->rowCount() > 0) {
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql as $pedido) {               
                $pedido['mesa'];
                
                $pedidos[] = [
                    "id_pedido" => $pedido['id_pedido'],
                    "mesa" => $pedido['mesa'],
                    "pedidos" => json_decode(utf8_encode($pedido['pedidos']), true),
                    "precos" => json_decode($pedido['precos']),
                    "obs" => $pedido['obs'],
                    "total" => $pedido['total'],
                    "hora" => $pedido['hora'],
                    "estado" => $pedido['estado'],

                ];
            }

        }

        return $pedidos;
    }

    public function getPedido(int $id):Pedido {
        $pedido = new Pedido;

        $sql = "SELECT * FROM pedidos WHERE id_pedido = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        $sql = $sql->fetch();

        $pedido->setMesa($sql['mesa']);
        $pedido->setId($sql['id_pedido']);
        $pedido->setPedidos($sql['pedidos']);
        $pedido->setPrecos($sql['precos']);
        $pedido->setObs($sql['obs']);
        $pedido->setTotal($sql['total']);
        $pedido->setHora($sql['hora']);
        $pedido->setEstado($sql['estado']);


        return $pedido;
    }

    public function alterarEstado(int $id, int $estado, $hora):bool {
        $sql = "UPDATE pedidos set estado = :estado, hora = :hora WHERE id_pedido = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":estado", $estado);
        $sql->bindValue(":hora", $hora);
        $sql->bindValue(":id", $id);
        $sql->execute();

        return true;
    }

    public function getAllPedidosProntos(string $hora): array {
        $pedidos = [];
        $sql = "SELECT * FROM pedidos WHERE estado = 1 AND hora > :hora";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":hora", $hora);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql as $pedido) {               
                $pedido['mesa'];
                
                $pedidos[] = [
                    "id_pedido" => $pedido['id_pedido'],
                    "mesa" => $pedido['mesa'],
                    "pedidos" => json_decode(utf8_encode($pedido['pedidos']), true),
                    "precos" => json_decode($pedido['precos'], true),
                    "obs" => $pedido['obs'],
                    "total" => $pedido['total'],
                    "hora" => $pedido['hora'],
                    "estado" => $pedido['estado'],

                ];
            }

        }

        return $pedidos;
    }

    public function getAllPedidosAFazer(string $hora): array {
        $pedidos = [];
        $sql = "SELECT * FROM pedidos WHERE estado = 0 AND hora > :hora";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":hora", $hora);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql as $pedido) {               
                $pedido['mesa'];
                
                $pedidos[] = [
                    "id_pedido" => $pedido['id_pedido'],
                    "mesa" => $pedido['mesa'],
                    "pedidos" => json_decode(utf8_encode($pedido['pedidos']), true),
                    "precos" => json_decode($pedido['precos'], true),
                    "obs" => $pedido['obs'],
                    "total" => $pedido['total'],
                    "hora" => $pedido['hora'],
                    "estado" => $pedido['estado'],

                ];
            }

        }

        return $pedidos;
    }

    public function getAllPedidosParaPagar(string $hora): array {
        $pedidos = [];
        $sql = "SELECT * FROM pedidos WHERE estado = 2 AND hora > :hora";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":hora", $hora);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql as $pedido) {               
                $pedido['mesa'];
                
                $pedidos[] = [
                    "id_pedido" => $pedido['id_pedido'],
                    "mesa" => $pedido['mesa'],
                    "pedidos" => json_decode(utf8_encode($pedido['pedidos']), true),
                    "precos" => json_decode($pedido['precos'], true),
                    "obs" => $pedido['obs'],
                    "total" => $pedido['total'],
                    "hora" => $pedido['hora'],
                    "estado" => $pedido['estado'],

                ];
            }

        }

        return $pedidos;
    }
}
