<form action="<?=$PHP_SELF;?>" method=post enctype="multipart/form-data">
	<input type=hidden name=processar value=1>
	
<?php  
if ($_POST["processar"]==1)
{
       // echo "<pre>"; var_dump($_FILES);echo "</pre>";

        // validando campos antes de enviar
        $msg_erro = null;
        foreach ( $_POST["idcampoposto"] as $idcampo => $valor){
            
            $Restore[$idcampo][valor_postado] = $valor;
            IF ($_POST["obrigatorio"][$idcampo] == 1){

                IF ( empty( $_POST["idcampoposto"][$idcampo])  ) {
                    $Erro[$idcampo][erro] = "Campo Obrigatório";
                }
            }
        }
        if (is_array($_FILES["idcampoposto"]))
        {
            foreach ( $_FILES["idcampoposto"] as $idcampo => $valor){

                //$Restore[$idcampo][valor_postado] = $valor;
                IF ($_FILES["obrigatorio"][$idcampo] == 1){

                    IF ( empty( $_FILES["idcampoposto"][$idcampo])  ) {
                        $Erro[$idcampo][erro] = "Campo Obrigatório";
                    }
                }
            }
        }
   
        if (!is_array($Erro))
        {
                        
            foreach ($_POST["idcampoposto"] as $key => $result)
            {
                    $array[$key][idpostocampo]  = $key;		
                    $array[$key][valor]  = $result;		

                    $array[$key][idworkflowdado]  = $_POST["idworkflowdado"][$key];
            }
            if (is_array($_FILES["idcampoposto"]))
            {

                foreach ($_FILES["idcampoposto"]["tmp_name"] as $key => $result)
                {
                        $array[$key][idpostocampo]  = $key;		
                        $array[$key][valor]  = base64_encode(addslashes(fread(fopen($result, "r"), filesize($result))))  ;		

                        $array[$key][idworkflowdado]  = $_POST["idworkflowdado"][$key];
                }
            }    
                        
            $array[processo][valor]  = $_POST["processo"];	
            $array[processo][acao]  = $_POST["finalizar"];
            $array[processo][idworkflowtramitacao_original]  = $_POST["H"];
            
           // echo "<pre>"; var_dump($array);echo "</pre>";
            
            // salvando dados
            $registering = CallAPI("POST", $SERVER_API."Registrar/".$_GET["idworkflow"]."/".$_GET["idposto"] , json_encode( $array) );

            // TODO na hora que der pra fazer multiplos avaliadores pela base, tirar essa gambiarra
          //  if ($SYS_multiplos_avaliadores[$_GET["idposto"]] > 0)
           //     $registering = CallAPI("POST", $SERVER_API."Registrar/".$_GET["idworkflow"]."/".$_GET["idposto"] , json_encode( $array) );
	//var_dump($registering);

            if ($registering["resultado"] == "SUCESSO"){
                    echo " <font color='#ff0000'>Dados registrados com sucesso</font> ";
            }
        }
	
	echo "<BR> <font color='#ffaa00'><pre>".$registering["DEBUG"]."</pre></font> ";
}
        if (!is_array($msg_erro))
             // só carrega os dados se não houve erro de validacao
            $form = CallAPI("get", $SERVER_API.$_GET["idworkflow"]."/".(($_GET["processo"])?$_GET["processo"]:"0")."/getPosto/".$_GET["idposto"] );

            echo "<input type=hidden name=processo value='".$_REQUEST["processo"]."' >";
            echo "<input type=hidden name=H value='".$_REQUEST["H"]."' >";

            echo "<tr>";
                echo "<TD colspan=100><h1> ".$form["DADOS_POSTO"][nomeposto]."</td>"; 
            echo "</tr>";


            
            foreach ($form[FETCH_CAMPO] as $linha){
                    $css=null;
                    $exibir_erro=null;

                    if ($Erro[$linha["idcampo"]][erro]){
                        $css = " bgcolor=#aacccc";
                        $exibir_erro = "<font color=#ff0000>".$Erro[$linha["idcampo"]][erro]."</font>";
                    }
                    if (is_array($Erro)){
                        $linha["valor"] = $Restore[$linha["idcampo"]][valor_postado];
                    }
                    


                    echo "<tr $css>
                            <TD> ".$linha["idcampo"]." ".(($linha["obrigatorio"])?"<font color=#ff0000>*</font>":""). $linha["campo"]."</td>
                            <TD> ";



                    switch ($linha["inputtype"])
                    {
                        case("textarea"):
                            echo "<textarea rows='". $linha["txtarea_rows"]."' cols='". $linha["txtarea_cols"]."' name=idcampoposto[". $linha["idcampo"]."]>". $linha["valor"]."</textarea>";
                        break;

                        case("file"):
                            echo "<input type=file name=idcampoposto[". $linha["idcampo"]."]> </textarea>";
                        break;

                        default:
                            echo " <input type=text size='". $linha["maxlenght"]."' name=idcampoposto[". $linha["idcampo"]."] value='". $linha["valor"]."'>";
                    }

                    echo " $exibir_erro
                            </td>
                       </tr>	 ";
                    echo "<input type=hidden name=idworkflowdado[". $linha["idcampo"]."] value='". $linha["idworkflowdado"]."'>";
                    echo "<input type=hidden name=obrigatorio[". $linha["idcampo"]."] value='". $linha["obrigatorio"]."'>";
            }

                echo "
                    </table>
                    <table>
                        <tr>
				<td><input type=button   value=' <<< Voltar'> </td> ";
		echo "          <td><input type=submit name=finalizar value='Salvar e Avançar >>>'> </td> ";
                
                if ($form[DADOS_POSTO][starter] != 1)
                    echo "     <td><input type=submit name=finalizar value='Salvar'> </td>";

                echo "</tr> ";
		?>

</form>