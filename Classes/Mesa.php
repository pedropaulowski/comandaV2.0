<?php

namespace Classes;

class Mesa {
    private string $id;
    private int $numero;


    public function setNumero(int $n):void {
        $this->numero = trim($n);
    }

    public function getNumero():int {
        return $this->numero;
    }

    public function setId(string $i):void {
        $this->id = $i;

    }

    public function getId():string {
        return $this->id;
    }
}

