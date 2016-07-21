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

$candidatos = CallAPI("POST", $SERVER_API."ListarCandidatos/" , json_encode( $novo ) );

echo "<tr>
				<td>Nome do Candidato</td>
				<td>Tecnologias que domina</td>
				<td>Avaliações</td>
		 </tr>";

//echo "<pre>"; var_dump($candidatos["FETCH"] );


foreach ( $candidatos["FETCH"] as $idcandidato => $candidato){
	echo "<tr>
						<td>".$candidato["nome"]."</td>
						<td>".$candidato["skills"]."</td>
						<td>".$candidato["avaliacoes"]."</td>
			 </tr>";
}

?>
