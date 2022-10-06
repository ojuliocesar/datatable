<?php

include ('includes/conexao.php');

try {

    $id = $_POST['id'];

    $sql = "SELECT id, name, email, telephone, cpf, created_at, status FROM user WHERE id = {$id}";

    $comando = $conn->prepare($sql);

    $comando->execute();

    $return = $comando->fetch(PDO::FETCH_ASSOC);

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