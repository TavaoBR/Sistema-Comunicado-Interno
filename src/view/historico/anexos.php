<?php
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../controler/usuario/verifica.php");
verifica_user();

$id_comunicado = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$comunicado = mysqli_query($conectar, "SELECT * FROM comunicao_interna WHERE id_comunicao_interna = '$id_comunicado' ");
$assoc_comunicado = mysqli_fetch_assoc($comunicado);
extract($assoc_comunicado);


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anexos</title>
    <style>
    
/*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/

/* List with bullets */
.list-bullets {
    list-style: none;
}

.list-bullets li {
    display: flex;
    align-items: center;
}

.list-bullets li::before {
    content: '';
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #5784d7;
    border: 2px solid #8fb3f5;
    display: block;
    margin-right: 1rem;
}

/* Unordered list with custom numbers style */
ol.custom-numbers {
    list-style: none;
}

ol.custom-numbers li {
    counter-increment: my-awesome-counter;
}

ol.custom-numbers li::before {
    content: counter(my-awesome-counter) ". ";
    color: #2b90d9;
    font-weight: bold;
}


/*
*
* ==========================================
* FOR DEMO PURPOSES
* ==========================================
*
*/
body {
    min-height: 100vh;
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
                  
                 
            <div class="container py-5">
    <!-- For demo purpose -->
    <div class="text-center ">
        <h5 class="display-4">Anexo(os) Comunicado <?php echo $numero?></h5>
</div>

    <div class="row py-5">
        <div class="col-lg-7 mx-auto">

            <?php 

 $anexo_comunicado = mysqli_query($conectar, "SELECT * FROM anexo_comunicado WHERE fk_comunicado = '$id_comunicado'");
  
  echo "<div class='card shadow mb-4'>";
  echo  "<div class='card-body p-5'>
        <h4 class='mb-4'>Nome dos arquivos</h4>
        <ul class='list-unstyled'>";
                
while($puxar = mysqli_fetch_assoc($anexo_comunicado)){
        extract($puxar);
        
        echo "
        <li class='mb-2'>$anexo &nbsp;&nbsp;&nbsp;<a href = '../anexo/$anexo' class ='btn btn-success' download >baixar</a></li>
        <hr>
        ";
    }
    echo "

    </ul>
    </div>
    </div>
    
    ";
  
  ?>

        </div>
        
    </div>
</div>

  

  
    

   
           
           
            </div>
            </div>
            </div>
        </div>

</body>
</html>