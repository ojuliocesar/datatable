<?php

require_once('includes/conexao.php');

try {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['password-confirm'];

    if ($password != $confirmPassword) {
        // Cria um array para armazenar a mensagem de erro
        $return = array('message' => 'As senhas não conferem :/', 'return' => false);

        // Cria um json com relação ao array acima
        $json = json_encode($return, JSON_UNESCAPED_UNICODE);

        echo $json;
        exit();
    }

    $sql = "INSERT INTO user (`name`, email, `password`) VALUES ('$name', '$email', '$password')";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $return = array('message' => 'Usuário cadastrado com sucesso :p', 'return' => true);

    // Cria um json com relação ao array acima
    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;
} catch (PDOException $e) {
    $return = array('message' => $e->getMessage(), 'return' => false);

    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;
}

$conn = null;