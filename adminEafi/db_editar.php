<?php

if(!isset($_POST['nome'])) {
    die();
}

include('include/security.php');
include('include/connect.php');

$id = $_POST['id'];

$nome = addslashes(utf8_decode($_POST['nome']));
$rg = $_POST['rg'];
$nascimento = $_POST['nascimento'];
$escola = addslashes(utf8_decode($_POST['escola']));
$anoescolar = utf8_decode($_POST['anoescolar']);
$turma = utf8_decode($_POST['turma']);
$endereco = addslashes(utf8_decode($_POST['endereco']));
$bairro = addslashes(utf8_decode($_POST['bairro']));
$cidade = addslashes(utf8_decode($_POST['cidade']));
$nomeM = addslashes(utf8_decode($_POST['nomeM']));
$nomeP = addslashes(utf8_decode($_POST['nomeP']));
$nomeR = addslashes(utf8_decode($_POST['nomeR']));
$parentesco = utf8_decode($_POST['parentesco']);
$tel1 = utf8_decode($_POST['tel1']);
$tel2 = utf8_decode($_POST['tel2']);

$update = "UPDATE cad_NovoEafi SET nome = '$nome', rg = '$rg', data_nasc = '$nascimento', escola_atual = '$escola', ano_escolar = '$anoescolar', 
turma = '$turma', endereco = '$endereco', bairro = '$bairro', cidade = '$cidade', nomeM = '$nomeM', nomeP = '$nomeP', 
nomeR = '$nomeR', parentesco = '$parentesco', celO = '$tel1', telO = '$tel2' WHERE id_nome = '$id'";

$query = mysqli_query($conn, $update);

if(!$query) {
    $_SESSION['msg'] = 'Erro ao atualizar inscrição: '.mysqli_error($conn);
} else {
    $_SESSION['msg'] = 'Inscrição atualizada com sucesso';
}

header('Location: consulta.php');
die();
?>