<?php
$mailTo = "diazgonzalez73@gmail.com";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: <leonardosoareszuin@gmail.com>";
$txt = '<h3>Código de acesso à página administrativa do EAFI</h3>
        <p>Mensagem: o código de acesso à página administrativa do EAFI é <b>nsjP3p</b></p>
        <small>Sistema EAFI</small>';

mail($mailTo, $subject, $txt, $headers);

echo '<h2>E-mail enviado para <b>diazgonzalez73@gmail.com</b> com o código de acesso</h2>';

?>