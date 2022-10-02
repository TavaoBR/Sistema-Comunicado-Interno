<?php

function verifica_user(){
    if(!$_SESSION['usuarioID'] || !$_SESSION['usuarioUser'] || !$_SESSION['usuarioNivel3'])
    {
     $_SESSION['loginErro'] = true;
     header("Location: ../../view/login/login.php");
     exit();
    }
}