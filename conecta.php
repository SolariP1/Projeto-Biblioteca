<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "biblioteca";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    die("Conexão falhou: ". mysqli_connect_error());
}
?>