<?php
namespace Interfaces;

use Classes\Pedido;


interface PedidoDao {
    public function add(Pedido $p):bool;
    public function delete(string $id):bool;
    public function getAllPedidos():array;
    public function getPedido(int $id):Pedido;  
    public function alterarEstado(int $id, int $estado, string $hora):bool;
    public function getAllPedidosAFazer(string $hora):array;
}