<?php
    session_destroy();
    session_start();
    unset(
        $_SESSION['usuarioID'],
        $_SESSION['usuarioUser'],
        $_SESSION['usuarioEmail'],
        $_SESSION['usuarioSenha'],
        $_SESSION['usuarioNivel3']
    );

    $_SESSION['logindeslogado'] = true;
    //redirecionar o usuario para a página de login
    header("Location: ../../view/login/login.php");
?>