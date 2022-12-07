<?php

include ('functions.php');

$id = $_POST['id'];

try {

    $sql = "DELETE FROM user_token WHERE id_user = $id";

    $comando = $conn->prepare($sql);

    $comando->execute();

    $sql = "DELETE FROM user WHERE id = $id";

    $message = 'Usuário deletado com sucesso!';

    insertUpdateDelete($sql, $message);

} catch(PDOException $e) {

    pdocatch($e);
}