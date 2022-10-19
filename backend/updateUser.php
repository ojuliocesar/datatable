<?php

include ('functions.php');

$carac = array(
    '(',
    ')',
    '-',
    ' ',
    '.'
);

$id = $_POST['id'];

$name = $_POST['name'];

$email = $_POST['email'];

$tel = str_replace($carac, '', $_POST['tel']);

$cpf = str_replace($carac, '', $_POST['cpf']);

// valida se o campo nome esta preechido
validateField($name, 'Nome');

validateField($email, 'Email');

validateField($tel, 'Telefone');

validateField($cpf, 'CPF');

checkUserUpdate($email, $cpf);

try {

    $sql = "UPDATE user SET name = '$name', email = '$email', telephone = '$tel', cpf = '$cpf' WHERE id = $id";

    $message = 'Usuário atualizado com sucesso!';

    insertUpdateDelete($sql, $message);

} catch(PDOException $e) {

    pdocatch($e);
}