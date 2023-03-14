<?php

global $pdo;

$host = "localhost";
$database = "my_bd";
$charset = "utf-8";
$user = "root";
$password = "";

$pdo = new PDO("mysql:host=$host;dbname=session; char-
set=$charset ", $user, $password);

?>