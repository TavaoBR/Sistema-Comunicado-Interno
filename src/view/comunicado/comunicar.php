<?php 
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../controler/usuario/verifica.php");
verifica_user();


$id = $_SESSION['usuarioID'];
$id_user = mysqli_query($conectar, "SELECT * FROM usuario WHERE id_usuario = '$id' LIMIT 1");
$id_assoc = mysqli_fetch_assoc($id_user);

extract($id_assoc);



?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/historico.css">
    <title>Comunicado</title>
</head>
<body>
    <div class="wrapper">
        <?php include_once("../menu/sidebar.php")?>

        <div id="content">
            <?php include_once("../menu/navbar.php")?>
            <div class="main-content">
            <div class="row">
                  
            <div class='col-lg-4'>
                        <div class='card card-margin'>
                            <div class='card-header no-border'>
                                <h5 class='card-title'>Comunicar com Anexo</h5>
                            </div>
                            <div class='card-body pt-0'>
                                <div class='widget-49'>
                                    <ol class='widget-49-meeting-points'>
                                        <li class='widget-49-meeting-item'><span><h4></h4></span></li>
                                    </ol>
                                    
                            </ol>
                                
                                <br>
                                    <div class='widget-49-meeting-action'>
                                        <a href='../comunicado/comunicado_anexo.php' class='btn btn-sm btn-primary'>Comunicar</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class='col-lg-4'>
                        <div class='card card-margin'>
                            <div class='card-header no-border'>
                                <h5 class='card-title'>Comunicar sem Anexo</h5>
                            </div>
                            <div class='card-body pt-0'>
                                <div class='widget-49'>
                                    <ol class='widget-49-meeting-points'>
                                        <li class='widget-49-meeting-item'><span><h4></h4></span></li>
                                    </ol>
                                    
                            </ol>
                                
                                <br>
                                    <div class='widget-49-meeting-action'>
                                        <a href='../comunicado/comunicado_sem_anexo.php' class='btn btn-sm btn-primary'>Comunicar</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        </div>
           
            </div>
            </div>
            </div>
        </div>
</body>
</html>