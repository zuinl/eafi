<?php
include('include/security.php');
include('include/connect.php');
include('meta/meta.php');
if(!isset($_GET['id'])) {
    die();
}

$id = $_GET['id'];

$select = "SELECT * FROM cad_NovoEafi WHERE id_nome = '$id'";

$query = mysqli_query($conn, $select);

$dados = mysqli_fetch_assoc($query);

$nome = utf8_encode($dados['nome']);
$rg = $dados['rg'];
$data_nasc = $dados['data_nasc'];
$escola = utf8_encode($dados['escola_atual']);
$anoescolar = utf8_encode($dados['ano_escolar']);
$turma = $dados['turma'];
$endereco = utf8_encode($dados['endereco']);
$bairro = utf8_encode($dados['bairro']);
$cidade = utf8_encode($dados['cidade']);
$nomeM = utf8_encode($dados['nomeM']);
$nomeP = utf8_encode($dados['nomeP']);
$tel1 = $dados['celO'];
$tel2 = $dados['telO'];
$nomeR = utf8_encode($dados['nomeR']);
$parentesco = utf8_encode($dados['parentesco']);
?>
<html>
    <head>
        <title>Editar inscrição</title>
    </head>
    <body class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Edição da inscrição</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <form action="db_editar.php" method="POST">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
            </div>
            <div class="col-sm-3">
                <label>RG (só números)</label>
                <input type="text" name="rg" class="form-control" value="<?php echo $rg; ?>">
            </div>
            <div class="col-sm-3">
                <label>Data de nascimento</label>
                <input type="date" name="nascimento" class="form-control" value="<?php echo $data_nasc; ?>">
            </div>
            <div class="col-sm-3">
                <label>Escola</label>
                <input type="text" name="escola" class="form-control" value="<?php echo $escola; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <label>Ano escolar</label>
                <input type="text" name="anoescolar" class="form-control" value="<?php echo $anoescolar; ?>">
            </div>
            <div class="col-sm-3">
                <label>Turma</label>
                <input type="text" name="turma" class="form-control" value="<?php echo $turma; ?>">
            </div>
            <div class="col-sm-3">
                <label>Endereço</label>
                <input type="text" name="endereco" class="form-control" value="<?php echo $endereco; ?>">
            </div>
            <div class="col-sm-3">
                <label>Bairro</label>
                <input type="text" name="bairro" class="form-control" value="<?php echo $bairro; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <label>Cidade</label>
                <input type="text" name="cidade" class="form-control" value="<?php echo $cidade; ?>">
            </div>
            <div class="col-sm-3">
                <label>Mãe</label>
                <input type="text" name="nomeM" class="form-control" value="<?php echo $nomeM; ?>">
            </div>
            <div class="col-sm-3">
                <label>Pai</label>
                <input type="text" name="nomeP" class="form-control" value="<?php echo $nomeP; ?>">
            </div>
            <div class="col-sm-3">
                <label>Responsável na prova</label>
                <input type="text" name="nomeR" class="form-control" value="<?php echo $nomeR; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <label>Parentesco</label>
                <input type="text" name="parentesco" class="form-control" value="<?php echo $parentesco; ?>">
            </div>
            <div class="col-sm-3">
                <label>Telefone 1</label>
                <input type="text" name="tel1" class="form-control" value="<?php echo $tel1; ?>">
            </div>
            <div class="col-sm-3">
                <label>Telefone 2</label>
                <input type="text" name="tel2" class="form-control" value="<?php echo $tel2; ?>">
            </div>
        </div>

        <div class="row" style="margin-top: 2em;">
            <div class="col-sm-3">
                <input type="submit" value="Atualizar inscrição" class="btn btn-outline-primary">
            </div>
            </form>
        </div>
    </body>
</html>