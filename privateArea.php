<?php

    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("Location: index.php");
        exit();
    }

    if(isset($_GET['logout']))
    {
        //session_start();
        unset($_SESSION['id_usuario']);
        header("Location: index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Área Privada</title>
</head>
<body>
    <h2>Área privada.</h2>
    <p>Olá, isso é um Teste!</p>
    <a href="privateArea.php?logout=true">Sair</a>
</body>
</html>