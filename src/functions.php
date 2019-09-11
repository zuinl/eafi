<?php
    function insereLog($conexao, $descricao, $usu_id) {
        $insert = mysqli_query($conexao, "INSERT INTO tbl_log_alteracao (alt_descricao, usu_id) 
        VALUES ('$descricao', '$usu_id')");
    }

    function mailIt($subject, $txt, $email) {
        $mailTo = $email;
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: Suporte Staffast <xxxxx@xxxxxxxx.com.br>";
        mail($mailTo, $subject, $txt, $headers);
    }
?>