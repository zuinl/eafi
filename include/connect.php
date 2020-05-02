<?php  
    $conn = mysqli_connect('localhost', 'root', '', 'taubates_eafi'); 
    
    if(!$conn) {
        echo 'Houve um erro ao conectar à base de dados';
    }
?>
