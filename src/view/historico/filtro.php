<?php
session_start();
include_once("../../model/conection/conexao.php");

$id = filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);

$area = $_GET['area'];
$inicio = $_GET['inicio'];
$fim  = $_GET['final'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/historico.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <title>Enviados</title>
    <style>
.form-control {
    border-radius: 0;
    box-shadow: none;
    border-color: #d2d6de
}

.select2-hidden-accessible {
    border: 0 !important;
    clip: rect(0 0 0 0) !important;
    height: 1px !important;
    margin: -1px !important;
    overflow: hidden !important;
    padding: 0 !important;
    position: absolute !important;
    width: 1px !important
}

.form-control {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s
}

.select2-container--default .select2-selection--single,
.select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0;
    padding: 6px 12px;
    height: 34px
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px
}

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 28px;
    user-select: none;
    -webkit-user-select: none
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-right: 10px
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 0;
    padding-right: 0;
    height: auto;
    margin-top: -3px
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 28px
}

.select2-container--default .select2-selection--single,
.select2-selection .select2-selection--single {
    border: 1px solid #d2d6de;
    border-radius: 0 !important;
    padding: 6px 12px;
    height: 40px !important
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 6px !important;
    right: 1px;
    width: 20px
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
                  
                 
            <h2 class="font-weight-bold mb-2 text-center">Comunicados enviados</h2>
            <hr>

            
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Filtro</h3>
                        <form class="requires-validation" method="GET" action="../historico/filtro.php"  enctype="application/x-www-form-urlencoded">
                    
                           <section class="container pt-3 mb-3">

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
                </div>
            </div>                

<hr>

<div class="container">
    <div class="row">
  <?php    
  
   if($area != "" AND $inicio != "" AND $fim != ""){
    $comunicado = mysqli_query($conectar, "SELECT * FROM comunicao_interna WHERE fk_usuario = '$id' AND email like '%$area%' AND data_comunicao BETWEEN '$inicio' AND '$fim' ORDER BY id_comunicao_interna DESC");
    while($puxar = mysqli_fetch_assoc($comunicado)){
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
                        <a href='../modeloci/ci.php?id=$id_comunicao_interna' target='_blank' class='btn btn-sm btn-primary' title='Visualizar Comunicado'><i class='fa-solid fa-eye'></i></a>
                        <a href='../historico/anexos.php?id=$id_comunicao_interna' class='btn btn-sm btn-success' title='Visualizar anexos'><i class='fa-solid fa-folder-open'></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>";
    }
   }elseif($area != ""){
    $comunicado = mysqli_query($conectar, "SELECT * FROM comunicao_interna WHERE fk_usuario = '$id' AND email like '%$area%' ORDER BY id_comunicao_interna DESC");
    while($puxar = mysqli_fetch_assoc($comunicado)){
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
                        <a href='../modeloci/ci.php?id=$id_comunicao_interna' target='_blank' class='btn btn-sm btn-primary' title='Visualizar Comunicado'><i class='fa-solid fa-eye'></i></a>
                        <a href='../historico/anexos.php?id=$id_comunicao_interna' class='btn btn-sm btn-success' title='Visualizar anexos'><i class='fa-solid fa-folder-open'></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>";
    }

   }elseif($inicio != "" AND $fim != ""){
    $comunicado = mysqli_query($conectar, "SELECT * FROM comunicao_interna WHERE fk_usuario = '$id' AND data_comunicao BETWEEN '$inicio' AND '$fim' ORDER BY id_comunicao_interna DESC");
    while($puxar = mysqli_fetch_assoc($comunicado)){
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
                        <a href='../modeloci/ci.php?id=$id_comunicao_interna' target='_blank' class='btn btn-sm btn-primary' title='Visualizar Comunicado'><i class='fa-solid fa-eye'></i></a>
                        <a href='../historico/anexos.php?id=$id_comunicao_interna' class='btn btn-sm btn-success' title='Visualizar anexos'><i class='fa-solid fa-folder-open'></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>";
    }
    
   }else{
    echo "<center><div class='alert alert-info'>Nada Encontrado</div></center>";
   }
  
  
  ?>
    
 
</div>
</div>
           
           
            </div>
            </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.select2').select2({
    closeOnSelect: false
});
});

setTimeout(function(){
           $("#tempo").fadeOut("fast");
         }, 3000);
</script>

</body>
</html>