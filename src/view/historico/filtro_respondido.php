<?php 
session_start();
include_once("../../model/conection/conexao.php");

$area = $_GET['area'];
$inicio = $_GET['inicio'];
$final = $_GET['final'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/historico.css">
    <title>Recebidos</title>
    <style>

    </style>
</head>
<body>
    

<div class="wrapper">
        <?php include_once("../menu/sidebar.php")?>

        <div id="content">
            <?php include_once("../menu/navbar.php")?>
            <div class="main-content">
            <div class="row">
                  
                 
            <h2 class="font-weight-bold mb-2 text-center">Comunicados recebidos</h2>

            <hr>

            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3><a href="#demo" class="btn btn-primary" data-bs-toggle="collapse">Filtro</a></h3>
                        <form class="requires-validation" method="GET" action="../historico/filtro_respondido.php"  enctype="application/x-www-form-urlencoded">
                    
            <section class="container pt-3 mb-3 collapse" id="demo">
            <div class="col-md-6 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6 card-title align-self-center mb-0">
                        <h6></h6>
                        <p class="m-0"><select name="area" id="">
                            <option value="">Selecione setor</option>
                            <?php 
                            $select_email = mysqli_query($conectar, "SELECT * FROM setores WHERE email != ''  ORDER BY email ASC");
                 
                                               while($puxar = mysqli_fetch_assoc($select_email)){
                                                   extract($puxar);

                                                   $emai = utf8_decode($email);
                             
                            ?>
                            <option value="<?php echo $emai?>"><?php echo $nome_setor?></option>
                            <?php }?>
                        </select></p>
                    </div>
                </div>
            </div>
        </div>

    <div class="col-md-6 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6 card-title align-self-center mb-0">
                        <h6>Data Inicial</h6>
                        <p class="m-0"><input type="date" name="inicio"></p>
                    </div>
                </div>
            </div>
        </div>


        
    <div class="col-md-6 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6 card-title align-self-center mb-0">
                        <h6>Data Final</h6>
                        <p class="m-0"><input type="date" name="final"></p>
                    </div>
                </div>
            </div>
        </div>

   <!-- <div class="col-md-6 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6 card-title align-self-center mb-0">
                        <h6>Forne</h6>
                        <p class="m-0"><select name="batman" id="">
                            <option value="">Selecione fornecedor</option>
                            <?php 
                              //$mes_select = mysqli_query($conectar, "SELECT * FROM fornecedor ");
                              //while($puxar_mes = mysqli_fetch_assoc($mes_select)){
                                //extract($puxar_mes);
                            ?>
                            <option value="<//?php echo $nome_fornecedor?>"><//?php echo $nome_fornecedor?></option>
                            <?php //}?>
                        </select></p>
                    </div>
                </div>
            </div>
    </div>-->


        <div class="col-md-6 col-xl-3">
            <div class="card m-b-30">
                <div class="card-body row">
                    <div class="col-6 card-title align-self-center mb-0">
                        <p class="m-0"><button class="btn btn-success">Filtrar</button></p>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</section>

                        </form>   
                    </div>
<br>
                    <hr>
  <?php 

 if($area != "" AND $inicio != "" AND $final != ""){
    $comunicado_recebido = mysqli_query($conectar, "SELECT * FROM comunicao_interna WHERE  fk_usuario != '$idetificacao_user' AND email like '%$area%' AND data_comunicao BETWEEN '$inicio' AND '$final' ORDER BY id_comunicao_interna DESC");
    while($puxar = mysqli_fetch_assoc($comunicado_recebido)){
        extract($puxar);
        
        echo "
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
                    <a href='../modeloci/ci.php?id=$id_comunicao_interna' target= '_blank' class='btn btn-sm btn-primary' title='Visualizar comunicado'><i class='fa-solid fa-eye'></i></a>
                    <a href='../responder/responder_comunicado.php?comunicado=$id_comunicao_interna' class='btn btn-sm btn-danger' title='Responder comunicado'><i class='fa-solid fa-keyboard'></i></a>
                    <a href='../historico/anexos.php?id=$id_comunicao_interna' class='btn btn-sm btn-success' title='Visualizar anexos'><i class='fa-solid fa-folder-open'></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>";
    }
 }elseif($area != ""){
    $comunicado_recebido = mysqli_query($conectar, "SELECT * FROM comunicao_interna WHERE  fk_usuario != '$idetificacao_user' AND email like '%$area%' ORDER BY id_comunicao_interna DESC");
    while($puxar = mysqli_fetch_assoc($comunicado_recebido)){
        extract($puxar);
        
        echo "
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
                    <a href='../modeloci/ci.php?id=$id_comunicao_interna' target= '_blank' class='btn btn-sm btn-primary' title='Visualizar comunicado'><i class='fa-solid fa-eye'></i></a>
                    <a href='../responder/responder_comunicado.php?comunicado=$id_comunicao_interna' class='btn btn-sm btn-danger' title='Responder comunicado'><i class='fa-solid fa-keyboard'></i></a>
                    <a href='../historico/anexos.php?id=$id_comunicao_interna' class='btn btn-sm btn-success' title='Visualizar anexos'><i class='fa-solid fa-folder-open'></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>";
    }
 }elseif($inicio != "" AND $final !=""){
    $comunicado_recebido = mysqli_query($conectar, "SELECT * FROM comunicao_interna WHERE  fk_usuario != '$idetificacao_user' AND data_comunicao BETWEEN '$inicio' AND '$final' ORDER BY id_comunicao_interna DESC");
    while($puxar = mysqli_fetch_assoc($comunicado_recebido)){
        extract($puxar);
        
        echo "
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
                    <a href='../modeloci/ci.php?id=$id_comunicao_interna' target= '_blank' class='btn btn-sm btn-primary' title='Visualizar comunicado'><i class='fa-solid fa-eye'></i></a>
                    <a href='../responder/responder_comunicado.php?comunicado=$id_comunicao_interna' class='btn btn-sm btn-danger' title='Responder comunicado'><i class='fa-solid fa-keyboard'></i></a>
                    <a href='../historico/anexos.php?id=$id_comunicao_interna' class='btn btn-sm btn-success' title='Visualizar anexos'><i class='fa-solid fa-folder-open'></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>";
    }
 }else{
    echo "<div class='alert alert-info'>Nada encontrado</div>";
 }


    
  ?>
    
 

           
           
            </div>
            </div>
            </div>
        </div>

</body>
</html>