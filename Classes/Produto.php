<?php

namespace Classes;

class Produto {
    private string $id = '';
    private string $produto = '';
    private float $preco;
    private int $quantidade;
    private string $descricao = '';

    public function setId(string $i):void {
        $this->id = trim($i);
    }

    public function getId():string {
        return $this->id;
    }

    public function setProduto(string $p):void {
        $this->produto = ucwords(trim($p));
    }

    public function getProduto():string {
        return $this->produto;
    }

    public function setPreco(float $p):void {
        $this->preco = $p;
    }

    public function getPreco():float {
        return $this->preco;
    }

    public function setQuantidade(int $q):void {
        $this->quantidade = $q;
    }

    public function getQuantidade():int {
        return $this->quantidade;
    }

    public function setDescricao(string $d):void {
        $this->descricao = trim($d);
    }

    public function getDescricao():string {
        return $this->descricao;
    }
}

