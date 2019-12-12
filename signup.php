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
    <title>Cadastro de usuário</title>
</head>
<body>
    <div id="form-body-cad">
        <h1>Cadastrar Usuário</h1>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" maxlength="30" required>
            <input type="text" name="telefone" placeholder="Telefone" maxlength="30" required>
            <input type="email" name="email" placeholder="Usuário" maxlength="50" required>
            <input type="password" name="senha" placeholder="Senha" required maxlength="20" required>
            <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="20" required>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
<?php

    //verificar se clicou no botao
    if(isset($_POST['nome']))
    {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confSenha']);

        if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
        {
            if($senha === $confirmarSenha)
            {
                if($usuario->cadastrar($nome, $telefone, $email, $senha))
                {
                    ?>
                        <div id="msg-sucesso">Usuário cadastrado com sucesso!</div>
                    <?php
                }
                else
                {
                    ?>
                        <div class="msg-erro">Este email já foi cadastrado anteriormente</div>
                    <?php
                }
            }
            else
            {
                ?>
                    <div class="msg-erro">Senhas não coincidem!</div>
                <?php
            }
        }
    }
?>
</body>
</html>