<?php
session_start();

include('src/meta.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Consulta de inscrição</title>
	<script>
			function valida() {
				var rg = document.getElementById('rg').value;

				if(rg == '' || rg.length < 8) {
					alert('RG inválido');
					return;
				} else {
					document.getElementById('form').submit();
				}
			}
		</script>
</head>
<body style="margin-top: 0em;">
	<?php include('include/navbar.php');?>
	<div class="row" style="margin-top: 0.8em;">
		<div class="col-sm-5 offset-sm-4" >
			<h1 class="high-text">Consulta da sua <i><span class="destaque-text">inscrição</span></i></h1>
		</div>
	</div>

	<hr class="hr-divide">

	<div class="container">
		<div class="row">
			<div class="col-sm-5 offset-sm-4">
				<h2 class="high-text">Insira o <i><span class="destaque-text">RG</span></i> do candidato</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 offset-sm-4">
			<form action="minhaInscricao.php" method="POST" id="form">
				<input type="text" name="rg" id="rg" class="form-control" maxlength="9" placeholder="Apenas números">
			</div>
			<div class="col-sm-1">
				<input type="button" class="btn btn-primary" value="Consultar" onclick="valida();">
			</div>
			</form>
		</div>

		<hr class="hr-divide-light">

		<div class="row">
			<div class="col-sm-7 offset-sm-3">
				<h2 class="high-text">Algumas informações <i><span class="destaque-text">importantes</span></i></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h4 class="high-text">As inscrições do EAFI 2019 <i><span class="destaque-text">se encerraram</span></i> 
				no dia 30 de agosto de 2019</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h4 class="high-text">As provas do EAFI 2019 serão realizadas nos dias <i><span class="destaque-text">21 e 22 de setembro</span></i> de 2019</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-7">
				<h4 class="high-text"><i><span class="destaque-text">Leia</span></i> o Edital, ele tem tudo o que você 
				precisa saber</h4>
			</div>
			<div class="col-sm-1">
				<a href="http://www.taubate.sp.gov.br/wp-content/uploads/2019/07/EDITAL-DE-PROCESSO-SELETIVO-EAFI-2019.pdf" target="blank_"><input type="button" class="btn btn-primary" value="Edital"></a>
			</div>
		</div>
		
</html>