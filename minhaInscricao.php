<?php
    session_start();
    include('src/meta.php');

    if(!isset($_POST['rg'])) {
        echo '<h1>Sem permissão de acesso</h1>';
        die();
    }

    include('include/connect.php');

    $rg = $_POST['rg'];
    $select = "SELECT * FROM cad_NovoEafi WHERE rg = '$rg' AND timestamp > '2019-01-01'";

    $query = mysqli_query($conn, $select);

    if(mysqli_num_rows($query) == 0) {
        echo '<h1>O RG inserido não corresponde a nenhuma inscrição do EAFI</h1>';
        mysqli_close($conn);
        die();
    } else if (mysqli_num_rows($query) > 1) {
        echo '<h1>Sua inscrição no EAFI parece estar duplicada. Por favor, entre em contato com a Secretaria de Esportes</h1>';
        mysqli_close($conn);
        die();
    } else {
        $row = mysqli_fetch_assoc($query);

        $id = $row['id_nome'];
        $nome = utf8_encode($row['nome']);
        $timestamp = $row['timestamp'];
        $sexo = $row['sexo'];
            if($sexo == 'M') $sexo = 'Masculino';
            if($sexo == 'F') $sexo = 'Feminino';
        $email = $row['email'];
            if($email == '') $email = 'Não informado';
        $nascimento = $row['data_nasc'];
            $nascimento = date_create($nascimento);
        $escola = utf8_encode($row['escola_atual']);
        $anoescolar = utf8_encode($row['ano_escolar']).' - '.$row['turma'];
        $endereco = utf8_encode($row['endereco']).' - '.utf8_encode($row['bairro']).' - '.utf8_encode($row['cidade']);
        $resp1 = utf8_encode($row['nomeM']);
        $resp2 = utf8_encode($row['nomeP']);
        $resp = utf8_encode($row['nomeR']).' - '.utf8_encode($row['parentesco']);
        $telefones = $row['celO'].' - '.$row['telO'];
        $esporte = utf8_encode($row['esporteP']).' - '.utf8_encode($row['esp_local']);
        $deficiencia = utf8_encode($row['deficiencia']);
        $medicamentos = utf8_encode($row['medicamento']);
        $convenio = utf8_encode($row['convenio']);
        $atividades = utf8_encode($row['atvF']);

        $p_opc_masc = utf8_encode($row['p_opc_masc']);
        $p_opc_fem = utf8_encode($row['p_opc_fem']);
        $modalidade = '';

        $local = 'SEDES - EMIEF PROFª ANNA DOS REIS SIGNORINI, Av. Amador Bueno da Veiga, 220 - Jardim Jaragua
        <br>A prova se inicia às 08h30. Os portôes estarão abertos a partir das 08h00';
        if($sexo == 'M' || $sexo == 'Masculino') {
            $modalidade = 'Modalidade MASCULINA: '.$p_opc_masc;

            $data = '22 de setembro de 2019';
        } else if ($sexo == 'F' || $sexo == 'Feminino') {
            $modalidade = 'Modalidade FEMININA: '.$p_opc_fem;

            $data = '21 de setembro de 2019';
        } else {
            $modalidade = 'Inválida';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscrição de <?php echo $nome; ?></title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script> 
    <style>
        .hr-divide-light-grey {
			border-width: 0.2em; 
			border-color: grey;
        }
        
    </style>
</head>
<body style="margin-top: 0em;">
<div class="container-fluid">
<?php include('include/navbar.php');?>
    <?php
    if(isset($_SESSION['msg'])) {
        ?>
        <div class="alert alert-info" role="alert">
            <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
        </div>
        <?php
    }
    ?>

    <div id="printable">
        <div class="row">
            <div class="col-sm-10 offset-sm-2">
                <h1 class="high-text big-text">Inscrição de <i><span class="destaque-text"><?php echo $nome; ?></span></i></h1>
            </div>
        </div>

        <hr class="hr-divide">

        <div class="row">
            <div class="col-sm-3">
                <b><label>Nome completo: </label></b><br><?php echo $nome; ?>
            </div>
            <div class="col-sm-2">
                <b><label>Data de nascimento: </label></b><br><?php echo date_format($nascimento, 'd/m/Y'); ?>
            </div>
            <div class="col-sm-1">
                <b><label>Sexo: </label></b><br><?php echo $sexo; ?>
            </div>
            <div class="col-sm-3">
                <b><label>E-mail: </label></b><br><?php echo $email; ?>
            </div>
        </div>

        <hr class="hr-divide-light-grey">

        <div class="row">
            <div class="col-sm-4">
                <b><label>Escola: </label></b><br><?php echo $escola; ?>
            </div>
            <div class="col-sm-2">
                <b><label>Ano escolar: </label></b><br><?php echo $anoescolar; ?>
            </div>
            <div class="col-sm-6">
                <b><label>Endereço: </label></b><br><?php echo $endereco; ?>
            </div>
        </div>

        <hr class="hr-divide-light-grey">

        <div class="row">
            <div class="col-sm-3">
                <b><label>Telefones: </label></b><br><?php echo $telefones; ?>
            </div>
            <div class="col-sm-3">
                <b><label>Responsável(is) </label></b><br><?php echo $resp1.'<br>'.$resp2; ?>
            </div>
            <div class="col-sm-3">
                <b><label>Responsável no dia da prova: </label></b><br><?php echo $resp; ?>
            </div>
        </div>

        <hr class="hr-divide-light-grey">

        <div class="row">
            <div class="col-sm-3">
                <b><label>Pratica esportes? </label></b><br><?php echo $esporte; ?>
            </div>
            <div class="col-sm-3">
                <b><label>Tem alguma deficiência? </label></b><br><?php echo $deficiencia; ?>
            </div>
            <div class="col-sm-3">
                <b><label>Toma algum medicamento? </label></b><br><?php echo $medicamentos; ?>
            </div>
            <div class="col-sm-3">
                <b><label>Possui convênio? </label></b><br><?php echo $convenio; ?>
            </div>
        </div>

        <hr class="hr-divide-light-grey">

        <div class="row">
            <div class="col-sm-4">
                <b><label>Está autorizado a praticar esportes? </label></b><br><?php echo $atividades; ?>
            </div>
            <div class="col-sm-8">
                <b><label>Modalidade selecionada </label></b><br><?php echo $modalidade; ?>
            </div>
        </div>

        <hr class="hr-divide-light-grey">

        <div class="row">
            <div class="col-sm-4">
                <b><label>Data da prova </label></b><br><?php echo $data; ?>
            </div>
            <div class="col-sm-8">
                <b><label>Local </label></b><br><?php echo $local; ?>
            </div>
        </div>

        <hr class="hr-divide-light-grey">
    </div>

    <div class="row">
        <div class="col-sm-4 offset-sm-5" style="margin-bottom: 2em; sont-size: 3em;">
            <input type="button" class="btn btn-info" value="Imprimir" onclick="window.print();">
        </div>
    </div>

</div>
</body>
</html>