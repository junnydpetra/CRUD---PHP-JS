<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "crud_php_js";
    $port = 3306;

    try {
        $conector = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);

        // echo "Conexão com a base de dados realizada com sucesso!";
    } catch (\Throwable $th) {
        // echo "Falha ao realizar a conexão com a base de dados!";
    }

?>