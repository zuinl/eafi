<?php

    $conn = mysqli_connect('servidor.taubate.sp.gov.br', 'taubates_seel', 'esportes@2017', 'taubates_eafi');

    if(!$conn) {
        echo 'Erro ao conectar ao banco de dados<br>'.mysqli_error($conn);
        die();
    }

?>