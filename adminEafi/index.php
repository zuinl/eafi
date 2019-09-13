<?php
    session_start();
    //session_destroy();
    if(isset($_SESSION['codigo'])) unset($_SESSION['codigo']);
    include('meta/meta.php');
?>
<html>
    <head>
        <title>EAFI - Administrativo</title>
        <style>
            .hr-divide {
                border-width: 0.3em; 
                border-color: grey;
            }
            .footer {
                position: fixed;
                height: 100px;
                bottom: 0;
                width: 100%;
                font-size: 0.8em;
            }
        </style>
    </head>
    <body class="container">
        <div class="row">
            <div class="col-sm-1 offset-sm-2" style="margin-top: 1em;">
                <img src="img/logoseel.png" width="100">
            </div>
            <div class="col-sm-5 offset-sm-1" style="margin-top: 2em;">
                <h1>EAFI - Administrativo</h1>
            </div>
        </div>

        <hr class="hr-divide">
        
        <div class="row">
            <div class="col-sm-2">
                <a href="../index"><- Voltar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 offset-sm-4">  <!-- CÓDIGO DE ACESSO = nsjP3p -->
            <form action="auth.php" method="POST">
                <label>Insira o código de acesso</label>
                <input type="password" name="codigo" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 offset-sm-4">
                <input type="submit" class="btn btn-info" value="Acessar" style="font-size: 1.5em;">
            </div>
            <div class="col-sm-1">
                <a href="include/enviacodigo.php"><input type="button" class="btn btn-danger" value="Esqueci o código" onclick="enviaCodigo();"></a>
            </div>
        </div>
        </form>
        
        <hr class="hr-divide">

        <div class="row">
            <div class="col-sm-12">
                <h3>Esta página é exclusiva para os funcionários da Secretaria de Esportes e Lazer</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h5>Se você está buscando se cadastrar ou consultar seu cadastro, <a href="http://taubate.sp.gov.br/secretarias/seel/sistema/NovoEafi/index.php">clique aqui</a></h5>
            </div>
        </div>
    </body>
    <footer class="footer">
            Desenvolvido por <a href="https://www.linkedin.com/in/lzuin/" target="blank_">Leonardo Zuin</a> - Secretaria de Esportes e Lazer de Taubaté
    </footer>
</html>