<?php
session_start();

include('src/meta.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bem-vindo ao Staffast</title>
</head>
<body style="margin-top: 0em;">
	<div class="row" style="margin-top: 0.8em;">
		<div class="col-sm-6" >
			<h1 class="high-text">Bem-vindo ao <i><span class="destaque-text">Staffast</span></i></h1>
		</div>
		<div class="col-sm-2">
			<form action="database/login.php?login=true" method="POST">
			<input id="email" name="email" type="email" placeholder="E-mail" class="form-control form-control-sm">
		</div>
		<div class="col-sm-2">
			<input id="senha" name="senha" type="password" placeholder="Senha" class="form-control form-control-sm">
			<a href="recuperarSenha.php" class="text">Esqueceu a senha?</a>
		</div>
		<div class="col-sm-2">
			<input id="submit" type="submit" class="button button1" value="Entrar">
			</form>
		</div>
	</div>
	<?php
    if(isset($_SESSION['msg'])) {
        ?>
		<div class="row">
			<div class="alert alert-info" role="alert">
				<?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
			</div>
		</div>
        <?php
    }
    ?>
	
	<hr class="hr-divide">

	<div class="container">
		<div class="row">
			<div class="col-sm-8">
				<h1 class="high-text">Você ainda não faz <i><span class="destaque-text">parte</span></i> do Staffast?</h1>
			</div>
			<div class="col-sm-4">
				<a href="novaEmpresa.php"><button class="button button2">Traga sua empresa</button></a>
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-sm-12">
				<h2 class="high-text">Subtítulo aqui</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<p class="text">Texto aqui</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 offset-sm-5">
				<a href="novaInstituicao.php"><button class="button button2">Faça parte</button></a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 offset-sm-5">
				<a href=""><button class="button button1">Fale conosco</button></a>
			</div>
		</div> -->
	</div>
</body>
<!-- <footer class="footer">
	<div class="row">
		<div class="col-sm-5">
			<p class="text">Telefone: +55 (12) XXXXX-XXXX
			<br>E-mail: xxxxxxxxxxxxxxxxxxxxxx@xxxxx.xxx</p>
		</div>
		<div class="col-sm-2" style="margin-top: 0.5em;">
			<p class="text"><?php echo date('Y'); ?> - e-Care
		</div>
		<div class="col-sm-5">
			<p class="text">Ícone Facebook
			<br>Ícone Instagram</p>
		</div>
	</div>
</footer>
</html>