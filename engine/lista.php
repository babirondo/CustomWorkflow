<?php
namespace raiz;




//FIXME: adicionar _get[menu] nos links
//$usuarios = CallAPI("get", $SERVER_API."Usuarios/Feature/".$_GET["idfeature"] );

$form = CallAPI("POST", $SERVER_API."Engine/".$_GET["idfeature"]."/Lista", json_encode($_POST["filtro"]) );

echo "<tr>";
	echo "<TD colspan=100><h1> ".$form["DADOS_feature"][nomefeature]."</td>";
echo "</tr>";

//echo "<Pre>"; var_dump($form);

if (is_array($form[FUNCOES_FEATURE]))
{
    echo "<tr>";
        echo "<TD align=right colspan=100>
                <table>
                    <tr>";
				        foreach ($form[FUNCOES_FEATURE] as $funcao => $dados){
				        	echo "<TD> <a href='$PHP_SELF?idmenu=".$_GET["idmenu"]."&idfeature=".$dados["goto"]."'>$funcao</a>  </td>";
				    		}

        echo "    </tr>
            </table>
        </td>";
    echo "</tr>";
}



if (is_array($form[TITULO]))
{


    echo "<tr>";
        echo "<TD><b>#</b></td>";
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
        <a href='$PHP_SELF?processo=". $processo."&idmenu=". $_GET["idmenu"] ."&idfeature=".$acao[ir]."'>";
                    echo   $acao[acao]  ;
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
