<?php
    include('include/security.php');
    include('include/connect.php');
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
        <script>
            function CriaRequest() {
            try{
                request = new XMLHttpRequest();        
            }
            catch (IEAtual) {
                try{
                    request = new ActiveXObject("Msxml2.XMLHTTP");       
                }
                catch(IEAntigo){
                    try{
                        request = new ActiveXObject("Microsoft.XMLHTTP");          
                    }
                    catch(falha){
                    request = false;
                    }
                }
            }
      
            if (!request) 
                alert("Seu Navegador não suporta Ajax!");
            else
                return request;
        }
        function modalidade(modalidade) {
            var resposta = document.getElementById("resposta");
            var xmlreq = CriaRequest();
     
            resposta.innerHTML = '<h2>Buscando...</h2>';
            xmlreq.open("GET", "busca.php?modalidade=" + modalidade, true);
            xmlreq.onreadystatechange = function(){
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        resposta.innerHTML = xmlreq.responseText;
                    }
                    else{
                        resposta.innerHTML = "Erro: " + xmlreq.statusText;
                    }
                }
            };
            xmlreq.send(null);
        }

        function sexo(sexo) {
            var resposta = document.getElementById("resposta");
            var xmlreq = CriaRequest();
     
            resposta.innerHTML = '<h2>Buscando...</h2>';
            xmlreq.open("GET", "busca.php?sexo=" + sexo, true);
            xmlreq.onreadystatechange = function(){
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        resposta.innerHTML = xmlreq.responseText;
                    }
                    else{
                        resposta.innerHTML = "Erro: " + xmlreq.statusText;
                    }
                }
            };
            xmlreq.send(null);
        }

        function modalidade_sexo(modalidade_sexo) {
            var resposta = document.getElementById("resposta");
            var xmlreq = CriaRequest();
     
            resposta.innerHTML = '<h2>Buscando...</h2>';
            xmlreq.open("GET", "busca.php?modalidade_sexo=" + modalidade_sexo, true);
            xmlreq.onreadystatechange = function(){
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        resposta.innerHTML = xmlreq.responseText;
                    }
                    else{
                        resposta.innerHTML = "Erro: " + xmlreq.statusText;
                    }
                }
            };
            xmlreq.send(null);
        }

        function todos() {
            var resposta = document.getElementById("resposta");
            var xmlreq = CriaRequest();
     
            resposta.innerHTML = '<h2>Buscando...</h2>';
            xmlreq.open("GET", "busca.php?all=true", true);
            xmlreq.onreadystatechange = function(){
                if (xmlreq.readyState == 4) {
                    if (xmlreq.status == 200) {
                        resposta.innerHTML = xmlreq.responseText;
                    }
                    else{
                        resposta.innerHTML = "Erro: " + xmlreq.statusText;
                    }
                }
            };
            xmlreq.send(null);
        }
        </script>
    </head>
    <body class="container-fluid">
        <div class="row">
            <div class="col-sm-1 offset-sm-2" style="margin-top: 1em;">
                <img src="img/logoseel.png" width="100">
            </div>
            <div class="col-sm-5 offset-sm-1" style="margin-top: 2em;">
                <h1>Consulta de inscritos</h1>
            </div>
        </div>

        <?php
            if (isset($_SESSION['msg'])) {
                ?>
                <div class="alert alert-primary" role="alert">
                    <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
                </div>
                <?php
            }
        ?>

        <hr class="hr-divide">

        <div class="row">
            <div class="col-sm-2">
                <a href="index.php"><- Voltar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <label>Filtro por modalidade</label>
                <select class="form-control form-control-sm" onchange="modalidade(this.value);">
                    <option value="">-- Selecione --</option>
                    <option value="Volei">Voleibol</option>
                    <option value="Futsal">Futsal</option>
                    <option value="Tenis de mesa">Tênis de mesa</option>
                    <option value="Atletismo">Atletismo</option>
                    <option value="Basquete">Basquete</option>
                    <option value="Handebol">Handebol</option>
                    <option value="Judo">Judô</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label>Filtro por sexo</label>
                <select class="form-control form-control-sm" onchange="sexo(this.value);">
                    <option value="">-- Selecione --</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label>Filtro por modalidade + sexo</label>
                <select class="form-control form-control-sm" onchange="modalidade_sexo(this.value);">
                    <option value="">-- Selecione --</option>
                    <option value="Volei-F">Voleibol feminino</option>
                    <option value="Volei-M">Voleibol masculino</option>
                    <option value="Futsal-F">Futsal feminino</option>
                    <option value="Futsal-M">Futsal masculino</option>
                    <option value="Judo-F">Judô feminino</option>
                    <option value="Judo-M">Judô masculino</option>
                    <option value="TM-M">Tênis de Mesa masculino</option>
                    <option value="TM-F">Tênis de Mesa feminino</option>
                    <option value="Atletismo-M">Atletismo masculino</option>
                    <option value="Atletismo-F">Atletismo feminino</option>
                    <option value="Basquete-F">Basquete feminino</option>
                    <option value="Handebol-M">Handebol masculino</option>
                </select>
            </div>
            <div class="col-sm-3">
                <input type="button" class="btn btn-success" value="Carregar todos os inscritos" onclick="todos();">
            </div>
        </div>
        
        <hr class="hr-divide">

        <div id="resposta"></div>
    </body>
</html>