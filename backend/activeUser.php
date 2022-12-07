<?php

include 'includes/conexao.php';

try {

  $token = $_GET['token'];

  $sql = "UPDATE user u INNER JOIN user_token t ON t.id_user = u.id SET u.status = 1 WHERE t.token = '$token'";

  $comando = $conn->prepare($sql);

  $comando->execute();

  $return = $comando->rowCount();
} catch (PDOException $erro) {

  $return = 0;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Senac - Ativação do Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <div class="container-sm">

    <div class="alert <?= $return != 0 ? 'alert-success' : 'alert-danger' ?>" role="alert">
      <?= $return != 0 ? 'Cadastro ativado com sucesso!' : 'Erro ao ativar cadastro' ?>
    </div>

    <a href="./../index.html">
        <button type="button" class="btn btn-primary">Acessar Sistema</button>
    </a>

  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>