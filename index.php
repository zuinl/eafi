<?php
session_start();

include('src/meta.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bem-vindo ao EAFI</title>
</head>
<body style="margin-top: 0em;">
	<?php include('include/navbar.php');?>
	<div class="row" style="margin-top: 0.8em;">
		<div class="col-sm-5 offset-sm-4" >
			<h1 class="high-text">Bem-vindo ao <i><span class="destaque-text">EAFI</span></i></h1>
		</div>
	</div>

	<hr class="hr-divide">

	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				<h2 class="high-text">Edital de <i><span class="destaque-text">inscrições</span></i> 2019</h2>
			</div>
			<div class="col-sm-2">
				<a href="" target="blank_"><button class="button button1">Consulte Edital</button></a>
			</div>
			<div class="col-sm-5">
				<a href="inscricao.php"><button class="button button2">INSCREVA-SE</button></a>
				<h6 class="text">As inscrições pro EAFI 2019 se encerraram em 30/08/2019</h6>
			</div>
		</div>

		<hr class="hr-divide-light">

		<div class="row">
			<div class="col-sm-12">
				<h2 class="high-text">Conheça a<i><span class="destaque-text">Escola de Atletas e Formação Integral</span></i></h2>
			</div>
		</div>
		
</html>