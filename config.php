<?php

$host = 'localhost';
$dbname = 'comanda_eletronica';
$dbuser = 'root';
$dbpwd = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpwd);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
    

