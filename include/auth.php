<?php

session_start();

    if(!isset($_SESSION['login']) || $_SESSION['login'] != 1 || !isset($_SESSION['user']) 
    || !isset($_SESSION['empresa']) || $_SESSION['user']['permissao'] == "NULL") {

        $_SESSION['msg'] .= 'Você não tem permissão para acessar esta página';
        header('Location: ../index.php');
        mysqli_close($conn);
        mysqli_close($conn_emp);
        die();
    }

?>