<?php

include ('functions.php');

$id = $_POST['id'];

try {

    $sql = "DELETE FROM user WHERE id = $id";

    $message = 'Usuário deletado com sucesso!';

    insertUpdateDelete($sql, $message);

} catch(PDOException $e) {

    pdocatch($e);
}