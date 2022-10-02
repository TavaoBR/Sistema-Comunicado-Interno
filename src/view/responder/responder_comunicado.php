<?php 
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../controler/usuario/verifica.php");
verifica_user();

$id_comunicado = filter_input(INPUT_GET, 'comunicado', FILTER_SANITIZE_NUMBER_INT);
$comunicado = mysqli_query($conectar, "SELECT * FROM comunicao_interna WHERE id_comunicao_interna = '$id_comunicado' LIMIT 1");
$comunicado_assoc = mysqli_fetch_assoc($comunicado);
extract($comunicado_assoc);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/comunicado.css">
    <title>Responder comunicado</title>
    <style>
.limitar{
    display: none;
}

.input-box.active .limitar{
    display: block;
}
    </style>
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
                        <h3>Resposta para comunicado <?php echo $numero?></h3>


                        <form class="requires-validation" method="POST" action="../../controler/cadastro/resposta.php" enctype="multipart/form-data">
                         
                        <input type="hidden" name="id_comunicado" value="<?php echo $id_comunicado?>">
                        <input type="hidden" name="encaminhado" value="<?php echo $email?>">

                        <div class="col-md-12" id="batman">
                               <label class='form-check-label'>Assunto:</label>
                               <input class="form-control" value="<?php echo $assunto_comunicao?>" type="text" readonly>
                            </div>

                        <div class="col-md-12" id="mostrar">
                           <label class="form-check-label"></label>    
                              <select id="select_mostrar"> 
                                <option value="">Deseja alterar assunto?</option>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>    
                              </select>
                        </div>

                            <div class="col-md-12" id="esconder">
                               <label class='form-check-label'>Assunto:</label>
                               <input class="form-control" value="<?php echo $assunto_comunicao?>" type="text" name="assunto_comunicao" required>
                            </div>

                            <br>

                            <hr>
                            <h3>Formulario resposta ao assunto: <?php echo $assunto_comunicao?></h3>

                            <?php 
                               if(isset($_SESSION['mensagem_nulo'])){
                                   echo $_SESSION['mensagem_nulo'];
                                   unset($_SESSION['mensagem_nulo']);
                               }
                               
                               if(isset($_SESSION['erro'])){
                                   echo $_SESSION['erro'];
                                   unset($_SESSION['erro']);
                               }
                            ?>

                            <div class="col-md-12">
                                <div class="input-box">
                                <label class='form-check-label'><span class="text-danger">*</span>Mensagem resposta:</label>
                                <textarea class="textarea form-control" name="mensagem_comunicao" maxlength="4000"></textarea>
                                <div class="limitar">
                                <span class="minimo text-white ">0</span>
                                <span class="maximo text-white ">/4000</span>
                                </div>    
                                </div>
                            </div>

                            <div class="form-button mt-3">
                                <button name="Responder" type="submit" class="btn btn-danger">Responder</button>
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
        $(document).ready(function(){
        $('#esconder').hide();
        $('#select_mostrar').change(function(){
          if($('#select_mostrar').val() == 'Sim'){
              $('#esconder').show();
              $('#mostrar').hide();
              $('#batman').hide();
          }else{
              $('#mostrar').show();
              $('#batman').show();
              $('#esconder').hide();
          }
        });
    });
</script>

        <script>
             let inputBox = document.querySelector(".input-box");
             textarea = inputBox.querySelector("textarea");
             minimo = inputBox.querySelector(".minimo");

             textarea.addEventListener("keyup", ()=> {
              let valorCarecter = textarea.value.length;

              minimo.innerHTML = valorCarecter;

              valorCarecter > 0
              ? inputBox.classList.add("active")
              : inputBox.classList.remove("active");

              valorCarecter >4000
              ? inputBox.classList.add("error")
              : inputBox.classList.remove("error");

              console.log(valorCarecter);
             });
        </script>

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