<?php
namespace raiz;

//FIXME: adicionar _get[menu] nos links

$form = CallAPI("GET", $SERVER_API."Vaga/".$_GET["processo"]."/Candidatos"  );

echo "<tr>";
	echo "<TD colspan=100><h1> Nome do Posto: ".$form["DADOS_POSTO"][nomeposto]."</td>";
echo "</tr>";

echo "<tr>
					<td colspan=3>Tecnologias mandatórias para a Vaga:</td>
					<td colspan=6	>".$form["DADOS_PROCESSO"]["TECNOLOGIAS_MANDATORIAS"]."</td>
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
		echo "<TD><b>Match <BR> com a vaga</b></td>";
foreach ($candidatos[TITULO] as $idcampo => $linha){
		echo "<TD title='$idcampo'>   <b> ". $linha ."</b></td>";
}
echo "</tr>";



 //echo "<pre>"; var_dump($candidatos  );


foreach ( $candidatos["FETCH"] as $idcandidato => $candidato){
	echo "<tr>";
	echo "
						<td align=center><input type=checkbox name=candidatos_selecionados[$idcandidato]  value='$idcandidato'> </td>";

						echo " <td nowrap 	>".match_candidato_vaga( $candidato["match"])."</td>";

		foreach ($candidatos[TITULO]  as $campo => $linha){


	      // Resolver o campo responsÃ¡vel ou imprimir direto da api
	      $resu = null;
				/*
	      foreach ($SYS_DEPARA_CAMPOS as $lab => $chv){
	          if ($chv == $campo )
	              $resu = $usuarios["USUARIOS_POSTO"][$_GET["idposto"]][$dados[$campo]];
	      }
				*/
				$tam = 350;
	      $resu = (($resu)?$resu:$candidato[$campo]);
				$resu = ((strlen($resu) > $tam )?substr( $resu,0,$tam)."...":$resu);


				if ($campo == $candidatos["CONFIGURACOES"] [CV])
					echo "<TD>   ". (($candidato[$campo])? link_download($idcandidato): "-" )."  </td>";
				else
					echo "<TD >   ". nl2br($resu)."   </td>";


	  }


	echo "
			 </tr>";
}

echo "<tr>
					<td colspan=10><input type=submit value='Considerar estes candidatos >>>'> </td>
		 </tr>";
?>
</form>
