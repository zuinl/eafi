<?php

session_start();

$_SESSION['msg'] = "";

if(!isset($_GET['login'])) { 
    $_SESSION['msg'] .= 'Oooops... você não pode acessar esta página agora';
    header('Location: ../index.php');
    die();
}

$email = addslashes($_POST['email']);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] .= 'Dados inválidos';
        header('Location: ../index.php');
        mysqli_close($conn);
        die();
    }
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

include('../include/connect.php');

$select = mysqli_query($conn, "SELECT * FROM tbl_usuario WHERE usu_email = '$email'");

if(mysqli_num_rows($select) == 0) {
    $_SESSION['msg'] .= 'Dados inválidos';
    header('Location: ../index.php');
    mysqli_close($conn);
    die();
} else if (mysqli_num_rows($select) == 1) {
    $row = mysqli_fetch_assoc($select);
    $usu_id = $row['usu_id'];
    $senha_hash = $row['usu_senha'];
    if(!password_verify($senha, $senha_hash)) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $insert = mysqli_query($conn, "INSERT INTO tbl_acesso (acs_ip, acs_sucesso, usu_id) 
        VALUES ('$ip', 0, '$usu_id')");

        $now = date('Y-m-d H:i:s');
        $select = mysqli_query($conn, "SELECT t2.acs_ip FROM tbl_usuario t1 
            INNER JOIN tbl_acesso t2 WHERE t1.usu_email = '$email' 
            AND t2.acs_sucesso = 0 AND (t2.acs_timestamp 
            BETWEEN DATE_SUB('$now', INTERVAL 24 HOUR) AND '$now')");

            if(mysqli_num_rows($select) >= 5 && mysqli_num_rows($select) < 10) {
                $aviso = 'A CONTA DO USUÁRIO '.$email.' FOI ACESSADA DE FORMA ERRÔNEA'.mysqli_num_rows($select).'VEZES NAS ÚLTIMAS 24 HORAS';
                $insert = mysqli_query($conn, "INSERT INTO tbl_aviso (avi_descricao) VALUES ('$aviso')");
                $_SESSION['msg'] .= 'Os dados são inválidos. Essa foi a <b>'.mysqli_num_rows($select).'ª</b> tentativa frustrada 
                em 24 horas. Na 10ª vez, uma nova senha será gerada automaticamente e enviada ao seu e-mail';
                header('Location: ../index.php');
                mysqli_close($conn);
                die();
            } else if (mysqli_num_rows($select) >= 10) {
                $newSenha = rand(100000, 999999);
                $newSenha_hash = password_hash($newSenha, PASSWORD_DEFAULT);
                $update = mysqli_query($conn, "UPDATE tbl_usuario SET usu_senha = '$newSenha_hash', 
                usu_ultima_alteracao_senha = '$now' WHERE usu_email = '$email'");
                
                $subject = "Sua conta do Staffast foi bloqueada";
                $mailTo = $email;
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "From: Suporte Staffast <xxxxx@xxxxxxxx.com.br>";
                $txt = '<h3>Recupere sua conta</h3>
                    <p>Olá, '.$email. '.</p>
                    <p>Sua conta no Staffast foi acessada 10 vezes com a senha incorreta e por isso nós 
                    alteramos a sua senha de forma automática, para sua segurança. Segue abaixo a sua nova senha de acesso.</p>
                    <p><b>Novos dados de acesso</b></p>
                    <p>E-mail: '.$email.'</p>
                    <p>Senha: '.$newSenha.'</p>
                    <p>É muito importante que você crie uma nova senha no próximo acesso, ok?</p>
                    <h6>Por enquanto é só, até mais :)</h6>
                    <small>Suporte da equipe Staffast</small>';
                mail($mailTo, $subject, $txt, $headers);
            }

        $_SESSION['msg'] .= 'Dados inválidos';
        header('Location: ../index.php');
        mysqli_close($conn);
        die();
        }

        $usu_id = $row['usu_id'];
        $usu_email = $row['usu_email'];
        $emp_id = $row['emp_id'];

        $select = mysqli_query($conn, "SELECT t1.emp_razao_social as nome, t1.emp_database as db, 
        t2.compet_um as c1, t2.compet_dois as c2, t2.compet_tres as c3, t2.compet_quatro as c4 
        FROM tbl_empresa t1 INNER JOIN tbl_competencia_empresa t2 ON t2.emp_id = t1.emp_id 
        WHERE t1.emp_id = '$emp_id'");
        $row = mysqli_fetch_assoc($select);
        $empresa = $row['nome'];
        $database = 'db_staffast_'.$row['db'];
        $c1 = $row['c1'];
        $c2 = $row['c2'];
        $c3 = $row['c3'];
        $c4 = $row['c4'];

        $conn_emp = mysqli_connect('localhost', 'root', '', $database);

        if(!$conn_emp) {
            $_SESSION['msg'] .= 'Há algo de errado com o banco de dados da empresa '.$empresa;
            header('Location: ../index.php');
            mysqli_close($conn);
            mysqli_close($conn_emp);
            die();
        }

        $select = mysqli_query($conn_emp, "SELECT * FROM tbl_gestor WHERE usu_id = '$usu_id'");

        $permissao = "NULL";
        if(mysqli_num_rows($select) == 1) {
            $row = mysqli_fetch_assoc($select);
            $primeiro_nome = $row['ges_primeiro_nome'];
            $nome = $row['ges_nome_completo'];
            $cpf = $row['ges_cpf'];
            $permissao = "GESTOR";
        } else {
            $select = mysqli_query($conn_emp, "SELECT * FROM tbl_colaborador WHERE usu_id = '$usu_id'");
            if(mysqli_num_rows($select) == 1) {
                $row = mysqli_fetch_assoc($select);
                $primeiro_nome = $row['col_primeiro_nome'];
                $nome = $row['col_nome_completo'];
                $cpf = $row['col_cpf'];
                $permissao = "COLABORADOR";
            } else {
                $_SESSION['msg'] .= 'Parece que algo errado aconteceu :(';
                header('Location: ../index.php');
                mysqli_close($conn);
                mysqli_close($conn_emp);
                die();
            }
        }

        $_SESSION['login'] = 1;

        $_SESSION['user'] = array(
            'primeiro_nome' => $primeiro_nome,
            'nome_completo' => $nome,
            'cpf' => $cpf,
            'email' => $email,
            'usu_id' => $usu_id,
            'permissao' => $permissao);
        
        $_SESSION['empresa'] = array(
            'nome' => $empresa,
            'emp_id' => $emp_id,
            'database' => $database,
            'compet_um' => $c1,
            'compet_dois' => $c2,
            'compet_tres' => $c3,
            'compet_quatro' => $c4);   

        $ip = $_SERVER['REMOTE_ADDR'];
        $insert = mysqli_query($conn, "INSERT INTO tbl_acesso (acs_ip, acs_sucesso, usu_id) 
        VALUES ('$ip', 1, '$usu_id')");

        mysqli_close($conn);
        mysqli_close($conn_emp);

        header('Location: ../empresa/home.php');
        die();
    }
?>