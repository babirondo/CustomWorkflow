<form action="<?=$PHP_SELF;?>" method=post enctype="multipart/form-data">
	<input type=hidden name=processar value=1>
	
<?php  

        if (!is_array($msg_erro))
             // só carrega os dados se não houve erro de validacao
            $form = CallAPI("get", $SERVER_API.$_GET["idworkflow"]."/".(($_GET["processo"])?$_GET["processo"]:"0")."/getPosto/".$_GET["idposto"] );

            echo "<input type=hidden name=processo value='".$_REQUEST["processo"]."' >";
            echo "<input type=hidden name=idposto_anterior value='".$_GET["idposto_anterior"]."' >";
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
		echo "          <td><input type=submit name=finalizar value='".$SYS_DEPARA_CAMPOS["bt_handover"]."'> </td> ";
                
                if ($form[DADOS_POSTO][starter] != 1)
                    echo "     <td><input type=submit name=finalizar value='Salvar'> </td>";

                echo "</tr> ";
		?>

</form>