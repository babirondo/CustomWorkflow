<?php
namespace raiz;

//FIXME: adicionar _get[menu] nos links
$usuarios = CallAPI("get", $SERVER_API."Usuarios/Feature/".$_GET["idfeature"] );

$form = CallAPI("POST", $SERVER_API."Engine/".$_GET["idfeature"]."/Lista", json_encode($_POST["filtro"]) );

echo "<tr>";
	echo "<TD colspan=100><h1> ".$form["DADOS_feature"][nomefeature]."</td>";
echo "</tr>";


if (is_array($form[FUNCOES_feature]))
{
    echo "<tr>";
        echo "<TD align=right colspan=100>
                <table>
                    <tr>";
        foreach ($form[FUNCOES_feature] as $funcao => $dados){
        	echo "<TD> <a href='$PHP_SELF?idworkflow=".$_GET["idworkflow"]."&idfeature_anterior=".$_GET["idfeature"]."&lista=".$dados[lista]."&idfeature=".$dados[avanca_processo]."'>$funcao</a>  </td>";
    		}

        echo "    </tr>
            </table>
        </td>";
    echo "</tr>";
}



if (is_array($form[TITULO]))
{

	/*
//	  echo "<pre>";var_dump($_POST["filtro"]);
    echo "<tr>";
        echo "<TD colspan=100>
								<table >
									<tr>
									<form action='$PHP_SELF?idworkflow=".$_GET["idworkflow"]."&lista=".$_GET["lista"]."&idfeature=".$_GET["idfeature"]."' method=post>";

								foreach ($form[FILTROS_feature] as $idfiltro => $filter){
				        	echo "<TD>  ";
									echo $filter[FILTRO];


									switch ( $filter[TIPO] )
									{
										case("COMBO"):
											echo "<SELECT name=filtro[$idfiltro]>";
											  echo "<option value='-1'>TODOS</option>";
											foreach ($filter[ITENS] as $option){
												echo "<option ".(( $_POST[filtro][$idfiltro] == $option)? "SELECTED":"").">$option</option>";
											}
											echo "</select>";
										BREAK;

										default:
											echo "Tipo de Filtro Não existente: ".$filter[TIPO];
									}
								  echo "</td>";

				    		}

								echo "<td> <input type=submit value='Filtrar'> </td>
								</form>";

								echo "
							   	</tr>
								</table>
				      </td>";
    echo "</tr>";
*/

    echo "<tr>";
        echo "<TD><b>Processo</b></td>";
    foreach ($form[TITULO] as $idcampo => $linha){
        echo "<TD title='$idcampo'>  <b> ". $linha ."</b></td>";
    }
    echo "</tr>";

    foreach ($form[FETCH]  as $processo => $dados){
        echo "<Tr>";
//				echo "<TD> <a href='processos.php?idprocesso=".$processo."' target=__blank >". $processo ."</a>  </td>";
				echo "<TD>  ". $processo ."   </td>";
        foreach ($form[TITULO]  as $campo => $linha){

            $resu =  $dados[$campo];
						$resu = ((strlen($resu) > 30 )?substr( $resu,0,30)."...":$resu);

            echo "<TD>   $resu  </td>";


        }

        if (is_array($form[ACOES] )){
            if ($dados[ $SYS_DEPARA_CAMPOS["Responsavel"]."-ID" ] == $_SESSION["idusuariologado"]
            || !$dados[ $SYS_DEPARA_CAMPOS["Responsavel"] ]){
                foreach ($form[ACOES] as $acao){
                    echo "<TD>
        <a href='$PHP_SELF?amr=". $acao[assumir] ."&wkdaas=".$dados[tramitacao_idusuario]."&idfeature_anterior=".$_GET["idfeature"]."&processo=$processo&H=". $dados[idworkflowtramitacao] ."&idworkflow=". $acao[idworkflow] ."&lista=". $acao[lista] ."&idfeature=".$acao[ir]."'>";
                    echo  (($acao[assumir]==1 & $dados[tramitacao_idusuario]>0)?"Desassumir":$acao[acao]) ;
                    echo  "</a>
                       </td>";
                }

            }

        }

        echo "</tr>";
    }
}
else
    echo "<tr>
                <td>Nenhum registro encontrado.... :(</td>
          </tr>";


?>
