<?php

    
        $conn = mysqli_connect('localhost', 'root', '', 'db_staffast'); 
    
        if(!$conn) {
            echo 'Houve um erro ao conectar à base de dados do Staffast';
        }

        if(isset($_SESSION['login'])) {

            $conn_emp = mysqli_connect('localhost', 'root', '', $_SESSION['empresa']['database']); 
    
            if(!$conn_emp) {
                echo 'Houve um erro ao conectar à base de dados da empresa';
            }

        }
    


?>