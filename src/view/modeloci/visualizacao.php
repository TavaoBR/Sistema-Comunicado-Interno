<?php 
include_once("../../model/conection/conexao.php");
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d');
$time = date('H:i');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


$update_noti = mysqli_query($conectar, "UPDATE noticiacao_comunicado SET status = 'Lida' WHERE id_notificacao = '$id' LIMIT 1");
$select_notificacao = mysqli_query($conectar,"SELECT * FROM noticiacao_comunicado WHERE id_notificacao = '$id' LIMIT 1");
$assoc_notificacao = mysqli_fetch_assoc($select_notificacao);
extract($assoc_notificacao);

$numero_ci = "SELECT * FROM comunicao_interna WHERE id_comunicao_interna = '$fk_comunicado' limit 1";
$numero_ci_query = mysqli_query($conectar, $numero_ci);
$n_assoc = mysqli_fetch_assoc($numero_ci_query);


if($n_assoc['status'] == ""){
	$update = mysqli_query("UPDATE comunicao_interna SET status = 'Lido' WHERE id_comunicao_interna = '$id'");
}
?>
<!DOCTYPE html>
<html>
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
		<title>ASO</title>

		<link rel="stylesheet" href="reset.css">
		<link rel="stylesheet" href="style.css">
	</head>
	<style>

	</style>
	<body>
		<main>
			<table>
				<thead>
					<tr>
						<th colspan="5" class="imgens"><img src="Logo Ham PNG.png" alt="Logo HRAM"></th>
					</tr>
					
				</thead>
				<tbody>
					<tr>
						<td colspan="2" rowspan="2" class="ci">COMUNICA????O INTERNA</td>
						<td class="ci">N??MERO</td>
						<td class="ci">DATA</td>
					</tr>				
					<tr>
						<td class="ci"><?php echo $n_assoc['numero'];?></td>
						<td class="ci"><?php echo date("d/m/Y", strtotime($n_assoc['data_comunicao']));?></td>
					</tr>
					<tr>
						<td class="ci_esq">DE:</td>
						<td colspan="3"><?php echo $n_assoc['de_comunicao'];?></td>
					</tr>
					<tr>
						<td class="ci_esq">PARA:</td>
						<td colspan="3"><?php echo $n_assoc['email'];?></td>
					</tr>
					<tr>
						<td class="ci_esq">ASSUNTO:</td>
						<td colspan="3"><?php echo $n_assoc['assunto_comunicao'];?></td>
					</tr>
					<tr>
						<td colspan="4" class="ci_centro"><textarea class="form-contact-textarea"><?php echo $n_assoc['mensagem_comunicao'];?></textarea>
							<br><br><br><br>
						     <span class="baixo"><?php echo $n_assoc['assinatura_comunicao'];?></span>
							<p class="linha">________________________________________________________________</p>
							<p><i>ASSOCIA????O BENEFIC??NCIA AMPARO DE MARIA</i></p>
							<p>SITE: www.hospitalamparodemaria.com.br</p>
							<p>E-MAIL: secretaria.hram@hotmail.com</p>
							<p>CNPJ: 13.258.637/0001-24</p>
							<p>Rua Dr. Jess?? Fontes, 197 - Centro - Est??ncia - SE - CEP: 49200-000</p>
						</td>
					</tr>
				</tbody>
			</table>
		</main>
	</body>
</html>