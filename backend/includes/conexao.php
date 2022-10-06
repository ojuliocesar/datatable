<?php

define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE', 'db_datatable');

try {
    // dados da conexao com o banco
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DATABASE . ";charset=utf8", USERNAME, PASSWORD);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    echo $e->getMessage();
}