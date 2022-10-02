<?php 
include_once("../../model/conection/conexao.php");
include_once("../../controler/usuario/verifica.php");
verifica_user();


$id = $_SESSION['usuarioID'];
$id_user = mysqli_query($conectar, "SELECT * FROM usuario WHERE id_usuario = '$id' LIMIT 1");
$id_assoc = mysqli_fetch_assoc($id_user);
$mail = $id_assoc['email'];
$idetificacao_user = $id_assoc['id_usuario'];

$notificacao = mysqli_query($conectar, "SELECT * FROM noticiacao_comunicado WHERE email like '%$mail%' and status = 'Enviada' ");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Menu</title>
</head>
<style>

</style>
<body>
<div class="body-overlay"></div>
         <nav id="sidebar">
              <div class="sidebar-header">
                <h3><img src="../logo/envelope-open-solid.svg" class="img-fluid"><span>ComuniQ</span></h3>
               </div>
               <ul class="list-unstyled components">
                  <li class="active">
                     <a href="https://hamworkspace.com/Sistema/src/view/modulos/modulos.php" class="dashboard"><i class="material-icons">house</i><span>Sistemas</span></a>
                  </li>

                  <div class="small-screen navbar-display">
				
				<li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <a href="#"><i class="material-icons">apps</i><span>apps</span></a>
                </li>
				
				 <li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <a href="#"><i class="material-icons">person</i><span>user</span></a>
                </li>
				
				<li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <a href="#"><i class="material-icons">settings</i><span>setting</span></a>
                </li>
				</div>
                  
                       <li  class="">
                          <a href="../comunicado/comunicar.php"><i class="material-icons">send</i><span>Comunicar</span></a>
                       </li>

                        <li  class="">
                          <a href="../historico/enviados.php?id_usuario=<?php echo $idetificacao_user?>"><i class="material-icons">forward_to_inbox</i><span>Enviados</span></a>
                        </li>

                        <li  class="">
                          <a href="../historico/recebidos.php?email=<?php echo $mail?>"><i class="material-icons">mark_email_unread</i><span>Recebidos</span></a>
                        </li>

                        
                        <li  class="">
                          <a href="../historico/respondidos.php?id_usuario=<?php echo $idetificacao_user?>"><i class="material-icons">mark_unread_chat_alt</i><span>Respondidos</span></a>
                        </li>

                <li class="">
                    <a href="../../controler/usuario/logout.php"><i class="material-icons">logout</i><span>Sair</span></a>
                </li>
              </ul> 
        </nav>


<script src="../../model/scripts/jquery-3.3.1.slim.min.js"></script>
<script src="../../model/scripts/popper.min.js"></script>
<script src="../../model/scripts/bootstrap.min.js"></script>
<script src="../../model/scripts/jquery-3.3.1.min.js"></script>
<script src="../../model/scripts/jquery.mask.js"></script>

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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>    
</body>
</html>