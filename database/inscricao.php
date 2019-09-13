<?php

include('../include/connect.php');

if(isset($_GET['nova'])) {

    $nome = utf8_decode(addslashes($_POST['nome']));
    $rg = $_POST['rg'];

    $year = '2018-12-31';
    $select = mysqli_query($conn, "SELECT * FROM cad_NovoEafi WHERE rg = '$rg' AND timestamp > '$year'");

    if(mysqli_query($select) != 0) {
        echo '<h1>Parece que o candidato já possui uma inscrição do EAFI neste ano.</h1>';
        mysqli_close($conn);
        die();
    }

    $sexo = $_POST['sexo'];
    $nascimento = $_POST['nascimento'];
    $email = $_POST['email'];
    $escola = $_POST['escola'];
    $anoescolar = $_POST['anoescolar'];
    $telefone = $_POST['telefone'];
    $telefone1 = $_POST['telefone1'];
    $endereco = utf8_decode(addslashes($_POST['endereco'])).', Nº '.$_POST['numero'];
    $bairro = utf8_decode(addslashes($_POST['bairro']));
    $cidade = utf8_decode(addslashes($_POST['cidade']));
    $cep = $_POST['cep'];
    $resp1 = utf8_decode(addslashes($_POST['resp1']));
    $resp2 = utf8_decode(addslashes($_POST['resp2']));
    $resp = utf8_decode(addslashes($_POST['resp']));
    $parentesco = utf8_decode(addslashes($_POST['parentesco']));
    
    $esporte = $_POST['esporte'];

    if($esporte == '1') {
        $esporte = utf8_decode(addslashes($_POST['esportePratica']));
    } else {
        $esporte = 'Não';
    }

    $deficiencia = $_POST['deficiencia'];

    if($deficiencia == '1') {
        $deficiencia = utf8_decode(addslashes($_POST['qualDeficiencia']));
    } else {
        $deficiencia = 'Não';
    }

    $medicamentos = $_POST['medicamentos'];

    if($deficiencia == '1') {
        $medicamentos = utf8_decode(addslashes($_POST['qualMedicamento']));
    } else {
        $medicamentos = 'Não';
    }

    $convenio = $_POST['convenio'];

    if($deficiencia == '1') {
        $convenio = utf8_decode(addslashes($_POST['qualConvenio']));
    } else {
        $convenio = 'Não';
    }

    $autorizado = $_POST['atividades'];

    $modalidadeM = '';
    $modalidadeF = '';
    if($sexo == 'M') {
        $modalidadeM = utf8_decode($_POST['modalidadeMasculina']);
    } else {
        $modalidadeF = utf8_decode($_POST['modalidadeFeminina']);
    }

    $insert = "INSERT INTO cad_NovoEafi (nome, rg, sexo, email, data_nasc, escola_atual, ano_escolar, endereco, bairro, cidade, 
    cep, nomeM, nomeP, celO, telO, nomeR, parentesco, esporteP, deficiencia, medicamento, 
    convenio, atvF, p_opc_masc, p_opc_fem) VALUES ('$nome', '$rg', '$sexo', '$email', '$nascimento', '$escola', '$anoescolar', 
    '$endereco', '$bairro', '$cidade', '$cep', '$resp1', '$resp2', '$telefone', '$telefone1', '$resp', '$parentesco', 
    '$esporte', '$esporte', '$deficiencia', '$medicamentos', '$convenio', '$autorizado', '$modalidadeM', '$modalidadeF')";

    $query = mysqli_query($conn, $insert);
    mysqli_close($conn);
    
    $_SESSION['msg'] = "A inscrição foi finalizada com sucesso!";
    header('Location: ../inscricao.php');
    die();
}

?>