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


echo "<tr>";
		echo "<TD><b>Selecionar</b></td>";
foreach ($candidatos[TITULO] as $idcampo => $linha){
		echo "<TD title='$idcampo'>   <b> ". $linha ."</b></td>";
}
    echo "<TD><b>Match com a vaga</b></td>";
echo "</tr>";



 //echo "<pre>"; var_dump($candidatos  );


foreach ( $candidatos["FETCH"] as $idcandidato => $candidato){
	echo "<tr>";
	echo "
						<td><input type=checkbox name=candidatos_selecionados[$idcandidato]  value='$idcandidato'> </td>";
						/*
											<td>".$candidato["nome"]."</td>
						<td>".$candidato["skills"]."</td>
						<td>".$candidato["consultoria"]."</td>
						<td>". (($candidato["cv"] )? link_download($idcandidato): "-" )." </td>
						<td nowrap 	>".match_candidato_vaga( $candidato["match"])."</td>
						<td>".$candidato["senioridade1"]."</td>
						<td>".$candidato["senioridade2"]."</td>";
						*/

		foreach ($candidatos[TITULO]  as $campo => $linha){


	      // Resolver o campo responsÃ¡vel ou imprimir direto da api
	      $resu = null;
				/*
	      foreach ($SYS_DEPARA_CAMPOS as $lab => $chv){
	          if ($chv == $campo )
	              $resu = $usuarios["USUARIOS_POSTO"][$_GET["idposto"]][$dados[$campo]];
	      }
				*/
	      $resu = (($resu)?$resu:$candidato[$campo]);
				$resu = ((strlen($resu) > 60 )?substr( $resu,0,60)."...":$resu);


				if ($campo == $candidatos["CONFIGURACOES"] [CV])
					echo "<TD>   ". (($candidato[$campo])? link_download($idcandidato): "-" )."  </td>";
				else
					echo "<TD>   $resu  </td>";


	  }

		echo " <td nowrap 	>".match_candidato_vaga( $candidato["match"])."</td>";

	echo "
			 </tr>";
}

echo "<tr>
					<td colspan=10><input type=submit value='Considerar estes candidatos >>>'> </td>
		 </tr>";
?>
</form>
