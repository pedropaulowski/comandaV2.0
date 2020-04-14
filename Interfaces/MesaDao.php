<?php
namespace Interfaces;

use Classes\Mesa;


interface MesaDao {
    public function setMesa(Mesa $m):bool;
    public function getAllMesas():array;
    public function delete(string $id):bool;
    public function existeMesa(string $id):bool;

}