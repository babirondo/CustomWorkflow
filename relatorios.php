<?php
$relatorios = CallAPI("POST", $SERVER_API."Relatorios/");





echo "<tr>";
 
foreach ($relatorios[TITULO] as $idcampo => $linha){
	echo "<TD title='$idcampo'> $idcampo </td>"; 
}
echo "</tr>";

	
foreach ($relatorios[RESULTSET]  as $processo => $dados){
    echo "<Tr>"; 
   
    foreach ($relatorios[TITULO]  as $campo => $linha){
        echo "<TD>   ".$dados[$campo]."  </td>"; 
    }

    echo "</tr>";
}


?>