<?php

include ('includex/conexao.php');

try {

    $token = $_GET['token'];

    $sql = "
        UPDATE user u 
            INNER JOIN user_token t ON t.id_user = u.id 
            SET u.status = 1 
        WHERE t.token = '$token'
    ";

} catch (PDOException $e) {
    echo $e->getMessage();
}
