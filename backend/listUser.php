<?php

include ('includes/conexao.php');

try {

    $sql = "SELECT id, name, email, created_at, status FROM user";

    $comando = $conn->prepare($sql);

    $comando->execute();

    $return = $comando->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;

} catch(PDOException $e) {

    $return = array(
        'return'=>'erro',
        'message'=>$e->getMessage()
    );

    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;
}

$conn = null;