<?php
namespace raiz;

//FIXME: adicionar _get[menu] nos links

$form = CallAPI("GET", $SERVER_API."Vaga/".$_GET["processo"]."/Candidatos"  );

echo "<tr>";
	echo "<TD colspan=100><h1> Nome do Posto: ".$form["DADOS_POSTO"][nomeposto]."</td>";
echo "</tr>";

echo "<tr>
					<td>Tecnologias mandatórias para a Vaga:</td>
					<td width=80%>".$form["DADOS_PROCESSO"]["TECNOLOGIAS_MANDATORIAS"]."</td>
			</tr>	";

	echo "<tr>";
		echo "<TD colspan=100><h3> Possíveis Candidatos </td>";
	echo "</tr>";


$novo[CANDIDATOS] = $form["CANDIDATOS"];
$novo[IDPOSTO] = $_GET["idposto"];
$novo[IDVAGA] = $_GET["processo"];



$candidatos = CallAPI("POST", $SERVER_API."ListarCandidatos/" , json_encode( $novo ) );
?>
<form action="<?=$PHP_SELF;?>" method=post enctype="multipart/form-data">
	<input type=hidden name=aplicar_candidatos value=1>
<?php
echo "<input type=hidden name=processo value='".$_REQUEST["processo"]."' >";
echo "<input type=hidden name=idposto_anterior value='".$_GET["idposto_anterior"]."' >";

echo "
		<tr>
				<td>Selecionar  </td>
				<td>Nome do Candidato</td>
				<td>Tecnologias que domina</td>
				<td>Match com a Vaga</td>
				<td colspan=2>Avaliações</td>
		 </tr>";

//echo "<pre>"; var_dump($candidatos["FETCH"] );


foreach ( $candidatos["FETCH"] as $idcandidato => $candidato){
	echo "<tr>
						<td><input type=checkbox name=candidatos_selecionados[$idcandidato]  value='$idcandidato'> </td>
						<td>".$candidato["nome"]."</td>
						<td>".$candidato["skills"]."</td>
						<td nowrap 	>".match_candidato_vaga( $candidato["match"])."</td>
						<td>".$candidato["senioridade1"]."</td>
						<td>".$candidato["senioridade2"]."</td>
			 </tr>";
}

echo "<tr>
					<td colspan=10><input type=submit value='Considerar estes candidatos >>>'> </td>
		 </tr>";
?>
</form>
