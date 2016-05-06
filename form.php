<form action="<?=$PHP_SELF;?>" method=post>
	<input type=hidden name=processar value=1>
	
<?php 
if ($_POST["processar"]==1)
{
	 
	foreach ($_POST["idcampoposto"] as $key => $result)
	{
		$array[$key][idpostocampo]  = $key;		
		$array[$key][valor]  = $result;		
		
		$array[$key][idworkflowdado]  = $_POST["idworkflowdado"][$key];
	}
	$array[processo][valor]  = $_POST["processo"];	
	$array[processo][acao]  = $_POST["finalizar"];
		
	$registering = CallAPI("POST", $SERVER_API."Registrar/".$_GET["idworkflow"]."/".$_GET["idposto"] , json_encode( $array) );

	if ($registering["resultado"] == "SUCESSO"){
		echo " <font color='#ff0000'>Dados registrados com sucesso</font> ";
	}
}


	$form = CallAPI("get", $SERVER_API.$_GET["idworkflow"]."/".(($_GET["processo"])?$_GET["processo"]:"0")."/getPosto/".$_GET["idposto"] );

	//if ($form[DADOS_POSTO][starter] != 1)
		echo "<input type=hidden name=processo value='".$_GET["processo"]."' >";
	
		foreach ($form[FETCH] as $linha){
			echo "<tr>
			    	<TD>". $linha["campo"]."</td>";
			echo "  <TD> ".$linha["idcampo"]." <input type=text name=idcampoposto[". $linha["idcampo"]."] value='". $linha["valor"]."' size=30></td>
	  		   </tr>	 ";
			echo "<input type=hidden name=idworkflowdado[". $linha["idcampo"]."] value='". $linha["idworkflowdado"]."'>";
		}
		
		echo "<tr>
				<td><input type=button   value=' <<< Voltar'> </td> ";
		if ($form[DADOS_POSTO][starter] != 1)
			echo "<td><input type=submit name=finalizar value='Salvar'> </td>";
		echo "			<td><input type=submit name=finalizar value='Salvar e Avançar >>>'> </td> 
				</tr> ";
		?>

</form>