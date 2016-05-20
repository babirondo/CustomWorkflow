<?php 
$usuarios = CallAPI("get", $SERVER_API."Usuarios/Posto/".$_GET["idposto"] );

$form = CallAPI("get", $SERVER_API.$_GET["idworkflow"]."/getPosto/Lista/".$_GET["idposto"] );

echo "<tr>";
	echo "<TD colspan=100><h1> ".$form["DADOS_POSTO"][nomeposto]."</td>"; 
 
echo "</tr>";





echo "<tr>";
	echo "<TD>Processo</td>"; 
foreach ($form[TITULO] as $idcampo => $linha){
	echo "<TD title='$idcampo'> $idcampo ". $linha ."</td>"; 
}
echo "</tr>";

	
foreach ($form[FETCH]  as $processo => $dados){
    echo "<Tr>"; 
    echo "<TD>". $processo .count($form[FETCH]  )."</td>"; 
    foreach ($form[TITULO]  as $campo => $linha){
        
        
        // Resolver o campo responsÃ¡vel ou imprimir direto da api
        $resu = null;
        foreach ($SYS_DEPARA_CAMPOS as $lab => $chv){
            if ($chv == $campo )
                $resu = $usuarios["USUARIOS_POSTO"][$_GET["idposto"]][$dados[$campo]]; 
        }                
        $resu = (($resu)?$resu:$dados[$campo]);
        
        echo "<TD>   $resu  </td>"; 
        
        
    }

    if (is_array($form[ACOES] )){
        if ($dados[ $SYS_DEPARA_CAMPOS["Responsável"] ] == $_SESSION["idusuariologado"] 
        || !$dados[ $SYS_DEPARA_CAMPOS["Responsável"] ]){
            foreach ($form[ACOES] as $acao){
                echo "<TD>
    <a href='$PHP_SELF?amr=". $acao[assumir] ."&wkdaas=".$dados[idworkflowdado_assumir]."&processo=$processo&H=". $dados[idworkflowtramitacao] ."&idworkflow=". $acao[idworkflow] ."&lista=". $acao[lista] ."&idposto=".$acao[ir]."'>";
                echo  (($acao[assumir]==1 & $dados[idworkflowdado_assumir]>0)?"Desassumir":$acao[acao]) ;
                echo  "</a>
                   </td>";
            }
            
        }

    }

    echo "</tr>";
}
 
?>