<?php
namespace raiz;

//FIXME: adicionar _get[menu] nos links
$usuarios = CallAPI("get", $SERVER_API."Usuarios/Posto/".$_GET["idposto"] );

$form = CallAPI("POST", $SERVER_API.$_GET["idworkflow"]."/getPosto/Lista/".$_GET["idposto"], json_encode( $_GET ) );

echo "
		<table  class=grid  >
		 <caption> ".$form["DADOS_POSTO"][nomeposto]."</caption>";


if (is_array($form[FUNCOES_POSTO]))
{
	echo "
			 <tr class='funcoes'>";
		 echo "<TD align=right colspan=100>
							";
		 foreach ($form[FUNCOES_POSTO] as $funcao => $dados){
			 echo "  <a href='$PHP_SELF?idmenu=".$_GET["idmenu"]."&idworkflow=".$_GET["idworkflow"]."&idposto_anterior=".$_GET["idposto"]."&lista=".$dados[lista]."&idposto=".$dados[avanca_processo]."'>$funcao</a>  ";
		 }

		 echo "
		 </td>";
	echo "</tr>
	";
}



if (is_array($form[TITULO]))
{

    echo "<thead>
					<tr>";
        echo "<Th>Processo</th>";
    foreach ($form[TITULO] as $idcampo => $linha){
        echo "<Th title='$idcampo'>  ". $linha ." </th>";
    }
		echo "<Th colspan=".count($form[ACOES])." > Opções </th>";

     echo "</tr>
	    	</thead>
				<tbody>";


//$form["FETCH_POSTO"]=null; echo "<PRE>"; var_dump($form);

    foreach ($form[FETCH]  as $processo => $dados){
        echo "<Tr>";
        echo "<TD> <a href='processos.php?idprocesso=".$processo."' target=__blank >". $processo ."</a>  </td>";
        foreach ($form[TITULO]  as $campo => $linha){


            // Resolver o campo responsÃ¡vel ou imprimir direto da api
            $resu = null;
            foreach ($SYS_DEPARA_CAMPOS as $lab => $chv){
                if ($chv == $campo )
                    $resu = $usuarios["USUARIOS_POSTO"][$_GET["idposto"]][$dados[$campo]];
            }
            $resu = (($resu)?$resu:$dados[$campo]);
						$tam = 200;
						$resu = ((strlen($resu) > $tam )?substr( $resu,0,$tam)."...":$resu);

						if ($campo == $form["CONFIGURACOES"] [CV]){
							$usar = (($dados[ $form["CONFIGURACOES"]["ENTIDADE_FILHA_APONTA_PARA_CANDIDATO"] ]>0 )
												?$dados[ $form["CONFIGURACOES"]["ENTIDADE_FILHA_APONTA_PARA_CANDIDATO"] ]
												:$processo
											);
							echo "<TD>   ". (($dados[$campo])? link_download($usar, "CV"): "-" )."  </td>";


						}
						else if ($campo == $form["CONFIGURACOES"] ["github"])
							echo "<TD>   ". (($dados[$campo])? link_download($dados[$campo], 'github'): "-" )."  </td>";


						else
							echo "<TD>   $resu  </td>";

//            echo "<TD>   $resu  </td>";


        }

        if (is_array($form[ACOES] )){
            if ($dados[ $SYS_DEPARA_CAMPOS["Responsavel"]."-ID" ] == $_SESSION["idusuariologado"]
            || !$dados[ $SYS_DEPARA_CAMPOS["Responsavel"] ]){
                foreach ($form[ACOES] as $acao){

                    echo "<TD>   <a href='$PHP_SELF?idmenu=".$_GET["idmenu"]."&amr=". $acao[assumir] ."&wkdaas=".$dados[tramitacao_idusuario]."&idposto_anterior=".$_GET["idposto"]."&processo=$processo&H=". $dados[idworkflowtramitacao] ."&idworkflow=". $acao[idworkflow] ."&lista=". $acao[lista] ."&idposto=".$acao[ir]."'>";
                    echo  (($acao[assumir]==1 & $dados[tramitacao_idusuario]>0)?"Desassumir":$acao[acao]) ;
                    echo  "</a>
                       </td>";

                }

            }

        }

        echo "</tr>";
    }
		echo "</tbody>
		    </table>";
}
else
    echo "<tr>
                <td>Nenhum registro encontrado.... :(</td>
          </tr>";


?>
