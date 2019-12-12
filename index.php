<?php
    require_once 'classes/Usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/style.css">
    <title>Projeto Login</title>
</head>
<body>
    <div id="form-body">
        <h1>Entrar</h1>
        <form method="POST">
            <input type="email" name="email" placeholder="Usuário" autofocus required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="submit" value="Acessar">
            <a href="signup.php"><strong>Cadastre-se</strong></a>
        </form>
    </div>
<?php

    if(isset($_POST['email']))
    {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        if(!empty($email) && !empty($senha))
        {
            if($usuario->logar($email, $senha))
            {
                header("Location: privateArea.php");
            }
            else
            {
                ?>
                    <div class="msg-erro">Email e/ou senha incorretos!</div>
                <?php
            }
        }
        else
        {
            ?>
                <div class="msg-erro">Preencha todos os campos!</div>
            <?php
        }
    }
?>
</body>
</html>