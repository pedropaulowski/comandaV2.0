<?php
namespace Interfaces;
use Classes\Usuario;

interface UsuarioDao {
    public function add(Usuario $u):bool;
    public function logIn(string $nome, string $senha):bool;
    public function editarSenha(string $nome, string $senha):bool;
    public function getSenha(string $nome);
    public function getAllUsers():array;
    public function existeNome(string $nome):bool;
    public function delete(string $id):bool;
    public function getUserById(string $id):array;
    public function setUltimoAcesso(string $id, string $hora):bool;
    public function getUltimoAcesso(string $id):string;
    public function getIdByNome(string $nome): string;
}