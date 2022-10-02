<?php 
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../controler/usuario/verifica.php");
verifica_user();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/comunicado.css">
    <title>Comunicado</title>
</head>
<body>
    <div class="wrapper">
        <?php include_once("../menu/sidebar.php")?>

        <div id="content">
            <?php include_once("../menu/navbar.php")?>
            <div class="main-content">
            <div class="row">
                  
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Comunicado Interno </h3>
                        <?php 
                         if(isset($_SESSION['sucesso_sem_arquivo'])){
                            echo $_SESSION['sucesso_sem_arquivo'];
                            unset($_SESSION['sucesso_sem_arquivo']);
                         }
                        

                         if(isset($_SESSION['erro_sem_arquivo'])){
                             echo $_SESSION['erro_sem_arquivo'];
                             unset($_SESSION['erro_sem_arquivo']);
                         }

                        ?>

               <div class="form-check">
                  <button id="btnCheckTrue" class="btn btn-success">Marcar todos</button>
                  <p><button id="btnCheckFalse" class="btn btn-danger">Desmarcar todos</button></p>
                </div>

                        <form class="requires-validation" method="POST" action="../../controler/cadastro/enviar.php" enctype="multipart/form-data">

                <div class="col-md-12">
                <label class='form-check-label'><h4>Para:</h4></label>
                       
                <br>
                 <?php 
                  
                  $select_email = mysqli_query($conectar, "SELECT * FROM setores WHERE email != ''  ORDER BY email ASC");
                 
                  while($puxar = mysqli_fetch_assoc($select_email)){
                      extract($puxar);

                      echo "

                      <div class='form-check'>
                          <input class='form-check-input check' type='checkbox' value='$email' name ='email[]' >
                          <label class='form-check-label'>$nome_setor: $email</label>
                        </div>
                      
                      ";

                  }
                 ?>

                </div> 
<br>

                            <div class="col-md-12">
                               <label class='form-check-label'>Assunto:</label>
                               <input class="form-control" type="text" name="assunto_comunicao" required>
                            </div>

                            <br>

                            <div class="col-md-12">
                                <label class='form-check-label'>Mensagem:</label>
                                <textarea class="form-control" name="mensagem_comunicao" required></textarea>
                            </div>
                            
                            <div class="form-button mt-3">
                                <button name="Comunicar" type="submit" class="btn btn-primary">Comunicar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
           
            </div>
            </div>
            </div>
        </div>

        <script>
/*$('#summernote').summernote();*/
let checkbox = document.querySelectorAll('.check');
let btnCheckTrue = document.querySelector('#btnCheckTrue');
let btnCheckFalse = document.querySelector('#btnCheckFalse');

btnCheckTrue.addEventListener('click', () => {
  for(let current of checkbox){
      current.checked = true
  }
});

btnCheckFalse.addEventListener('click', () => {
  for(let current of checkbox){
      current.checked = false
  }
});

</script>        
</body>
</html>