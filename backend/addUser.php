<?php

include ('functions.php');

include 'sendEmail.php';

try {

    $carac = array(
        '(',
        ')',
        '-',
        ' ',
        '.'
    );

    $name = $_POST['name'];

    $email = $_POST['email'];

    $tel = str_replace($carac, '', $_POST['tel']);

    $cpf = str_replace($carac, '', $_POST['cpf']);

    $password = $_POST['password'];

    $confirmPassword = $_POST['password-confirm'];

    // valida se o campo nome esta preechido
    validateField($name,'Nome');

    validateField($email,'Email');

    validateField($tel,'Telefone');

    validateField($cpf,'CPF');

    validateField($password,'Senha');

    validateField($confirmPassword,'confirmar Senha');

    checkUser($email, $cpf);

    if ($password != $confirmPassword) {

        $return = array('message' => 'As senhas não conferem :/', 'return' => false);

        $json = json_encode($return, JSON_UNESCAPED_UNICODE);

        echo $json;
        exit();
    }

    $password = sha1($password);

    $sql = "INSERT INTO user (`name`, email, `telephone`, `cpf`, `password`) VALUES ('$name', '$email', '$tel', '$cpf', '$password')";

    $message = 'Usuário adicionado com sucesso!';

    insertUpdateDelete($sql,$message);

    $token = generateToken($email);

    sendEmail($email, $name, $token);

} catch (PDOException $e) {
    pdocatch($e);
}

$conn = null;