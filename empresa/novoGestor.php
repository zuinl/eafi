<?php
    include('../include/auth.php');
    include('../src/meta.php');

    if($_SESSION['user']['permissao'] != "GESTOR") {
        include('../include/acessoNegado.php');
        die();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Novo gestor</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>  
    <script type="text/javascript">
        $('#cpf').mask('000.000.000-00');
        $('#telefone').mask('(00) 00000-0000');
    </script>
</head>
<body>
<?php
    include('../include/navbar.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 offset-sm-2">
            <h1 class="high-text big-text">Cadastro de <span class="destaque-text">gestor</span></h1>
        </div>
    </div>

    <hr class="hr-divide">

    <?php
    if(isset($_SESSION['msg'])) {
        ?>
		<div class="row">
            <div class="col-sm-6">
                <div class="alert alert-info" role="alert">
                    <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
                </div>
            </div>
		</div>
        <?php
    }
    ?>

    <div class="row">
        <div class="col-sm-2">
        <form method="POST" action="../database/gestor.php?novoGestor=true" id="form">
            <label for="primeiroNome" class="text">Primeiro nome *</label>
            <input type="text" name="primeiroNome" id="primeiroNome" class="form-control form-control-sm" maxlength="20" required="">
        </div>
        <div class="col-sm-3">
            <label for="sobrenome" class="text">Sobrenome *</label>
            <input type="text" name="sobrenome" id="sobrenome" class="form-control form-control-sm" maxlength="60" required="">
        </div>
        <div class="col-sm-2">
            <label for="cpf" class="text">CPF *</label>
            <input type="text" name="cpf" id="cpf" class="form-control form-control-sm" maxlength="14" minlength="14" required="">
        </div>
        <div class="col-sm-3">
            <label for="cargo" class="text">Cargo *</label>
            <input type="text" name="cargo" id="cargo" class="form-control form-control-sm" maxlength="40" required="">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label for="linkedin" class="text">LinkedIn</label>
            <input type="text" name="linkedin" id="linkedin" class="form-control form-control-sm" maxlength="120" placeholder="Link para o perfil">
        </div>
        <div class="col-sm-2">
            <label for="telefone" class="text">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control form-control-sm" maxlength="15">
        </div>
        <div class="col-sm-2">
            <label for="ramal" class="text">Ramal</label>
            <input type="text" name="ramal" id="ramal" class="form-control form-control-sm" maxlength="6">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label for="email" class="text">E-mail *</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm" maxlength="120" required="">
        </div>
        <div class="col-sm-2">
            <label for="senha" class="text">Senha *</label>
            <input type="password" name="senha" id="senha" class="form-control form-control-sm" maxlength="30" minlength="8" required="">
        </div>
    </div>

    <hr class="hr-divide-light">

    <div class="row">
        <div class="col-sm-2 offset-sm-4">
            <input type="submit" value="Cadastrar" class="button button2" onclick="">
        </div>
        <div class="col-sm-2">
            <input type="reset" value="Limpar" class="button button1" onclick="">
        </div>
    </div>
    </form>
</div>
</body>
</html>