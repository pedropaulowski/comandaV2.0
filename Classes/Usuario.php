<?php

namespace Classes;

class Usuario {
    private string $id;
    private string $nome;
    private string $senha = '';
    private string $ultimo_acesso = '';

    public function setNome(string $n):void {
        $this->nome = trim(ucwords($n));
    }

    public function getNome():string {
        return $this->nome;
    }

    public function setId(string $i):void {
        $this->id = trim($i);
    }

    public function getId():string {
        return $this->id;
    }

    public function setSenha(string $s):void {
        $this->senha = password_hash($s, PASSWORD_BCRYPT);
    }

    public function getSenha():string {
        return $this->senha;
    }

    public function setUltimoAcesso(string $u):void {
        $this->senha = $u;
    }

    public function getUltimoAcesso():string {
        return $this->u;
    }
}

