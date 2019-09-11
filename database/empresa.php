<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'db_staffast');
//------------- ESTA PÁGINA É ABERTA ------------------//

$_SESSION['msg'] = "";

if(isset($_GET['novaEmpresa'])) {

    $razaoSocial = addslashes($_POST['razaoSocial']);
    $database = $_POST['razaoSocial'];
    $database = strtolower($database);
    $database = str_replace(' ', '', $database);
    $database = str_replace('.', '', $database);
    $database = str_replace(',', '', $database);
    $database = str_replace('é', 'e', $database);
    $database = str_replace('ê', 'e', $database);
    $database = str_replace('è', 'e', $database);
    $database = str_replace('á', 'a', $database);
    $database = str_replace('à', 'a', $database);
    $database = str_replace('ã', 'a', $database);
    $database = str_replace('í', 'i', $database);
    $database = str_replace('ì', 'i', $database);
    $database = str_replace('ñ', 'n', $database);
    $database = str_replace('î', 'i', $database);
    $database = str_replace('â', 'a', $database);
    $database = str_replace('ó', 'o', $database);
    $database = str_replace('ò', 'o', $database);
    $database = str_replace('ô', 'o', $database);

    $telefone = addslashes($_POST['telefone']);
    $linkedin = addslashes($_POST['linkedin']);

    $competencia1 = addslashes($_POST['competencia1']);
    $competencia2 = addslashes($_POST['competencia2']);
    $competencia3 = addslashes($_POST['competencia3']);
    $competencia4 = addslashes($_POST['competencia4']);

    $insert = mysqli_query($conn, "INSERT INTO tbl_empresa (emp_razao_social, emp_database, emp_telefone, 
        emp_linkedin) VALUES ('$razaoSocial', '$database', '$telefone', '$linkedin')");

        if(!$insert) {
            $_SESSION['msg'] .= 'Houve um erro ao cadastrar uma nova empresa'.mysqli_error($conn);
            mysqli_close($conn);
            header('Location: ../novaEmpresa.php');
            die();
        }

        $select = mysqli_query($conn, "SELECT LAST_INSERT_ID() as id FROM tbl_empresa");
        $row = mysqli_fetch_assoc($select);
        $emp_id = $row['id'];

        if(!$select || $emp_id == 0) {
            $_SESSION['msg'] .= 'Houve um erro ao consultar a empresa cadastrada: '.mysqli_error($conn);
            mysqli_close($conn);
            header('Location: ../novaEmpresa.php');
            die();
        }

        $insert = mysqli_query($conn, "INSERT INTO tbl_competencia_empresa (emp_id, compet_um, 
        compet_dois, compet_tres, compet_quatro) VALUES ('$emp_id', '$competencia1', '$competencia2', 
        '$competencia3', '$competencia4')");

        if(!$insert) {
            $_SESSION['msg'] .= 'Houve um problema ao salvar as competências da empresa: '.mysqli_error($conn);
            mysqli_close($conn);
            header('Location: ../novaEmpresa.php');
            die();
        }

        $senha = password_hash('welcomeStaffast', PASSWORD_DEFAULT);
        $mail = $database.'.welcome'.$emp_id.'@staffast.com';
        $insert = mysqli_query($conn, "INSERT INTO tbl_usuario (usu_email, usu_senha, emp_id) 
        VALUES('$mail', '$senha', '$emp_id')");

        $select = mysqli_query($conn, "SELECT LAST_INSERT_ID() as id FROM tbl_usuario");
        $row = mysqli_fetch_assoc($select);
        $usu_id = $row['id'];

        $create = mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS db_staffast_".$database);

        if(!$create) {
            $_SESSION['msg'] .= 'Houve um erro na criação do bando de dados '.$database.': '.mysqli_error($conn);
            mysqli_close($conn);
            header('Location: ../novaEmpresa.php');
            die();
        }
        
        mysqli_close($conn);

        $conexao = mysqli_connect('localhost', 'root', '', 'db_staffast_'.$database);
          
        $create = mysqli_query($conexao, "CREATE TABLE IF NOT EXISTS `TBL_COLABORADOR` (
            `col_cpf` INT(11) NOT NULL UNIQUE,
            `col_primeiro_nome` VARCHAR(20) NOT NULL,
            `col_nome_completo` VARCHAR(80) NOT NULL,
            `col_cargo` VARCHAR(40) NOT NULL,
            `col_telefone` VARCHAR(14) NULL,
            `col_data_cadastro` DATETIME NOT NULL DEFAULT NOW(),
            `col_data_alteracao` DATETIME NOT NULL DEFAULT NOW(),
            `usu_id` INT NOT NULL,
            PRIMARY KEY (`col_cpf`));");

            if(!$create) {
                $_SESSION['msg'] .= 'Erro ao criar tabela TBL_COLABORADOR: '.mysqli_error($conexao);
                mysqli_close($conexao);
                header('Location: ../novaEmpresa.php');
                die();
            }
              
        $create = mysqli_query($conexao, "CREATE TABLE IF NOT EXISTS `TBL_GESTOR` (
            `ges_cpf` VARCHAR(11) NOT NULL,
            `ges_primeiro_nome` VARCHAR(20) NOT NULL,
            `ges_nome_completo` VARCHAR(80) NOT NULL,
            `ges_cargo` VARCHAR(40) NOT NULL,
            `ges_linkedin` VARCHAR(120) NULL,
            `ges_telefone` VARCHAR(14) NULL,
            `ges_ramal` VARCHAR(6) NULL,
            `ges_data_cadastro` DATETIME NOT NULL DEFAULT NOW(),
            `ges_data_alteracao` DATETIME NOT NULL DEFAULT NOW(),
            `ges_ativo` INT NOT NULL DEFAULT 1,
            `usu_id` INT NOT NULL,
            PRIMARY KEY (`ges_cpf`));");

            if(!$create) {
                $_SESSION['msg'] .= 'Erro ao criar tabela TBL_GESTOR: '.mysqli_error($conexao);
                mysqli_close($conexao);
                header('Location: ../novaEmpresa.php');
                die();
            }
              
        $create = mysqli_query($conexao, "CREATE TABLE IF NOT EXISTS `TBL_SETOR` (
            `set_id` INT NOT NULL AUTO_INCREMENT,
            `set_nome` VARCHAR(50) NOT NULL,
            `set_local` VARCHAR(80) NULL,
            `set_descricao` VARCHAR(150) NULL,
            `set_data_cadastro` DATETIME NOT NULL DEFAULT NOW(),
            `set_data_alteracao` DATETIME NOT NULL DEFAULT NOW(),
            PRIMARY KEY (`set_id`));");

        if(!$create) {
            $_SESSION['msg'] .= 'Erro ao criar tabela TBL_SETOR: '.mysqli_error($conexao);
            mysqli_close($conexao);
            header('Location: ../novaEmpresa.php');
            die();
        }
          
        $create = mysqli_query($conexao, " CREATE TABLE IF NOT EXISTS `TBL_CANDIDATO` (
            `can_id` INT NOT NULL AUTO_INCREMENT,
            `can_nome` VARCHAR(80) NOT NULL,
            `can_linkedin` VARCHAR(120) NULL,
            `can_telefone` VARCHAR(14) NOT NULL,
            `can_apresentacao` VARCHAR(1000) NOT NULL,
            `can_data_cadastro` DATETIME NOT NULL DEFAULT NOW(),
            `can_data_alteracao` DATETIME NOT NULL DEFAULT NOW(),
            `usu_id` INT NOT NULL,
            PRIMARY KEY (`can_id`, `usu_id`));");

        if(!$create) {
            $_SESSION['msg'] .= 'Erro ao criar tabela TBL_CANDIDATO: '.mysqli_error($conexao);
            mysqli_close($conexao);
            header('Location: ../novaEmpresa.php');
            die();
        }
              
          
        $create = mysqli_query($conexao, " CREATE TABLE IF NOT EXISTS `TBL_AVALIACAO` (
            `ava_id` INT NOT NULL AUTO_INCREMENT,
            `ava_data_criacao` DATETIME NOT NULL DEFAULT NOW(),
            `ava_data_liberacao` DATETIME NOT NULL,
            `ava_visualizada` INT NOT NULL DEFAULT 0,
            `ava_sessao_um` INT NOT NULL,
            `ava_sessao_um_obs` VARCHAR(400) NULL,
            `ava_sessao_dois` INT NOT NULL,
            `ava_sessao_dois_obs` VARCHAR(400) NULL,
            `ava_sessao_tres` INT NOT NULL,
            `ava_sessao_tres_obs` VARCHAR(400) NULL,
            `ava_sessao_quatro` INT NOT NULL,
            `ava_sessao_quatro_obs` VARCHAR(400) NULL,
            `ges_cpf` VARCHAR(11) NOT NULL,
            `col_cpf` INT(11) NOT NULL,
            PRIMARY KEY (`ava_id`, `ges_cpf`, `col_cpf`),
              FOREIGN KEY (`ges_cpf`) REFERENCES `TBL_GESTOR` (`ges_cpf`),
              FOREIGN KEY (`col_cpf`) REFERENCES `TBL_COLABORADOR` (`col_cpf`));");

        if(!$create) {
            $_SESSION['msg'] .='Erro ao criar tabela TBL_AVALIACAO: '.mysqli_error($conexao);
            mysqli_close($conexao);
            header('Location: ../novaEmpresa.php');
            die();
        }
              
          
        $create = mysqli_query($conexao, " CREATE TABLE IF NOT EXISTS `TBL_AUTOAVALIACAO` (
            `ata_id` INT NOT NULL AUTO_INCREMENT,
            `ata_data_criacao` DATETIME NOT NULL DEFAULT NOW(),
            `ata_data_liberacao` DATETIME NOT NULL,
            `ata_preenchida` INT NOT NULL DEFAULT 0,
            `ata_sessao_um` INT NOT NULL,
            `ata_sessao_um_obs` VARCHAR(400) NULL,
            `ata_sessao_dois` INT NOT NULL,
            `ata_sessao_dois_obs` VARCHAR(400) NULL,
            `ata_sessao_tres` INT NOT NULL,
            `ata_sessao_tres_obs` VARCHAR(400) NULL,
            `ata_sessao_quatro` INT NOT NULL,
            `ata_sessao_quatro_obs` VARCHAR(400) NULL,
            `col_cpf` INT(11) NOT NULL,
            PRIMARY KEY (`ata_id`),
              FOREIGN KEY (`col_cpf`)
              REFERENCES `TBL_COLABORADOR` (`col_cpf`));");

        if(!$create) {
            $_SESSION['msg'] .= 'Erro ao criar tabela TBL_AUTOAVALIACAO: '.mysqli_error($conexao);
            mysqli_close($conexao);
            header('Location: ../novaEmpresa.php');
            die();
        }
              
          
        $create = mysqli_query($conexao, " CREATE TABLE IF NOT EXISTS `TBL_PROCESSO_SELETIVO` (
            `sel_id` INT NOT NULL AUTO_INCREMENT,
            `sel_data_criacao` DATETIME NOT NULL,
            `sel_data_encerramento` DATETIME NOT NULL,
            `sel_titulo` VARCHAR(80) NOT NULL,
            `sel_vagas` INT NOT NULL,
            `sel_descricao` VARCHAR(800) NOT NULL,
            `ges_cpf` VARCHAR(11) NOT NULL,
            PRIMARY KEY (`sel_id`, `ges_cpf`),
              FOREIGN KEY (`ges_cpf`) REFERENCES `TBL_GESTOR` (`ges_cpf`));");

        if(!$create) {
            $_SESSION['msg'] .= 'Erro ao criar tabela TBL_PROCESSO_SELETIVO: '.mysqli_error($conexao);
            mysqli_close($conexao);
            header('Location: ../novaEmpresa.php');
            die();
        }
              
          
        $create = mysqli_query($conexao, " CREATE TABLE IF NOT EXISTS `TBL_PERGUNTA_PROCESSO` (
            `per_id` INT NOT NULL,
            `per_titulo` VARCHAR(120) NOT NULL,
            `per_descricao` VARCHAR(500) NULL,
            `per_opc_um` VARCHAR(80) NOT NULL,
            `per_opc_um_competencia` VARCHAR(30) NOT NULL,
            `per_opc_dois` VARCHAR(80) NOT NULL,
            `per_opc_dois_competencia` VARCHAR(30) NOT NULL,
            `per_opc_tres` VARCHAR(80) NOT NULL,
            `per_opc_tres_competencia` VARCHAR(30) NOT NULL,
            `per_opc_quatro` VARCHAR(80) NOT NULL,
            `per_opc_quatro_competencia` VARCHAR(30) NOT NULL,
            `sel_id` INT NOT NULL,
            PRIMARY KEY (`sel_id`),
              FOREIGN KEY (`sel_id`) REFERENCES `TBL_PROCESSO_SELETIVO` (`sel_id`));");

        if(!$create) {
            $_SESSION['msg'] .= 'Erro ao criar tabela TBL_PERGUNTA_PROCESSO: '.mysqli_error($conexao);
            mysqli_close($conexao);
            header('Location: ../novaEmpresa.php');
            die();
        }
              
        $create = mysqli_query($conexao, "  CREATE TABLE IF NOT EXISTS `TBL_PERGUNTA_RESPOSTA` (
            `res_id` INT NOT NULL AUTO_INCREMENT,
            `res_opc_um` INT NOT NULL,
            `res_opc_dois` INT NOT NULL,
            `res_opc_tres` INT NOT NULL,
            `res_opc_quatro` INT NOT NULL,
            `per_id` INT NOT NULL,
            PRIMARY KEY (`res_id`, `per_id`),
              FOREIGN KEY (`per_id`)
              REFERENCES `TBL_PERGUNTA_PROCESSO` (`sel_id`));");

        if(!$create) {
            $_SESSION['msg'] .= 'Erro ao criar tabela TBL_PERGUNTA_RESPOSTA: '.mysqli_error($conexao);
            mysqli_close($conexao);
            header('Location: ../novaEmpresa.php');
            die();
        }
              
        $create = mysqli_query($conexao, " CREATE TABLE IF NOT EXISTS `TBL_RESPOSTA_CANDIDATO` (
            `can_id` INT NOT NULL,
            `res_id` INT NOT NULL,
            PRIMARY KEY (`can_id`, `res_id`),
              FOREIGN KEY (`can_id`) REFERENCES `TBL_CANDIDATO` (`can_id`),
              FOREIGN KEY (`res_id`) REFERENCES `TBL_PERGUNTA_RESPOSTA` (`res_id`));");

        if(!$create) {
            $_SESSION['msg'] .= 'Erro ao criar tabela TBL_PERGUNTA_CANDIDATO: '.mysqli_error($conexao);
            mysqli_close($conexao);
            header('Location: ../novaEmpresa.php');
            die();
        }
        
        $insert = mysqli_query($conexao, "INSERT INTO tbl_gestor (ges_cpf, ges_primeiro_nome, ges_nome_completo, 
        ges_cargo, ges_linkedin, ges_telefone, ges_ramal, usu_id) VALUES('00000000000', 
        'Gestor', 'Gestor Staffast', 'Gestor Master', '', '(12)99999-9999', '000', '$usu_id')");
        
        if(!$insert) {
            $_SESSION['msg'] .= 'Houve um erro ao cadastrar o gestor: '.mysqli_error($conexao);
            mysqli_close($conexao);
            header('Location: ../novaEmpresa.php');
            die();
        }

        $_SESSION['msg'] .= "<h2>Hey, ".$razaoSocial."! O Staffast está prontinho pra você usar</h2><br>
        Foi criado um gestor de administração com o e-mail de login <b>".$mail."</b> 
        e senha de acesso <b>welcomeStaffast</b>. Recomendamos <b>fortemente</b> que você altere esses dados, por 
        segurança, tudo bem?<br>
        <h3><a href='index.php'>Faça login</a></h3>";

        header('Location: ../novaEmpresa.php');
        mysqli_close($conexao);
}

?>