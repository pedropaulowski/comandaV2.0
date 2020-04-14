<?php
namespace Interfaces;

use Classes\Produto;

interface ProdutoDao {
    public function add(Produto $p):bool;
    public function delete(string $id):bool;
    public function getAllProdutos():array;
    public function getProduto(string $id):array;
    public function alterar(Produto $p):bool;  
                    
}