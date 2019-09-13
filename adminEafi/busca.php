<style>
@media print{
*{
margin:0;
padding:0;
}
.LandscapeDiv{
	width: 100%;
	height: 100%;
	filter: progid:DXImageTransform.Microsoft.BasicImage(Rotation=3);
}
}
</style>

<?php
    include('include/security.php');
    include('include/connect.php');

    $select = "SELECT DATE_FORMAT (timestamp, '%d/%m/%Y %H:%i') as hora, nome, rg, sexo, 
    DATE_FORMAT(data_nasc, '%d/%m/%Y') as data_nasc, celO, telO, nomeR, deficiencia, p_opc_masc, 
    p_opc_fem FROM cad_NovoEafi";

    if(isset($_GET['modalidade'])) {
        $modalidade = '%'.$_GET['modalidade'].'%';
        
        $select .= " WHERE p_opc_masc LIKE '$modalidade' OR p_opc_fem LIKE '$modalidade'";
    } else if (isset($_GET['sexo'])) {
        $sexo = '%'.$_GET['sexo'].'%';

        $select .= " WHERE sexo LIKE '$sexo'";
    } else if (isset($_GET['modalidade_sexo'])) {
        $modalidade_sexo = $_GET['modalidade_sexo'];

        if($modalidade_sexo == "Volei-F") $select .= " WHERE sexo LIKE 'Feminino' AND p_opc_fem LIKE 'Volei'"; 
        if($modalidade_sexo == "Volei-M") $select .= " WHERE sexo LIKE 'Masculino' AND p_opc_masc LIKE 'Volei'"; 
        if($modalidade_sexo == "Futsal-F") $select .= " WHERE sexo LIKE 'Feminino' AND p_opc_fem LIKE 'Futsal'"; 
        if($modalidade_sexo == "Futsal-M") $select .= " WHERE sexo LIKE 'Masculino' AND p_opc_masc LIKE 'Futsal'"; 
        if($modalidade_sexo == "Judo-F") $select .= " WHERE sexo LIKE 'Feminino' AND p_opc_fem LIKE 'Judo'"; 
        if($modalidade_sexo == "Judo-M") $select .= " WHERE sexo LIKE 'Masculino' AND p_opc_masc LIKE 'Judo'"; 
        if($modalidade_sexo == "TM-M") $select .= " WHERE sexo LIKE 'Masculino' AND p_opc_masc LIKE 'Tenis de mesa'"; 
        if($modalidade_sexo == "TM-F") $select .= " WHERE sexo LIKE 'Feminino' AND p_opc_fem LIKE 'Tenis de mesa'"; 
        if($modalidade_sexo == "Atletismo-M") $select .= " WHERE sexo LIKE 'Masculino' AND p_opc_masc LIKE 'Atletismo'"; 
        if($modalidade_sexo == "Atletismo-F") $select .= " WHERE sexo LIKE 'Feminino' AND p_opc_fem LIKE 'Atletismo'"; 
        if($modalidade_sexo == "Basquete-F") $select .= " WHERE sexo LIKE 'Feminino' AND p_opc_fem LIKE 'Basquete'"; 
        if($modalidade_sexo == "Handebol-M") $select .= " WHERE sexo LIKE 'Masculino' AND p_opc_masc LIKE 'Handebol'"; 
    } else if(isset($_GET['all'])) {
        $select .= "";
    } else {
        header('Location: index.php');
        mysqli_close($conn);
        die();
    }
    $select .= " ORDER BY nome ASC";
    $query = mysqli_query($conn, $select);

    echo mysqli_error($conn);

    $qtd = mysqli_num_rows($query);

    if($qtd == 0) {
        echo '<h2>Não há registros</h2>';
    }
    ?>
        <h3>Encontrados <?php echo $qtd;?> inscritos para o filtro, ordenados alfabeticamente</h3>
        <table class="table" id="LandscapeDiv">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"> Nome completo </th>
                    <th scope="col">R.G.</th>
                    <!-- <th scope="col">Sexo</th> -->
                    <th scope="col">Data de nasc.</th>
                    <th scope="col"> Nome do responsável </th>
                    <th scope="col">Opc. masculina</th>
                    <th scope="col">Opc. feminina</th>
                    <th scope="col">Assinatura</th>
                </tr>
            </thead>
            <tbody>
    <?php
    while($dados = mysqli_fetch_assoc($query)) {
        $hora = $dados['hora'];
        $nome = utf8_encode($dados['nome']);
        $rg = $dados['rg']; 
        $sexo = $dados['sexo'];
        $data_nasc = $dados['data_nasc'];
        $tels = $dados['celO'].' / '.$dados['telO'];
        $nomeR = utf8_encode($dados['nomeR']);
        $deficiencia = utf8_encode($dados['deficiencia']);
        $p_opc_masc = utf8_encode($dados['p_opc_masc']);
            if($p_opc_masc == "Selecione" && $sexo == "Feminino") $p_opc_masc = "---";
            if($p_opc_masc == "Selecione" && $sexo == "Masculino") $p_opc_masc = "Não informado";
        $p_opc_fem = utf8_encode($dados['p_opc_fem']);
            if($p_opc_fem == "Selecione" && $sexo == "Masculino") $p_opc_fem = "---";
            if($p_opc_fem == "Selecione" && $sexo == "Feminino") $p_opc_fem = "Não informado";
        ?>
        
    <tr>
      <td><b><?php echo $nome; ?></b></td>
      <td><?php echo $rg; ?></td>
      <!-- <td><?php //echo $sexo; ?></td> -->
      <td><?php echo $data_nasc; ?></td>
      <td><?php echo $nomeR; ?></td>
      <td><?php echo $p_opc_masc; ?></td>
      <td><?php echo $p_opc_fem; ?></td>
      <td style="margin-top: 3em;">________________________________</td>
    </tr>
        <?php
    }
    ?>
    </table>
    <?php
mysqli_close($conn);
?>