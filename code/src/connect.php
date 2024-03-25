<?php

function getConnect() {
    $user = 'root';
    $password = 'root';
    $db = 'brackets';
    $host = 'mariadb';
    $charset = 'utf8';
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $password);
        return $pdo;
    }catch (PDOException $e) {
        die($e->getMessage());
    }
}
