<?php

require_once('includes/conexao.php');

try {

    $sql = "SELECT name, email FROM user";

    $comands = $conn->prepare($sql);

    $comands->execute();

    $return = $comands->fetchAll(PDO::FETCH_ASSOC);

    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;

} catch(PDOException $e) {
    $return = array('return' => false, 'message' => $e->getMessage());

    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;
}

$conn = null;