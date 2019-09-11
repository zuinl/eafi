<?php
    session_start();
    include('include/connect.php');
    include('src/meta.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastre sua empresa</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>  
    <script type="text/javascript">
        $('#cpf').mask('000.000.000-00');
        $('#telefone').mask('(00) 00000-0000');
    </script>
    <script>
        function escreveEmpresa (razaoSocial) {
            document.getElementById('empresa').innerHTML = razaoSocial;
            document.getElementById('empresa1').innerHTML = razaoSocial;
        }
    </script>
</head>
<body style="margin-top: 0em;">
<div class="container-fluid">
    <?php
    if(isset($_SESSION['msg'])) {
        ?>
        <div class="alert alert-info" role="alert">
            <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-sm-10 offset-sm-2">
            <h1 class="high-text big-text">Traga sua <i><span class="destaque-text">empresa</span></i> pro Staffast</h1>
        </div>
    </div>

    <hr class="hr-divide">

    <div class="row">
        <div class="col-sm-2">
        <form method="POST" action="database/empresa.php?novaEmpresa=true" id="form">
            <label for="razaoSocial" class="text">Razão social *</label>
            <input type="text" name="razaoSocial" id="razaoSocial" class="form-control form-control-sm" maxlength="50" required="" onblur="escreveEmpresa(this.value);">
        </div>
        <div class="col-sm-2">
            <label for="telefone" class="text">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control form-control-sm" maxlength="15">
        </div>
        <div class="col-sm-3">
            <label for="linkedin" class="text">LinkedIn</label>
            <input type="text" name="linkedin" id="linkedin" class="form-control form-control-sm" maxlength="120" placeholder="Link para o perfil">
        </div>
    </div>

    <hr class="hr-divide-light">

    <div class="row">
        <div class="col-sm-8 offset-sm-4">
            <h1 class="high-text">Olá, <i><span id="empresa1" class="destaque-text">nova empresa</span></i></h1>
        </div>
        <div class="col-sm-12">
            <h2 class="high-text">Agora, defina as <i><span class="destaque-text">competências</span></i> da sua empresa</h2>
        </div>
        <div class="col-sm-12">
            <h6 class="text">Nas avaliações e autoavaliações, o Staffast usa 4 sessões que são definidas neste momento. 
            Tudo o que você deve pensar é: o que <b><span id="empresa">sua empresa</span></b> quer avaliar de seus colaboradores?</h6>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm" name="competencia1" id="competencia1" maxlength="30" required="" placeholder="Competência 1. Ex: Comunicação em equipe">
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm" name="competencia2" id="competencia2" maxlength="30" required="" placeholder="Competência 2. Ex: Tolerância">
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm" name="competencia3" id="competencia3" maxlength="30" required="" placeholder="Competência 3. Ex: Conhecimento técnico">
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control form-control-sm" name="competencia4" id="competencia4" maxlength="30" required="" placeholder="Competência 4. Ex: Responsabilidade">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h6 class="text">Está em dúvidas sobre o que são competências? Fique tranquilo(a). O Staffast foi desenvolvido até mesmo 
            para quem não tem formação em RH. <a href="#">Leia nosso artigo</a> sobre as competências. Lá também tem sugestões para cada tipo de empresa!</h6>
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