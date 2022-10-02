<?php 
session_start();
include_once('../../model/conection/conexao.php' );
include_once("../../controler/usuario/verifica.php");
verifica_user();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../../model/src/Exception.php' );
require_once('../../model/src/PHPMailer.php' );
require_once('../../model/src/SMTP.php' );

if(isset($_POST['Comunicar'])){
  date_default_timezone_set('America/Sao_Paulo');
  $data = date("Y-m-d");
  $hora = date("H:i");
  $data_hora = date("Y-m-d H:i");

  $id = $_SESSION['usuarioID'];
  $id_user = mysqli_query($conectar, "SELECT * FROM usuario WHERE id_usuario = '$id'");
  $id_assoc = mysqli_fetch_assoc($id_user);
  
  extract($id_assoc);
  
  
  
  
  
    $ci = 1;
    $oficio = "SELECT * FROM numero_ci";
    $resultado_oficio = mysqli_query($conectar, $oficio);
    while($pegar = mysqli_fetch_assoc($resultado_oficio)){
        if($pegar['numero_2022']){
          $ci++;
        }
    }
     
        $fileConta = count($_FILES['anexo']['name']);
        $fk = $id_usuario;
        $de_comunicao = $setor;
        $de_email = $email;
        $assinatura_comunicao = $nome;
        $assunto_comunicao = mysqli_escape_string($conectar, $_POST['assunto_comunicao']);
        $mensagem_comunicao = mysqli_escape_string($conectar, $_POST['mensagem_comunicao']);
        $nome = $usuario;
    
        $mail_implode = $_POST['email'];
    
        $mail_envia = implode(", " , $mail_implode);
  
 if($fileConta > 1 OR  $fileConta == 1){

  $insert_comunicado = mysqli_query($conectar, "INSERT INTO comunicao_interna(fk_usuario, de_email, email, numero, data_comunicao, hora_comunicao, de_comunicao, assunto_comunicao, mensagem_comunicao, assinatura_comunicao) VALUES ($fk,'$de_email', '$mail_envia', $ci, '$data', '$hora', '$de_comunicao', '$assunto_comunicao', '$mensagem_comunicao', '$assinatura_comunicao')");
   
  
  
  if(mysqli_affected_rows($conectar) > 0){

    $insert_ci = mysqli_query($conectar, "INSERT INTO numero_ci(setor_oficio, destinatario_oficio, assunto_oficio, datahora_oficio, assinatura, numero_2022) VALUES ('$de_comunicao', '$mail_envia', '$assunto_comunicao', '$data_hora ', 'Direção', $ci)");

    $select_ultimo_comunicado = mysqli_query($conectar, "SELECT * FROM comunicao_interna ORDER BY id_comunicao_interna DESC LIMIT 1");
    $assoc = mysqli_fetch_assoc($select_ultimo_comunicado);
    
    extract($assoc);
     
    $insert_notificacao = mysqli_query($conectar, "INSERT INTO noticiacao_comunicado(fk_comunicado, fk_usuario, nome, assunto, data, hora, status, email) VALUES($id_comunicao_interna, $fk, '$nome', '$assunto_comunicao', NOW(), NOW(), 'Enviada', '$mail_envia')");

    for($i=0; $i<$fileConta; $i++){
      $fileName = $_FILES['anexo']['name'][$i];
      
      $inserir_anexo = mysqli_query($conectar, "INSERT INTO anexo_comunicado(fk_comunicado, anexo, date_anexo, time_anexo) VALUES($id_comunicao_interna, '$fileName', NOW(), NOW())");
      


      move_uploaded_file($_FILES['anexo']['tmp_name'][$i], "../../view/anexo/". $fileName);

  }

   

  $mail = new PHPMailer(true);

  $mail->CharSet = 'UTF-8';
  $mail->isSMTP();
  $mail->Host = 'mail.hram.com.br';
  $mail->SMTPAuth = true;
  $mail->Username = 'helpnowti@hram.com.br';
  $mail->Password = 'Batman';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = '465';
  
  $mail->setFrom("$de_email");
  $address = explode(', ', $mail_envia);
  foreach($address as $adress){
    $mail->addAddress(" $adress");
  }
  
  
  $mail->isHTML(true);
  $mail->Subject = utf8_decode("[Hospital amparo de maria] Comunicado Interno");
  $mail->Body = "<!DOCTYPE html>
  <html lang='pt-br'>
  <head>
      <meta charset='UTF-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1'>
      <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
      <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM' crossorigin='anonymous'></script>
      <link href='https://fonts.googleapis.com/css2?family=Material+Icons' rel='stylesheet'>
      <link rel='preconnect' href='https://fonts.googleapis.com'>
      <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
      <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap' rel='stylesheet'>
      <link rel='stylesheet' href='../css/menu.css'>
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css' integrity='sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==' crossorigin='anonymous' referrerpolicy='no-referrer' />
      <title>Menu</title>
  </head>
  <style>
  
  .card-margin {
      margin-bottom: 1.875rem;
  }
  
  .card {
      border: 0;
      box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
      -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
      -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
      -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
  }
  .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #ffffff;
      background-clip: border-box;
      border: 1px solid #e6e4e9;
      border-radius: 8px;
  }
  
  .card .card-header.no-border {
      border: 0;
  }
  .card .card-header {
      background: none;
      padding: 0 0.9375rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      min-height: 50px;
  }
  .card-header:first-child {
      border-radius: calc(8px - 1px) calc(8px - 1px) 0 0;
  }
  
  .widget-49 .widget-49-title-wrapper {
    display: flex;
    align-items: center;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-primary {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #edf1fc;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-day {
    color: #4e73e5;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-primary .widget-49-date-month {
    color: #4e73e5;
    line-height: 1;
    font-size: 1rem;
    text-transform: uppercase;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-secondary {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #fcfcfd;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-secondary .widget-49-date-day {
    color: #dde1e9;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-secondary .widget-49-date-month {
    color: #dde1e9;
    line-height: 1;
    font-size: 1rem;
    text-transform: uppercase;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-success {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #e8faf8;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-day {
    color: #17d1bd;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-success .widget-49-date-month {
    color: #17d1bd;
    line-height: 1;
    font-size: 1rem;
    text-transform: uppercase;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-info {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #ebf7ff;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-day {
    color: #36afff;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-info .widget-49-date-month {
    color: #36afff;
    line-height: 1;
    font-size: 1rem;
    text-transform: uppercase;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-warning {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: floralwhite;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-warning .widget-49-date-day {
    color: #FFC868;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-warning .widget-49-date-month {
    color: #FFC868;
    line-height: 1;
    font-size: 1rem;
    text-transform: uppercase;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-danger {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #feeeef;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-danger .widget-49-date-day {
    color: #F95062;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-danger .widget-49-date-month {
    color: #F95062;
    line-height: 1;
    font-size: 1rem;
    text-transform: uppercase;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-light {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #fefeff;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-light .widget-49-date-day {
    color: #f7f9fa;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-light .widget-49-date-month {
    color: #f7f9fa;
    line-height: 1;
    font-size: 1rem;
    text-transform: uppercase;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-dark {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #ebedee;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-dark .widget-49-date-day {
    color: #394856;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-dark .widget-49-date-month {
    color: #394856;
    line-height: 1;
    font-size: 1rem;
    text-transform: uppercase;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-base {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    background-color: #f0fafb;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-base .widget-49-date-day {
    color: #68CBD7;
    font-weight: 500;
    font-size: 1.5rem;
    line-height: 1;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-date-base .widget-49-date-month {
    color: #68CBD7;
    line-height: 1;
    font-size: 1rem;
    text-transform: uppercase;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-meeting-info {
    display: flex;
    flex-direction: column;
    margin-left: 1rem;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-pro-title {
    color: #3c4142;
    font-size: 14px;
  }
  
  .widget-49 .widget-49-title-wrapper .widget-49-meeting-info .widget-49-meeting-time {
    color: #B1BAC5;
    font-size: 13px;
  }
  
  .widget-49 .widget-49-meeting-points {
    font-weight: 400;
    font-size: 13px;
    margin-top: .5rem;
  }
  
  .widget-49 .widget-49-meeting-points .widget-49-meeting-item {
    display: list-item;
    color: #727686;
  }
  
  .widget-49 .widget-49-meeting-points .widget-49-meeting-item span {
    margin-left: .5rem;
  }
  
  .widget-49 .widget-49-meeting-action {
    text-align: right;
  }
  
  .widget-49 .widget-49-meeting-action a {
    text-transform: uppercase;
  }
  
  
  </style>
  <body>
  
  <div class = 'row'>      
      <h2><center>Comunicado</center></h2>
      </div>
  
      <div class='col-lg-4'>
      <div class='card card-margin'>
          <div class='card-header no-border'>
              <h5 class='card-title'>Numero Comunicado: $ci</h5>
          </div>
          <div class='card-body pt-0'>
              <div class='widget-49'>
                      <p class='widget-49-meeting-item'><span>Assunto: $assunto_comunicao</span></p>
                      <p class='widget-49-meeting-item'><span>Mensagem: $mensagem_comunicao</span></p>
                      <p class='widget-49-meeting-item'><a href='https://ecosistema.online/ComuniQ/src/view/comunicado/visualizaranexos.php?id=$id_comunicao_interna' class='btn btn-sm btn-primary'>Anexo</a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  
  <script src='../../model/scripts/jquery-3.3.1.slim.min.js'></script>
  <script src='../../model/scripts/popper.min.js'></script>
  <script src='../../model/scripts/bootstrap.min.js'></script>
  <script src='../../model/scripts/jquery-3.3.1.min.js'></script>
  <script src='../../model/scripts/jquery.mask.js'></script>
  
  <script>
      $(document).ready(function () {
              $('#sidebarCollapse').on('click', function () {
                  $('#sidebar').toggleClass('active');
          $('#content').toggleClass('active');
              });
        
         $('.more-button,.body-overlay').on('click', function () {
                  $('#sidebar,.body-overlay').toggleClass('show-nav');
              });
        
          });
  </script>
  <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js' integrity='sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p' crossorigin='anonymous'></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js' integrity='sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF' crossorigin='anonymous'></script>    
  </body>
  </html>";
  
  $mail->send();






  $_SESSION['sucesso_com_arquivo'] = "
  <div class='alert alert-success'>
  <strong> Sucesso!</strong>
  Comunicado Enviado com os anexos. Número da C.I: $ci
  </div>";
  header("Location: ../../view/comunicado/comunicado_anexo.php");

  }else{
    $_SESSION['erro_com_arquivo'] = "
    <div class='alert alert-danger'>
    <strong> Falha!</strong>
    Não foi possivel enviar seu comunicado. Entre em contato com o suporte
    </div>";
    header("Location: ../../view/comunicado/comunicado_anexo.php");
  }
      
 }

 } 



  
     
    
 


