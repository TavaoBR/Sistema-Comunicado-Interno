<?php 
function verfica_sessao(){
  if(!$_SESSION['usuarioID'] || !$_SESSION['usuarioUser'] || !$_SESSION['usuarioNivel3']){
        $_SESSION['loginErro'] = true;
        header("Location: ../../view/login/login.php");
        exit(); 
  }
}

function verifica_permissao_adm(){
 if($_SESSION['usuarioNivel3'] != "1"){
    $_SESSION['loginErro'] = true;
    header("Location: ../../view/login/login.php");
    exit(); 
 }
}

