<?php 
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../controler/usuario/verifica.php");
verifica_user();

$usuario_id = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);
$resposta_comunicado = mysqli_query($conectar, "SELECT DISTINCT fk_comunicado FROM resposta_comunicado WHERE fk_usuario = '$usuario_id'");


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/historico.css">
    <title>Respondidos</title>
</head>
<body>
<div class="wrapper">
        <?php include_once("../menu/sidebar.php")?>

        <div id="content">
            <?php include_once("../menu/navbar.php")?>
            <div class="main-content">
            <div class="row">
                  
                 
            <h2 class="font-weight-bold mb-2 text-center">Comunicados Respondidos</h2>
            
            <?php 
    while($puxar_batman = mysqli_fetch_assoc($resposta_comunicado)){
        extract($puxar_batman);
        $comunicado_resposta = mysqli_query($conectar, "SELECT * FROM comunicao_interna WHERE id_comunicao_interna = '$fk_comunicado'");
        $comunicado_resposta_assoc = mysqli_fetch_assoc($comunicado_resposta);
        $numero = $comunicado_resposta_assoc['numero'];
        $assunto_comunicao = $comunicado_resposta_assoc['assunto_comunicao'];
        $data_comunicao = $comunicado_resposta_assoc['data_comunicao'];
        $hora_comunicao = $comunicado_resposta_assoc['hora_comunicao'];

        echo"
        <div class='col-lg-4'>
        <div class='card card-margin'>
            <div class='card-header no-border'>
                <h3 class='card-title'>Numero comunicado $numero</h3>
            </div>
            <div class='card-body pt-0'>
                <div class='widget-49'>
                    <ol class='widget-49-meeting-points'>
                    <li class='widget-49-meeting-item'><span>Assunto: $assunto_comunicao</span></li>
                    <li class='widget-49-meeting-item'><span>Data: $data_comunicao</span></li>
                    <li class='widget-49-meeting-item'><span>Hora: $hora_comunicao</span></li>
                    </ol>
                    <br>
                    <div class='widget-49-meeting-action'>
                    <a href='../comunicado/visualizar_respostas.php?id_resposta=$fk_comunicado' target='_blank' class='btn btn-sm btn-primary' title='Visualizar respostas'><i class='fa-solid fa-eye'></i></a></span></li>
                    <a href='../responder/responder_comunicado.php?comunicado=$fk_comunicado' class='btn btn-sm btn-danger' title='Adicionar uma resposta'><i class='fa-solid fa-keyboard'></i></a></span></li>
                    </div>
                </div>
            </div>
        </div>
        </div>";
    }
  
  
  ?>
  

           
            </div>
            </div>
            </div>
        </div>
</body>
</html>