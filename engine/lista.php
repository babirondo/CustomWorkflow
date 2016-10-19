<?php
namespace raiz;




//FIXME: adicionar _get[menu] nos links
//$usuarios = CallAPI("get", $SERVER_API."Usuarios/Feature/".$_GET["idfeature"] );

$form = CallAPI("POST", $SERVER_API."Engine/".$_GET["idfeature"]."/Lista", json_encode($_POST["filtro"]) );

echo "<table class=grid>
			<caption>".$form["DADOS_feature"][nomefeature]."</caption>";

//echo "<Pre>"; var_dump($form);

if (is_array($form[FUNCOES_FEATURE]))
{
    echo "<tr class='funcoes'>";
        echo "<TD align=right colspan=100> ";
				        foreach ($form[FUNCOES_FEATURE] as $funcao => $dados){
				        	echo " <a href='$PHP_SELF?idmenu=".$_GET["idmenu"]."&idfeature=".$dados["goto"]."'>$funcao</a>  ";
				    		}

        echo "
        </td>";
    echo "</tr>";
}



if (is_array($form[TITULO]))
{


    echo "<thead>
				<tr>";
        echo "<Th # </th>";
    foreach ($form[TITULO] as $idcampo => $linha){
        echo "<Th  >  ". $linha ." </th>";
    }
    echo "</tr>
				</thead>
				<tbody>";

    foreach ($form[FETCH]  as $processo => $dados){
        echo "<Tr>";
//				echo "<TD> <a href='processos.php?idprocesso=".$processo."' target=__blank >". $processo ."</a>  </td>";
				echo "<TD>  ". $processo ."   </td>";
        foreach ($form[TITULO]  as $campo => $linha){

            $resu =  $dados[$campo];
						$resu = ((strlen($resu) > 30 )?substr( $resu,0,30)."...":$resu);

            echo "<TD>   $resu    </td>";


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
</tbody>
</table>
