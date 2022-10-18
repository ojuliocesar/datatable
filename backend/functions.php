<?php
// Arquivo de funções genéricas que podem ser utilizadas em qualquer página

include_once ('./includes/conexao.php');

function validateField($field, $fieldName)

{

    if($field == ''){
        // Cria um array para armazenar a mensagem de erro
        $return = array('message' => 'Preencha o campo '.$fieldName.'!', 'return' => false);

        // Cria um json com relação ao array acima
        $json = json_encode($return, JSON_UNESCAPED_UNICODE);

        echo $json;
        exit();
    }
}

function insertUpdateDelete($sql, $message)
{

    $comando = $GLOBALS['conn']->prepare($sql);

    $comando->execute();

    $return = array('message' => $message, 'return' => true);

    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;
}

// Função que valída que o Email digitado já está cadastrado.
function checkEmailUser($email)
{

    $sql = "SELECT email FROM user WHERE email = '{$email}'";

    $comando = $GLOBALS['conn']->prepare($sql);

    $comando->execute();

    $validaEmail = $comando->fetchAll(PDO::FETCH_ASSOC);

    if ($validaEmail != null) {
        
        $return = array(
            'return' => false,
            'message' => 'E-mail já cadastrado, verifique e tente novamente'
        );

        $json = json_encode($return, JSON_UNESCAPED_UNICODE);

        echo $json;
        exit();
    }

}

function checkCpfUser($cpf)
{

    $sql = "SELECT cpf FROM user WHERE cpf = '{$cpf}'";

    $comando = $GLOBALS['conn']->prepare($sql);

    $comando->execute();

    if ($comando->rowCount()) {

        $return = array(
            'return' => false,
            'message' => 'CPF já cadastrado, verifique e tente novamente'
        );

        $json = json_encode($return, JSON_UNESCAPED_UNICODE);

        echo $json;
        exit();
    }

}

function generateToken($email) {
    $sql = "SELECT id FROM user WHERE email = '{$email}'";

    $comando = $GLOBALS['conn']->prepare($sql);

    $comando->execute();

    $dados = $comando->fetch(PDO::FETCH_ASSOC);

    $idUsuario = $dados['id'];

    $token = md5(uniqid());

    $sql = "INSERT INTO user_token (id_user, token) VALUES ($idUsuario, '{$token}')";

    $comando = $GLOBALS['conn']->prepare($sql);

    $comando->execute();

    return $token;
}

function pdocatch($e)
{
    $return = array('message'=>$e->getMessage(), 'return' => false);

    $json = json_encode($return, JSON_UNESCAPED_UNICODE);

    echo $json;
}