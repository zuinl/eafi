<?php 
session_start();
include('../include/connect.php');
include('../src/functions.php');

$email = addslashes($_POST['email']);

$select = mysqli_query($conn, "SELECT t1.usu_id as id, t2.emp_razao_social as nome FROM tbl_usuario t1 INNER JOIN 
tbl_empresa t2 ON t2.emp_id = t1.emp_id WHERE t1.usu_email = '$email'");

if(mysqli_num_rows($select) == 0) {
    $_SESSION['msg'] .= 'Seu e-mail não foi encontrado na base de dados do Staffast';
    header('Location: ../recuperarSenha.php');
    mysqli_close($conn);
    die();
} else {
    $row = mysqli_fetch_assoc($select);
    $empresa = $row['nome'];
    $usu_id = $row['id'];

    $newSenha = rand(100000, 999999);
    $newSenha_hash = password_hash($newSenha, PASSWORD_DEFAULT);
    $now = date('Y-m-d H:i:s');
    $update = mysqli_query($conn, "UPDATE tbl_usuario SET usu_senha = '$newSenha_hash', usu_ultima_alteracao_senha = '$now' 
    WHERE usu_id = '$usu_id'");

    // $txt = '<h3>Recuperação de acesso do Staffast</h3>
    //     <p>Olá, '.$email. '.</p>
    //     <p>Voce solicitou recuperação de acesso ao Staffast para a empresa '.$empresa.'</p>
	// 	<p><b>Novos dados de acesso</b></p>
	// 	<p>E-mail: '.$email.'</p>
	// 	<p>Senha: '.$newSenha.'</p>
    //     <p>Você deve alterar a senha no seu próximo acesso, ok?</p>
    //     <h6>Por enquanto é só, até mais :)</h6>
    //     <small>Suporte da equipe Staffast</small>';    
        
    // mailIt('Recuperação de acesso ao Staffast', $txt, $email);

    
    
    mysqli_close($conn);

    $_SESSION['msg'] .= 'Foi enviada uma nova senha para <b>'.$email.'</b>.';
    header('Location: ../recuperarSenha.php');
}
?>