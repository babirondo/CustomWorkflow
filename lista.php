<?php 
$usuarios = CallAPI("get", $SERVER_API."Usuarios/Posto/".$_GET["idposto"] );

$form = CallAPI("get", $SERVER_API.$_GET["idworkflow"]."/getPosto/Lista/".$_GET["idposto"] );
		// TODO exibir titulo da pagina
echo "<tr>";
	echo "<TD>Processo</td>"; 
foreach ($form[TITULO] as $idcampo => $linha){
	echo "<TD title='$idcampo'> ". $linha ."</td>"; 
}
echo "<tr>";

	
foreach ($form[FETCH] as $processo => $dados){
    echo "<Tr>"; 
    echo "<TD>". $processo ."</td>"; 
    foreach ($form[TITULO] as $campo => $linha){
        $resu = null;
        foreach ($SYS_DEPARA_CAMPOS as $lab => $chv){
            if ($chv == $campo ){
                $resu = $usuarios["USUARIOS_POSTO"][$_GET["idposto"]][$dados[$campo]]; 
            }

        }
                
        $resu = (($resu)?$resu:$dados[$campo]);
        echo "<TD>   ". $resu ."</td>"; 
        
        
    }

    if (is_array($form[ACOES] )){
        foreach ($form[ACOES] as $acao){
            echo "<TD>"
        . "         <a href='$PHP_SELF?amr=". $acao[assumir] ."&wkdaas=".$dados[idworkflowdado_assumir]."&processo=$processo&H=". $dados[idworkflowtramitacao] ."&idworkflow=". $acao[idworkflow] ."&lista=". $acao[lista] ."&idposto=".$acao[ir]."'>". $acao[acao] ."</a>"
               . "</td>";
        }

    }

    echo "</tr>";
}
 
?>