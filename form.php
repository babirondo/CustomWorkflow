<?php
namespace raiz;
?>
<form action="<?=$PHP_SELF;?>" method=post enctype="multipart/form-data">
	<input type=hidden name=processar value=1>
<?php
// listando historico do processo
$vida_processo = CallAPI("get", $SERVER_API."VidaProcesso/".$_GET["processo"] );

$exibir_historico=0;
if ($exibir_historico == 1){
echo "<tr>";
		echo "<TD colspan=100><h1> Histórico do Processo</td>";
echo "</tr>";

foreach ( $vida_processo["FETCH_POSTO"] as $idposto => $conteudo_posto)
{
  echo "<tr>
            <td>Posto</td>
            <td colspan=7><b>$idposto</b></td>
        </tr> ";
        $exibir=null;
        foreach ($conteudo_posto[$_GET["processo"]] as $campo => $valor )
        {
          if ($campo == "tramitacao_idusuario") continue;
          if ($campo == "-1") continue;
          if ($campo == "12-original") continue;
          if ($campo == "-1-ID") continue;
          if ($campo == "inicioprocesso") continue;
          if ($campo == "idworkflowtramitacao") continue;
          if ($campo == "atoresdoposto") continue;

          $exibir[$campo] = $valor;
        }

        $p=0;
        foreach ($exibir as $campo => $valor){



          if ($p == 0) echo "<tr>";
          echo "<td>$campo</td>";
          echo "<td>".((strlen($valor) > 30 )?substr( $valor,0,30)."...":$valor)."</td>";
          $p++;
          if ($p == 4) {
              echo "</tr>";
              $p=0;
          }
        }
}

}// exibir historico

// montando dados do formulario
        if (!is_array($msg_erro))
             // só carrega os dados se não houve erro de validacao
//						 $usar_idposto_api = (($_GET["H"])?$_GET["idposto_anterior"]: $_GET["idposto"] )  ;
						 $usar_idposto_api =  $_GET["idposto"]      ;
						 $usar_processo_api = (($_GET["processo"])?$_GET["processo"]:"0");

            $form = CallAPI("get", $SERVER_API.$_GET["idworkflow"]."/$usar_processo_api/getPosto/$usar_idposto_api" );

						$usar_idposto_anterior_api =  $_GET["idposto_anterior"]      ;
						$registro = CallAPI("get", $SERVER_API.$_GET["idworkflow"]."/$usar_processo_api/getPosto/$usar_idposto_anterior_api" );


						$form = ArrayMergeKeepKeys($form, $registro);

            echo "<input type=hidden name=processo value='".$_REQUEST["processo"]."' >";
            echo "<input type=hidden name=idposto_anterior value='".$_GET["idposto_anterior"]."' >";
            echo "<input type=hidden name=H value='".$_REQUEST["H"]."' >";

            echo "<tr>";
                echo "<TD colspan=100><h1> ".$form["DADOS_POSTO"][nomeposto]."</td>";
            echo "</tr>";

 						//echo "<PRE>";var_dump($form  );

            foreach ($form[FETCH_CAMPO] as $linha){
										// $linha["valor"] = (($linha["valor"])?$linha["valor"]:$linha["valor_default"]) ; // antigo
										$linha["valor"] =  (($form["FETCH_POSTO"][$_GET["H"]][$usar_processo_api][ $linha["idcampo"] ][valor])
																				?
																					(($form["FETCH_POSTO"][$_GET["H"]][$usar_processo_api][ $linha["idcampo"]."-original" ])
																					?explode(",",$form["FETCH_POSTO"][$_GET["H"]][$usar_processo_api][ $linha["idcampo"]."-original" ])
																					:$form["FETCH_POSTO"][$_GET["H"]][$usar_processo_api][ $linha["idcampo"] ][valor]
																					)
																				:
																					(($linha["valor"])
																					?$linha["valor"]
																					:$linha["valor_default"])
																				) ;

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
                            echo "<textarea rows='". $linha["txtarea_rows"]."' cols='". $linha["txtarea_cols"]."' name=idcampoposto[". $linha["idcampo"]."]>". $linha["valor"]."</textarea> ".$linha["dica_preenchimento"];
                        break;

                        case("file"):
                            echo "<input type=file name=idcampoposto[". $linha["idcampo"]."]>  ".link_download($_GET["processo"]) ;
                        break;


                        case("select"):
                            echo "<select    name=idcampoposto[". $linha["idcampo"]."] >";
                            foreach ( $linha["valor_default"] as $idtecnologia  => $val_tecnologia)
                                echo "<option ".((  $idtecnologia == $linha["valor"]  )?"selected":"")." value='$idtecnologia'>$val_tecnologia</option>";

                            echo " </select>";
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
                    echo "<input type=hidden name=idworkflowdado[". $linha["idcampo"]."] value='".  $form["FETCH_POSTO"][$_GET["H"]][$usar_processo_api][ $linha["idcampo"] ][workflowdado]  ."'>";
                    echo "<input type=hidden name=obrigatorio[". $linha["idcampo"]."] value='". $linha["obrigatorio"]."'>";
                    echo "<input type=hidden name=inputtype[". $linha["idcampo"]."]  value='". $linha["inputtype"]."'>";
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
