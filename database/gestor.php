<?php

include('../include/auth.php');
include('../include/connect.php');
include('../src/functions.php');
//------------- ADICIONAR PERMISSÃO DE GESTOR AQUI ------------------//
    if($_SESSION['user']['permissao'] != "GESTOR") {
        include('../include/acessoNegado.php');
        die();
    }
$_SESSION['msg'] = "";

if(isset($_GET['novoGestor'])) {

    $primeiroNome = addslashes($_POST['primeiroNome']);
    $nomeCompleto = addslashes($_POST['primeiroNome'].' '.$_POST['sobrenome']);
    $cpf = $_POST['cpf'];
        $cpf = str_replace('.', '', $cpf);
        $cpf = str_replace('-', '', $cpf);
        
        if(!is_numeric($cpf)) {
            $_SESSION['msg'] .= "CPF inválido";
            header('Location: ../empresa/novoGestor.php');
            mysqli_close($conn);
            die();
        }
        $cargo = addslashes($_POST['cargo']);
        $linkedin = addslashes($_POST['linkedin']);
        $telefone = addslashes($_POST['telefone']);
        $ramal = addslashes($_POST['ramal']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $select = mysqli_query($conn_emp, "SELECT ges_cpf FROM tbl_gestor WHERE ges_cpf = '$cpf'");

        if(mysqli_num_rows($select) != 0) {
            $_SESSION['msg'] .= "CPF já cadastrado no sistema";
            header('Location: ../empresa/novoGestor.php');
            mysqli_close($conn);
            die();
        }

        $select = mysqli_query($conn, "SELECT usu_email FROM tbl_usuario WHERE usu_email = '$email'");

        if(mysqli_num_rows($select) != 0) {
            $_SESSION['msg'] .= "O e-mail já consta na base de dados do Staffast.";
            header('Location: ../empresa/novoGestor.php');
            mysqli_close($conn);
            die();
        }
        
        $emp_id = $_SESSION['empresa']['emp_id'];
        $insert = mysqli_query($conn, "INSERT INTO tbl_usuario (usu_email, usu_senha, emp_id) VALUES 
        ('$email', '$senha_hash', '$emp_id')");

        if(!$insert) {
            $_SESSION['msg'] .= "Erro ao cadastrar usuário: ".mysqli_error($conn);
            header('Location: ../empresa/novoGestor.php');
            mysqli_close($conn);
            die();
        }

        $select = mysqli_query($conn, "SELECT LAST_INSERT_ID() as id FROM tbl_usuario");
        $row = mysqli_fetch_assoc($select);
        $usu_id = $row['id'];

        if(!$select || $usu_id == 0) {
            $_SESSION['msg'] .= "Erro ao consultar usuário cadastrado ".mysqli_error($conn);
            header('Location: ../empresa/novoGestor.php');
            mysqli_close($conn);
            die();
        }

        $insert = mysqli_query($conn_emp, "INSERT INTO tbl_gestor (ges_cpf, ges_primeiro_nome, ges_nome_completo, 
        ges_cargo, ges_linkedin, ges_telefone, ges_ramal, usu_id) VALUES('$cpf', 
        '$primeiroNome', '$nomeCompleto', '$cargo', '$linkedin', '$telefone', '$ramal', '$usu_id')");
        
        if(!$insert) {
            $_SESSION['msg'] .= "Erro ao cadastrar o novo gestor";
            header('Location: ../empresa/novoGestor.php');
            mysqli_close($conn);
            die();
        }

        $idUser = $_SESSION['user']['usu_id'];
        $descricao = 'Foi cadastrado o gestor '.$nomeCompleto.', ID user:'.$usu_id;
        insereLog($conn, $descricao, $idUser);

        $_SESSION['msg'] .= "Gestor cadastrado com sucesso";
            header('Location: ../empresa/novoGestor.php');

        mysqli_close($conn);
        
}

?>