<?php

namespace Dao;
use PDO;
use Classes\Produto;
use Interfaces\ProdutoDao;

class ProdutoMysql implements ProdutoDao {
    private $pdo;

    public function __construct(PDO $p) {
        $this->pdo = $p;
    }

    public function add(Produto $p): bool {
        $sql = "INSERT INTO produtos (id_produto, produto, preco, quantidade, descricao) 
        VALUES (:id_produto, :produto, :preco, :quantidade, :descricao)";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id_produto",$p->getId());
        $sql->bindValue(":produto",$p->getProduto());
        $sql->bindValue(":preco",$p->getPreco());
        $sql->bindValue(":quantidade",$p->getQuantidade());
        $sql->bindValue(":descricao",$p->getDescricao());
        $sql->execute();

        return true;
    }

    public function delete(string $id): bool {
        $sql = "DELETE FROM produtos WHERE id_produto = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        return true;
    }

    public function getAllProdutos(): array {
        $produtos = [];
        $sql = "SELECT * FROM produtos";
        $sql = $this->pdo->query($sql);

        if($sql->rowCount() > 0) {
            $sql = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($sql as $produto) {
                $produtos[] = [
                    "id_produto" => $produto['id_produto'],
                    "produto" => $produto['produto'],
                    "preco" => $produto['preco'],
                    "quantidade" => $produto['quantidade'],
                    "descricao" => $produto['descricao']
                ];
            }

        }

        return $produtos;
    }

    public function getProduto(string $id): array{

        $sql = "SELECT * FROM produtos WHERE id_produto = :id";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $sql = $sql->fetch(PDO::FETCH_ASSOC);
            return $sql;
        } else {
            return [];
        }
    }

    public function alterar(Produto $p): bool {
        $sql = "UPDATE produtos SET
        produto = :produto, 
        preco = :preco, 
        quantidade = :quantidade, 
        descricao = :descricao 
        WHERE id_produto = :id_produto";

        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(":produto", $p->getProduto());
        $sql->bindValue(":preco", $p->getPreco());
        $sql->bindValue(":quantidade", $p->getQuantidade());
        $sql->bindValue(":descricao", $p->getDescricao());
        $sql->bindValue(":id_produto", $p->getId());

        $sql->execute();

        return true;
    }
}
