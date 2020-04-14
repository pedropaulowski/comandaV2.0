<?php

namespace Classes;


class Pedido {
    private int $id = 0;
    private int $mesa;
    private array $pedidos;
    private array $precos;
    private string $obs = '';
    private float $total;
    private string $hora;
    private int $estado = 0;

    public function setMesa(int $m):void {
        $this->mesa = $m;
    }

    public function getMesa():int {
        return $this->mesa;
    }

    public function setId(int $i):void {
        $this->id = $i;
    }

    public function getId():int {
        return $this->id;
    }

    public function setPedidos(array $pedidos):void {
        $this->pedidos = $pedidos;
    }

    public function getPedidos():array {
        return $this->pedidos;
    }

    public function setPrecos(array $precos):void {
        $this->precos = $precos;
    }

    public function getPrecos():array {
        return $this->precos;
    }

    public function setObs(string $o):void {
        $this->obs = trim($o);
    }

    public function getObs():string {
        return $this->obs;
    }

    public function setTotal(array $precos):void {
        $this->total = array_sum($precos);
    }

    public function getTotal():float {
        return $this->total;
    }

    public function setHora(string $h):void {
        $this->hora = $h;
    }

    public function getHora():string {
        return $this->hora;
    }

    public function setEstado(int $e):void {
        $this->estado = $e;
    }

    public function getEstado():int {
        return $this->estado;
    }




}

