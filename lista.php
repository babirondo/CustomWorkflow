<?php 
$form = CallAPI("get", $SERVER_API.$_GET["idworkflow"]."/getPosto/Lista/".$_GET["idposto"] );
		
echo "<tr>";
	echo "<TD>Processo</td>"; 
foreach ($form[TITULO] as $linha){
	echo "<TD>". $linha ."</td>"; 
}
echo "<tr>";

	
foreach ($form[FETCH] as $processo => $dados){
	echo "<Tr>"; 
	echo "<TD>". $processo ."</td>"; 
	foreach ($form[TITULO] as $linha){
			echo "<TD>". $dados[$linha] ."</td>"; 
		}
	echo "</tr>";
}
 
?>