<form action="<?=$PHP_SELF;?>" method=post>
	<input type=hidden name=processar value=1>
<?php 

if ($_POST["processar"]==1)
{
	 
	foreach ($_POST["idcampoposto"] as $key => $result)
	{
		$array[$key][idpostocampo]  = $key;		
		$array[$key][valor]  = $result;		
	}
	$registering = CallAPI("POST", $SERVER_API."Registrar/".$_GET["idworkflow"]."/".$_GET["idposto"] , json_encode( $array) );

	if ($registering["resultado"] == "SUCESSO"){
		echo " Dados registrados com sucesso ";
	}
}


$form = CallAPI("get", $SERVER_API.$_GET["idworkflow"]."/getPosto/".$_GET["idposto"] );
		
		foreach ($form[FETCH] as $linha){
			echo "<tr>
				<TD>". $linha["campo"]."</td>";
			echo "  <TD> ".$linha["idcampo"]." <input type=text name=idcampoposto[". $linha["idcampo"]."] value='' size=30></td>
	  		   </tr>	 ";
		}
		?>
		<tr>
			<td><input type=submit value=" Registrar >>>"> </td>
		</tr>
</form>