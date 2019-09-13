<?php

if(!isset($_POST['nome'])) {
    die();
}

include('include/connect.php');

$nome = utf8_decode($_POST['nome']);
$rg = $_POST['rg'];
$nascimento = $_POST['nascimento'];
$escola = utf8_decode($_POST['escola']);
$anoescolar = utf8_decode($_POST['anoescolar']);
$turma = utf8_decode($_POST['turma']);
$endereco = utf8_decode($_POST['endereco']);
$bairro = utf8_decode($_POST['bairro']);
$cidade = utf8_decode($_POST['cidade']);
$nomeM = utf8_decode($_POST['nomeM']);
$nomeP = utf8_decode($_POST['nomeP']);
$nomeR = utf8_decode($_POST['nomeR']);
$parentesco = utf8_decode($_POST['parentesco']);
$tel1 = utf8_decode($_POST['tel1']);
$tel2 = utf8_decode($_POST['tel2']);

//UPDATE CADASTRO 

header('Location: consulta.php');
die();
?>