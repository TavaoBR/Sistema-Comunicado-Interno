<?php 
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../controler/usuario/verifica.php");
verifica_user();

if(isset($_POST['Responder'])){
  date_default_timezone_set('America/Sao_Paulo');
  $data = date("Y-m-d");
  $hora = date("H:i");
  $data_hora = date("Y-m-d H:i");

  $id = $_SESSION['usuarioID'];
  $id_user = mysqli_query($conectar, "SELECT * FROM usuario WHERE id_usuario = '$id'");
  $id_assoc = mysqli_fetch_assoc($id_user);
  
  extract($id_assoc);
  
  $id_comunicado = $_POST['id_comunicado'];
  $assunto = $_POST['assunto_comunicao'];
  $mensagem = mysqli_escape_string($conectar, $_POST['mensagem_comunicao']);
  $encaminhado = $_POST['encaminhado'];
     if($mensagem == ""){
       $_SESSION['mensagem_nulo'] = "<div class='alert alert-warning'>
       Preencha o campo obrigatorio.
       </div>";
       header("Location: ../../view/responder/responder_comunicado.php?comunicado=$id_comunicado");
     }else{

        $ci = 1;
        $oficio = "SELECT * FROM numero_ci";
        $resultado_oficio = mysqli_query($conectar, $oficio);
        while($pegar = mysqli_fetch_assoc($resultado_oficio)){
            if($pegar['numero_2022']){
              $ci++;
            }
        }

 $insert_resposta = mysqli_query($conectar, "INSERT INTO resposta_comunicado(fk_comunicado, fk_usuario, numero_comunicado, encaminhado, assunto_resposta, resposta_comunicado, data_resposta, hora_resposta, de_resposta, nome_usuario) 
 VALUES($id_comunicado,$id_usuario, $ci, '$encaminhado','$assunto','$mensagem','$data','$hora','$email', '$usuario')");

        if(mysqli_affected_rows($conectar) > 0){

            $insert_comunicado = mysqli_query($conectar, "INSERT INTO comunicao_interna(fk_usuario, de_email, email, numero, data_comunicao, hora_comunicao, de_comunicao, assunto_comunicao, mensagem_comunicao, assinatura_comunicao) VALUES ($id_usuario, '$email', '$encaminhado', $ci, '$data','$hora', '$setor', '$assunto', '$mensagem', '$nome')");
            $insert_numero_ci = mysqli_query($conectar, "INSERT INTO numero_ci(setor_oficio, destinatario_oficio, assunto_oficio, datahora_oficio, assinatura, numero_2022) VALUES ('$setor', '$encaminhado', '$assunto','$data_hora', 'Direção', $ci)");
          
            header("Location: ../../view/comunicado/visualizar_respostas.php?id_resposta=$id_comunicado ");
         
        }else{
  
          $_SESSION['erro'] = "<div class='alert alert-danger'>Erro. Entre em contato com o suporte</div>";
          header("Location: ../../view/responder/responder_comunicado.php?comunicado=$id_comunicado");

        }



     }
}