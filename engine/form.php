<?php
namespace raiz;
// *********** FORM DO ENGINE **********
?>
<table class=grid>
<form action="<?=$PHP_SELF;?>" method=post enctype="multipart/form-data">
	<input type=hidden name=processar value=1>
<?php
// montando dados do formulario
        if (!is_array($msg_erro))
             // só carrega os dados se não houve erro de validacao
						$array = null;
		  			$array[processo][valor]  = $_GET["processo"];

            $form = CallAPI("POST", $SERVER_API."Engine/".$_GET["idfeature"]."/Form" , json_encode( $array) );
						$array = null;

						 //echo "<pre> "; var_dump($form);

            echo "<input type=hidden name=processo value='".$_GET["processo"]."' >";
            echo "<input type=hidden name=idposto_anterior value='".$_GET["idposto_anterior"]."' >";
            echo "<input type=hidden name=H value='".$_REQUEST["H"]."' >";

            echo "<caption> ".$form["DADOS_POSTO"][nomeposto]."</caption>";

            foreach ($form[FETCH_CAMPO] as $idcampo => $linha){
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
                            <TD>   ".(($linha["obrigatorio"])?"<font color=#ff0000>*</font>":""). $linha["campo"]."</td>
                            <TD> ";


										$linha["valor"] = (($linha["valor"])?$linha["valor"]:$linha["valor_default"]) ;

                    switch ($linha["inputtype"])
                    {
                        case("textarea"):
                            echo "<textarea rows='". $linha["txtarea_rows"]."' cols='". $linha["txtarea_cols"]."' name=idcampoposto[". $linha["idcampo"]."]>". $linha["valor"]."</textarea> ".$linha["dica_preenchimento"];
                        break;

                        case("file"):
                            echo "<input type=file name=idcampoposto[". $linha["idcampo"]."]> </textarea>";
                        break;


                        case("select"):
                            echo "<select    name=idcampoposto[". $linha["idcampo"]."] >";
                            foreach ( $linha["valor_default"] as $idtecnologia  => $val_tecnologia)
                                echo "<option ".((  $idtecnologia == $linha["valor"]  )?"selected":"")." value='$idtecnologia'>$val_tecnologia</option>";

                            echo " </select>";
                        break;


                        case("Sim/Nao"):
                            echo  "<input type=radio name=idcampoposto[". $linha["idcampo"]."] ".(($linha["valor"]==1)?"checked":"")." value=1> Sim <input type=radio   ".((!$linha["valor"])?"checked":"")."  name=idcampoposto[". $linha["idcampo"]."] value=0> Não";

                        break;

                        case("list"):
                            echo "<select multiple  name=idcampoposto[". $linha["idcampo"]."][]>";
                            foreach ( $linha["valor_default"] as $idtecnologia  => $val_tecnologia)
                                echo "<option ".(( in_array($idtecnologia, $linha["valor"]) )?"selected":"")." value='$idtecnologia'>$val_tecnologia</option>";

                            echo " </select>";
                        break;

                        default:
                            echo " <input type=text size='". $linha["maxlenght"]."' name=idcampoposto[". $linha["idcampo"]."] value='". $linha["valor"]."'>";
                    }

                    echo " $exibir_erro
                            </td>
                       </tr>	 ";
                    echo "<input type=hidden name=idworkflowdado[". $linha["idcampo"]."] value='". $linha["idworkflowdado"]."'>";
                    echo "<input type=hidden name=obrigatorio[". $linha["idcampo"]."] value='". $linha["obrigatorio"]."'>";
                    echo "<input type=hidden name=inputtype[". $linha["idcampo"]."]  value='". $linha["inputtype"]."'>";
            }

                echo "
                    </table>
                    <table>
                        <tr>
														<td><input type=button   value=' <<< Voltar'> </td> ";
		echo "         				  <td><input type=submit name=finalizar value='".$SYS_DEPARA_CAMPOS["bt_handover"]."'> </td> ";

      if ($form[DADOS_POSTO][starter] != 1)
          echo "     <td><input type=submit name=finalizar value='Salvar'> </td>";

                echo "</tr> ";
		?>

</form>
