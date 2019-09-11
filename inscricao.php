<?php
    session_start();
    include('src/meta.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscrição</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>  
    <script type="text/javascript">
        $('#cpf').mask('000.000.000-00');
        $('#telefone').mask('(00) 00000-0000');
    </script>
</head>
<body style="margin-top: 0em;">
<div class="container-fluid">
<?php include('include/navbar.php');?>
    <?php
    if(isset($_SESSION['msg'])) {
        ?>
        <div class="alert alert-info" role="alert">
            <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <div class="col-sm-10 offset-sm-2">
            <h1 class="high-text big-text">Inscrição do <i><span class="destaque-text">EAFI</span></i> 2020</h1>
        </div>
    </div>

    <hr class="hr-divide">

    <div class="row">
        <div class="col-sm-3">
        <form method="POST" action="database/empresa.php?novaEmpresa=true" id="form">
            <label for="nome" class="text">Nome completo do candidato *</label>
            <input type="text" name="nome" id="nome" class="form-control form-control-sm" maxlength="80" required="">
        </div>
        <div class="col-sm-2">
            <label for="rg" class="text">RG *</label>
            <input type="text" name="rg" id="rg" class="form-control form-control-sm" maxlength="12">
        </div>
        <div class="col-sm-2">
            <label for="sexo" class="text">Sexo *</label>
            <select class="form-control form-control-sm" name="sexo" id="sexo" required="">
                <option value="null" disabled="" selected="">-- Selecione --</option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
            </select>
        </div>
        <div class="col-sm-3">
            <label for="nascimento" class="text">Data de nascimento *</label>
            <input type="date" name="nascimento" id="nascimento" class="form-control form-control-sm" maxlength="10">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
        <label for="escola" class="text">Escola atual *</label>
            <select name="escola" id="escola" class="form-control form-control-sm" required="">
                <option value="null" selected disabled>-- Selecione --</option>
                <option value="EMIEF PROFª ANITA RIBAS DE ANDRADE - ANITA RIBAS">EMIEF PROFª ANITA RIBAS DE ANDRADE - ANITA RIBAS</option>
                <option value="EMIEF PADRE SILVINO VICENTE KUNZ – AREÃO">EMIEF PADRE SILVINO VICENTE KUNZ – AREÃO</option>
                <option value="EMIEF PROF. EMÍLIO SIMONETTI – BOSQUE">EMIEF PROF. EMÍLIO SIMONETTI – BOSQUE</option>
                <option value="EMEIEF MÁRIO LEMOS DE OLIVEIRA – CAIEIRAS">EMEIEF MÁRIO LEMOS DE OLIVEIRA – CAIEIRAS</option>
                <option value="EMIEF PREFEITO GUIDO JOSÉ GOMES MINÉ – CECAP">EMIEF PREFEITO GUIDO JOSÉ GOMES MINÉ – CECAP</option>
                <option value="EMEF PROF. JOSÉ SANT’ANNA DE SOUZA – CHÁCARA FLÓRIDA">EMEF PROF. JOSÉ SANT’ANNA DE SOUZA – CHÁCARA FLÓRIDA</option>
                <option value="EMIEF PROF. CINIRO MATHIAS BUENO – CHÁCARA INGRID">EMIEF PROF. CINIRO MATHIAS BUENO – CHÁCARA INGRID</option>
                <option value="EMIEF PROFª MARISA LAPIDO BARBOSA – CHÁCARAS REUNIDAS">EMIEF PROFª MARISA LAPIDO BARBOSA – CHÁCARAS REUNIDAS</option>
                <option value="EMIEF PROFª CELINA MONTEIRO DE CASTRO – CHÁCARA SILVESTRE">EMIEF PROFª CELINA MONTEIRO DE CASTRO – CHÁCARA SILVESTRE</option>
                <option value="EMEF CÔNEGO JOSÉ LUIZ PEREIRA RIBEIRO – CÔNEGO">EMEF CÔNEGO JOSÉ LUIZ PEREIRA RIBEIRO – CÔNEGO</option>
                <option value="EMEF CORONEL JOSÉ BENEDITO MARCONDES DE MATOS – CORONEL">EMEF CORONEL JOSÉ BENEDITO MARCONDES DE MATOS – CORONEL</option>
                <option value="EMEF DR. QUIRINO – DR. QUIRINO">EMEF DR. QUIRINO – DR. QUIRINO</option>
                <option value="EMEF PROF. ERNANI GIANNICO – ERNANI">EMEF PROF. ERNANI GIANNICO – ERNANI</option>
                <option value="EMIEF PROF. ERNESTO DE OLIVEIRA FILHO – ERNESTO">EMIEF PROF. ERNESTO DE OLIVEIRA FILHO – ERNESTO</option>
                <option value="EMEF VEREADOR JOAQUIM FRANÇA – ESPLANADA I">EMEF VEREADOR JOAQUIM FRANÇA – ESPLANADA I</option>
                <option value="EMIEF PROF. DR. JOÃO BAPTISTA ORTIZ MONTEIRO – ESPLANADA II">EMIEF PROF. DR. JOÃO BAPTISTA ORTIZ MONTEIRO – ESPLANADA II</option>
                <option value="EMEF MONSENHOR EVARISTO CAMPISTA CESAR – EVARISTO">EMEF MONSENHOR EVARISTO CAMPISTA CESAR – EVARISTO</option>
                <option value="EMEFM PROF. JOSÉ EZEQUIEL DE SOUZA – EZEQUIEL">EMEFM PROF. JOSÉ EZEQUIEL DE SOUZA – EZEQUIEL</option>
                <option value="EMEF PROF. ANTÔNIO CARLOS RIBAS BRANCO – FONTE I">EMEF PROF. ANTÔNIO CARLOS RIBAS BRANCO – FONTE I</option>
                <option value="EMEF VEREADOR PEDRO GRANDCHAMP – FONTE II">EMEF EMEF VEREADOR PEDRO GRANDCHAMP – FONTE II</option>
                <option value="EMIEF VEREADOR MÁRIO MONTEIRO DOS SANTOS – GURILÂNDIA">EMIEF VEREADOR MÁRIO MONTEIRO DOS SANTOS – GURILÂNDIA</option>
                <option value="EMEIEF CÔNEGO BENEDITO AUGUSTO CORRÊA – ITAIM">EMEIEF CÔNEGO BENEDITO AUGUSTO CORRÊA – ITAIM</option>
                <option value="EMIEIEF PROFª SIMONE DOS SANTOS – JABUTICABEIRAS">EMIEIEF PROFª SIMONE DOS SANTOS – JABUTICABEIRAS</option>
                <option value="EMEF PROFª JUDITH CAMPISTA CÉSAR – JUDITH">EMEF PROFª JUDITH CAMPISTA CÉSAR – JUDITH</option>
                <option value="EMEF PROF. JUVENAL DA COSTA E SILVA – JUVENAL">EMEF PROF. JUVENAL DA COSTA E SILVA – JUVENAL</option>
                <option value="EMEF PROF. LUIZ AUGUSTO DA SILVA – LUIZ AUGUSTO">EMEF PROF. LUIZ AUGUSTO DA SILVA – LUIZ AUGUSTO</option>
                <option value="EMEIEF EMÍLIO AMADEI BERINGHS – MARLENE MIRANDA – PRÉDIO II">EMEIEF EMÍLIO AMADEI BERINGHS – MARLENE MIRANDA – PRÉDIO II</option>
                <option value="EMEIEF PROF. JOSÉ MARCONDES DE MOURA – MONJOLINHO">EMEIEF PROF. JOSÉ MARCONDES DE MOURA – MONJOLINHO</option>
                <option value="EMEF PROF. LUIZ RIBEIRO MUNIZ – MONTE BELO">EMEF PROF. LUIZ RIBEIRO MUNIZ – MONTE BELO</option>
                <option value="EMEF CLÁUDIO CÉSAR GUILHERME DE TOLEDO – MOURISCO">EMEF CLÁUDIO CÉSAR GUILHERME DE TOLEDO – MOURISCO</option>
                <option value="EMIEF MARTA MIRANDA D’EL REY – NOVO HORIZONTE">EMIEF MARTA MIRANDA D’EL REY – NOVO HORIZONTE</option>
                <option value="EMEIEF BENEDITO JOSÉ DOS SANTOS – PAIOL">EMEIEF BENEDITO JOSÉ DOS SANTOS – PAIOL</option>
                <option value="EMEIEF JOSÉ RUBENS WAUNER DE CAMARGO – POUSO FRIO">EMEIEF JOSÉ RUBENS WAUNER DE CAMARGO – POUSO FRIO</option>
                <option value="EMEF PROF. WALTER THAUMATURGO – PARQUE SÃO LUIZ">EMEF PROF. WALTER THAUMATURGO – PARQUE SÃO LUIZ</option>
                <option value="EMIEF DR. AVEDIS VICTOR NAHAS – QUINTA DOS EUCALIPTOS">EMIEF DR. AVEDIS VICTOR NAHAS – QUINTA DOS EUCALIPTOS</option>
                <option value="EMIEF AMEDEO PICCINI – QUIRIRIM">EMIEF AMEDEO PICCINI – QUIRIRIM</option>
                <option value="EMEF Pe. PROF. DR. RAMON DE OLIVEIRA ORTIZ – RAMON">EMEF Pe. PROF. DR. RAMON DE OLIVEIRA ORTIZ – RAMON</option>
                <option value="EMEF ANTÔNIO DE ANGELIS – REGISTRO">EMEF ANTÔNIO DE ANGELIS – REGISTRO</option>
                <option value="EMEF PROF. LAFAYETTE RODRIGUES PEREIRA – SÃO GONÇALO">EMEF PROF. LAFAYETTE RODRIGUES PEREIRA – SÃO GONÇALO</option>
                <option value="EMIEF PROFª ANNA DOS REIS SIGNORINI – SEDES">EMIEF PROFª ANNA DOS REIS SIGNORINI – SEDES</option>
                <option value="EMEF FREI ARTHUR SALVATI – SÍTIO SANTO ANTONIO I">EMEF FREI ARTHUR SALVATI – SÍTIO SANTO ANTONIO I</option>
                <option value="EMIEF SGT EVERTON VENDRAMEL DE CASTRO CHAGAS – SÍTIO SANTO ANTONIO II">EMIEF SGT EVERTON VENDRAMEL DE CASTRO CHAGAS – SÍTIO SANTO ANTONIO II</option>
                <option value="EMEF PROF. WALTHER DE OLIVEIRA – SONIA MARIA">EMEF PROF. WALTHER DE OLIVEIRA – SONIA MARIA</option>
                <option value="EMEF PREFEITO ÁLVARO MARCONDES DE MATTOS – SANTA CATARINA">EMEF PREFEITO ÁLVARO MARCONDES DE MATTOS – SANTA CATARINA</option>
                <option value="EMEF DIÁCONO JOSÉ ANGELO VICTAL – SANTA LUZIA">EMEF DIÁCONO JOSÉ ANGELO VICTAL – SANTA LUZIA</option>
                <option value="EMIEF PROFª DOCELINA SILVA DE CAMPOS COELHO – SANTA TEREZA">EMIEF PROFª DOCELINA SILVA DE CAMPOS COELHO – SANTA TEREZA</option>
                <option value="EMEF DOM PEREIRA DE BARROS – SANTA TEREZA/BELA VISTA">EMEF DOM PEREIRA DE BARROS – SANTA TEREZA/BELA VISTA</option>
                <option value="EMEF DOM JOSÉ ANTONIO DO COUTO – VILA SÃO JOSÉ I EMEF ERNANI BARROS MORGADO – VILA SÃO JOSÉ II">EMEF DOM JOSÉ ANTONIO DO COUTO – VILA SÃO JOSÉ I EMEF ERNANI BARROS MORGADO – VILA SÃO JOSÉ II</option>
                <option value="EMEIEF VEREADORA JUDITH MAZELLA MOURA – VILA CAETANO">EMEIEF VEREADORA JUDITH MAZELLA MOURA – VILA CAETANO</option>
                <option value="EMEIEF TOMÉ PORTES DEL REI – VILA VELHA">EMEIEF TOMÉ PORTES DEL REI – VILA VELHA</option>
                <option value="EMEIEF BRAZ SILVÉRIO LEMES - SANTA LUZIA RURAL">EMEIEF BRAZ SILVÉRIO LEMES - SANTA LUZIA RURAL</option>
                <option value="EMIEF PROFª ANA SILVIA PAOLICHI FERRO - PEEJ V – CONTINENTAL">EMIEF PROFª ANA SILVIA PAOLICHI FERRO - PEEJ V – CONTINENTAL</option>
            </select>
        </div>
        <div class="col-sm-3">
            <label for="anoEscolar" class="text">Ano e turma escolar *</label>
            <input type="text" name="anoescolar" id="anoescolar" class="form-control form-control-sm" required="" maxlength="4" placeholder="Ex: 7º B">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <label for="cep" class="text">CEP *</label>
            <input type="text" name="cep" id="cep" class="form-control form-control-sm" required="" maxlength="8" placeholder="Apenas números">
        </div>
        <div class="col-sm-4">
            <label for="logradouro" class="text">Endereço *</label>
            <input type="text" name="endereco" id="endereco" class="form-control form-control-sm" required="" maxlength="120">
        </div>
        <div class="col-sm-2">
            <label for="numero" class="text">Número *</label>
            <input type="text" name="numero" id="numero" class="form-control form-control-sm" required="" maxlength="6">
        </div>
        <div class="col-sm-2">
            <label for="bairro" class="text">Bairro *</label>
            <input type="text" name="bairro" id="bairro" class="form-control form-control-sm" required="" maxlength="50">
        </div>
        <div class="col-sm-2">
            <label for="cidade" class="text">Cidade *</label>
            <input type="text" name="cidade" id="cidade" class="form-control form-control-sm" required="" maxlength="50">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <label for="resp1" class="text">Nome da mãe/pai *</label>
            <input type="text" name="resp1" id="resp1" class="form-control form-control-sm" required="" maxlength="80">
        </div>
        <div class="col-sm-3">
            <label for="resp2" class="text">Nome da mãe/pai *</label>
            <input type="text" name="resp2" id="resp2" class="form-control form-control-sm" maxlength="80">
        </div>
        <div class="col-sm-3">
            <label for="resp" class="text">Nome do responsável no dia da prova *</label>
            <input type="text" name="resp" id="resp" class="form-control form-control-sm" required maxlength="80">
        </div>
        <div class="col-sm-3">
            <label for="parentesco" class="text">Parentesco de quem irá acompanhar *</label>
            <input type="text" name="parentesco" id="parentesco" class="form-control form-control-sm" required maxlength="20">
        </div>
    </div>
    <div class="row" style="margin-top: 1.2em;">
        <div class="col-sm-3" style="margin-top: 1.5em;">
            <label class="text">Pratica algum esporte?</label>
            <input type="radio" value="1" name="esporte" id="esporte">Sim
            <input type="radio" value="0" name="esporte" id="esporte">Não
        </div>
        <div class="col-sm-3">
            <label class="text">Qual?</label>
            <input type="text" name="esportePratica" id="esportePratica" class="form-control form-control-sm" maxlength="30">
        </div>
        <div class="col-sm-3">
            <label class="text">Onde?</label>
            <input type="text" name="localEsporte" id="localEsporte" class="form-control form-control-sm" maxlength="30">
        </div>
    </div>
    <div class="row" style="margin-top: 1.2em;">
        <div class="col-sm-4" style="margin-top: 1.5em;">
            <label class="text">Apresenta alguma deficiência?</label>
            <input type="radio" value="1" name="deficiencia" id="deficiencia">Sim
            <input type="radio" value="0" name="deficiencia" id="deficiencia">Não
        </div>
        <div class="col-sm-3">
            <label class="text">Qual?</label>
            <input type="text" name="qualDeficiencia" id="qualDeficiencia" class="form-control form-control-sm" maxlength="30">
        </div>
    </div>
    <div class="row" style="margin-top: 1.2em;">
        <div class="col-sm-3" style="margin-top: 1.5em;">
            <label class="text">Usa algum medicamento?</label>
            <input type="radio" value="1" name="medicamentos" id="medicamentos">Sim
            <input type="radio" value="0" name="medicamentos" id="medicamentos">Não
        </div>
        <div class="col-sm-3">
            <label class="text">Qual(is)?</label>
            <input type="text" name="qualMedicamento" id="qualMedicamento" class="form-control form-control-sm" maxlength="60">
        </div>
    </div>
    <div class="row" style="margin-top: 1.2em;">
        <div class="col-sm-3" style="margin-top: 1.5em;">
            <label class="text">Possui convênio médico?</label>
            <input type="radio" value="1" name="convenio" id="convenio">Sim
            <input type="radio" value="0" name="convenio" id="convenio">Não
        </div>
        <div class="col-sm-3">
            <label class="text">Qual?</label>
            <input type="text" name="qualConvenio" id="qualConvenio" class="form-control form-control-sm" maxlength="30">
        </div>
    </div>
    <div class="row" style="margin-top: 1.2em;">
        <div class="col-sm-6" style="margin-top: 1.5em;">
            <label class="text">Está autorizado a realizar atividades físicas?</label>
            <input type="radio" value="1" name="atividades" id="atividades">Sim
            <input type="radio" value="0" name="atividades" id="atividades">Não
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="text">Modalidade que irá concorrer</label>
            <select name="modalidade" id="modalidade" class="form-control form-control-sm" required="">
                <option value="null" selected disabled>-- Selecione --</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label class="text">Modalidade que irá concorrer</label>
            <select name="modalidade" id="modalidade" class="form-control form-control-sm" required="">
                <option value="null" selected disabled>-- Selecione --</option>
            </select>
        </div>
    </div>

    <hr class="hr-divide-light">

    <div class="row">
        <div class="col-sm-2 offset-sm-4">
            <input type="submit" value="Cadastrar" class="button button2" onclick="">
        </div>
        <div class="col-sm-2">
            <input type="reset" value="Limpar" class="button button1" onclick="">
        </div>
    </div>
    </form>
</div>
</body>
</html>