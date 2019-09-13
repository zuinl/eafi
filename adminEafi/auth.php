<?php
    session_start();
    if(!isset($_POST['codigo'])) {
        header('Location: index.php');
    } else {
        if($_POST['codigo'] == "nsjP3p") $_SESSION['codigo'] = $_POST['codigo'];
        else {
            echo 'Código incorreto. Volte e tente novamente';
            die();
        }
    }
    
    if(isset($_SESSION['codigo']) && $_SESSION['codigo'] == "nsjP3p") {
        header('Location: consulta.php');
    } else {
        echo 'Código incorreto. Volte e tente novamente';
        die();
    }

?>