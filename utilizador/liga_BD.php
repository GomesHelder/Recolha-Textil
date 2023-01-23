<?php
// Definir dados de acesso à base de Dados
$servername ="localhost";
$username ="root";
$password ="";
$dbname = "projeto";

// Criar conexão à base de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão à base de dados
if($conn->connect_error)
{
    die("Connection failed: ". $conn->connect_error);
}