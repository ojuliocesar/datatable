<?php

include ('functions.php');

try {

    $id = $_POST['id'];

    $sql = "UPDATE user SET `status` = NOT `status` WHERE id = $id";

    $message='Status alterado com sucesso!';

    insertUpdateDelete($sql, $message);

} catch (PDOException $e) {
    $return = array('message'=>$e->getMessage(), 'return' => false);

    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;
}

// fechar conexão
$conn = null;