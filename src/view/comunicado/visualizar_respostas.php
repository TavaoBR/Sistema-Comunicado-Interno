<?php 
session_start();
include_once("../../model/conection/conexao.php");
include_once("../../controler/usuario/verifica.php");
verifica_user();

$id_resposta = filter_input(INPUT_GET, 'id_resposta', FILTER_SANITIZE_NUMBER_INT );
$select_comunicado = mysqli_query($conectar, "SELECT * FROM comunicao_interna WHERE id_comunicao_interna = '$id_resposta'");
$select_resposta = mysqli_query($conectar, "SELECT * FROM resposta_comunicado WHERE fk_comunicado = '$id_resposta'");

$select_comunicado_assoc = mysqli_fetch_assoc($select_comunicado);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/historico.css">
    <title>visualizar_respostas</title>
<style>
   :root{
    --color1: #FD8F33;
    --color2: #0DC8AB;
    --color3: #05B0DE;
    --color4: #8E7CCC;
}
.main-timeline{
    font-family: 'Source Sans Pro', sans-serif;
    position: relative;
}
.main-timeline:after{
    content: '';
    display: block;
    clear: both;
}
.main-timeline .timeline{
    width: 50.1%;
    padding: 20px 0 20px 100px;
    float: right;
    position: relative;
    z-index: 1;
}
.main-timeline .timeline:before,
.main-timeline .timeline:after{
    content: '';
    background: var(--color1);
    height: 100%;
    width: 28px;
    position: absolute;
    left: -11px;
    top: 0;
}
.main-timeline .timeline:after{
    background: var(--color1);
    height: 18px;
    width: 200px;
    box-shadow: 0 0 10px -5px #000;
    transform:  translateY(-50%);
    top: 50%;
    left: -90px;
}
.main-timeline .timeline-content{
    color: #517d82;
    background-color: var(--color1);
    padding: 0 0 0 80px;
    box-shadow: 0 0 20px -10px #000;
    border-radius: 10px;
    display: block;
}
.main-timeline .timeline-content:hover{
    color: #517d82;
    text-decoration: none;
}
.main-timeline .timeline-icon{
    color: #fff;
    background-color: var(--color1);
    font-size: 35px;
    text-align: center;
    line-height: 62px;
    height: 60px;
    width: 60px;
    border-radius: 50%;
    transform: translateY(-50%);
    position: absolute;
    left: -100px;
    top: 50%;
    z-index: 1;
}
.main-timeline .timeline-year{
    color: #517d82;
    background-color: #fff;
    font-size: 30px;
    font-weight: 600;
    text-align: center;
    line-height: 93px;
    height: 113px;
    width: 113px;
    border: 6px solid var(--color1);
    box-shadow: 0 0 10px -5px #000;
    border-radius: 50%;
    transform: translateY(-50%);
    position: absolute;
    left: 50px;
    top: 50%;
    z-index: 1;
}
.main-timeline .inner-content{
    background-color: #fff;
    padding: 10px;
}
.main-timeline .title{
    color: var(--color1);
    font-size: 22px;
    font-weight: 600;
    margin: 0 0 5px 0;
}
.main-timeline .description{
    font-size: 14px;
    letter-spacing: 1px;
    margin: 0;
}
.main-timeline .timeline:nth-child(even){
    padding: 20px 100px 20px 0;
    float: left;
}
.main-timeline .timeline:nth-child(even):before{
    left: auto;
    right: -14.5px;
}
.main-timeline .timeline:nth-child(even):after{
    left: auto;
    right: -90px;
}
.main-timeline .timeline:nth-child(even) .timeline-content{ padding: 0 80px 0 0; }
.main-timeline .timeline:nth-child(even) .timeline-icon{
    left: auto;
    right: -100px;
}
.main-timeline .timeline:nth-child(even) .timeline-year{
    left: auto;
    right: 50px;
}
.main-timeline .timeline:nth-child(4n+2):before,
.main-timeline .timeline:nth-child(4n+2):after{
    background: var(--color2);
}
.main-timeline .timeline:nth-child(4n+2) .timeline-content,
.main-timeline .timeline:nth-child(4n+2) .timeline-icon{
    background-color: var(--color2);
}
.main-timeline .timeline:nth-child(4n+2) .timeline-year{ border-color: var(--color2); }
.main-timeline .timeline:nth-child(4n+2) .title{ color: var(--color2); }
.main-timeline .timeline:nth-child(4n+3):before,
.main-timeline .timeline:nth-child(4n+3):after{
    background: var(--color3);
}
.main-timeline .timeline:nth-child(4n+3) .timeline-content,
.main-timeline .timeline:nth-child(4n+3) .timeline-icon{
    background-color: var(--color3);
}
.main-timeline .timeline:nth-child(4n+3) .timeline-year{ border-color: var(--color3); }
.main-timeline .timeline:nth-child(4n+3) .title{ color: var(--color3); }
.main-timeline .timeline:nth-child(4n+4):before,
.main-timeline .timeline:nth-child(4n+4):after{
    background: var(--color4);
}
.main-timeline .timeline:nth-child(4n+4) .timeline-content,
.main-timeline .timeline:nth-child(4n+4) .timeline-icon{
    background-color: var(--color4);
}
.main-timeline .timeline:nth-child(4n+4) .timeline-year{ border-color: var(--color4); }
.main-timeline .timeline:nth-child(4n+4) .title{ color: var(--color4); }
@media only screen and (max-width:1200px){
    .main-timeline .timeline:before{ left: -12.5px; }
    .main-timeline .timeline:nth-child(even):before{ right: -14px; }
}
@media only screen and (max-width:990px){
    .main-timeline .timeline:before{ left: -12.5px; }
}
@media only screen and (max-width:767px){
    .main-timeline .timeline,
    .main-timeline .timeline:nth-child(even){
        width: 100%;
        padding: 20px 0 20px 37px;
    }
    .main-timeline .timeline:before{ left: 0; }
    .main-timeline .timeline:nth-child(even):before{
        right: auto;
        left: 0;
    }
    .main-timeline .timeline:after,
    .main-timeline .timeline:nth-child(even) .timeline:after{
        display: none;
    }
    .main-timeline .timeline-icon,
    .main-timeline .timeline:nth-child(even) .timeline-icon{
        left: 0;
        display: none;
    }
    .main-timeline .timeline-year,
    .main-timeline .timeline:nth-child(even) .timeline-year{
        height: 75px;
        width: 75px;
        line-height: 60px;
        font-size: 25px;
        left: 1px;
    }
    .main-timeline .timeline-content,
    .main-timeline .timeline:nth-child(even) .timeline-content{
        padding: 0 0 0 40px;
    }
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
                <center><h2>Historico de resposta comunicado: <?php echo $select_comunicado_assoc['numero']?></h2></center>
            <div class="col-md-12">
            <div class="main-timeline">
                <?php 
                while($puxar_resposta = mysqli_fetch_assoc($select_resposta)){
                  extract($puxar_resposta);
                
                  $data = date("d/m");
                ?>
                <div class="timeline">
                    <a class="timeline-content">
                        <div class="timeline-icon">
                        <i class="fa-solid fa-clipboard-list"></i>
                        </div>
                        <div class="timeline-year"><?php echo $data?></div>
                        <div class="inner-content">
                            <h3 class="title"><?php echo $nome_usuario?> respondeu:</h3>
                            <p class="description"><?php echo $resposta_comunicado?></p>
                        </div>
                    </a>
                </div>
                <?php 
                }
                ?>




            </div>
        </div>
           
            </div>
            </div>
            </div>
        </div>
</body>
</html>