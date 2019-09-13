<?php  
    $conn = mysqli_connect('servidor.taubate.sp.gov.br', 'taubates_seel', 'esportes@2017', 'taubates_eafi'); 
    
    if(!$conn) {
        echo 'Houve um erro ao conectar à base de dados';
    }
?>