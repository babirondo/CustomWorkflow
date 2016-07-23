<?php
namespace raiz;

       // salvando dados do form
      function AplicarCandidatos($POST, $FILES, $GET)
      {
          require("classes/globais.php");
          $POST["idposto"] = 305;
          //echo "<PRE>"; var_dump($POST);


          $registering = CallAPI("POST", $SERVER_API."ConsiderarCandidatos/".$POST["processo"]."/" , json_encode( $POST) );

          if ($POST["idposto_anterior"]>0)
          {
              $GET["idposto"] = $POST["idposto_anterior"];
              $GET["lista"]="L";
          }


          return $saida;
      }

       // salvando dados do form
      function SalvarDados($POST, $FILES, $GET)
      {
          require("classes/globais.php");



              // validando campos antes de enviar
              $msg_erro = null;


              foreach ( $POST["obrigatorio"] as $idcampo => $valor){
                 $Restore[$idcampo][valor_postado] = $POST["idcampoposto"][$idcampo];
                 if ($valor == 1)
                 {
                    // todos obrigatorios
                      switch ($POST["inputtype"][$idcampo])
                      {
                        case("list"):
                          if (!is_array($POST["idcampoposto"][$idcampo]))
                          {
                              $Erro[$idcampo][erro] = "Campo Array Obrigatório";
                          }
                        break;

                        default:
                        IF ( empty( $POST["idcampoposto"][$idcampo])  ) {
                            $Erro[$idcampo][erro] = "Campo Obrigatório";
                        }
                      }


                }

              }
              if (is_array($FILES["idcampoposto"]))
              {
                  foreach ( $FILES["idcampoposto"] as $idcampo => $valor){

                      //$Restore[$idcampo][valor_postado] = $valor;
                      IF ($FILES["obrigatorio"][$idcampo] == 1){

                          IF ( empty( $FILES["idcampoposto"][$idcampo])  ) {
                              $Erro[$idcampo][erro] = "Campo Obrigatório";
                          }
                      }
                  }
              }

              if (!is_array($Erro))
              {

                  foreach ($POST["idcampoposto"] as $key => $result)
                  {

                      switch ($POST["inputtype"][$key])
                      {
                        case("list"):
                          $array[$key][idpostocampo]  = $key;
                          $array[$key][valor]  = implode(",",$result);
                        break;

                        default:
                          $array[$key][idpostocampo]  = $key;
                          $array[$key][valor]  = $result;
                      }




                          $array[$key][idworkflowdado]  = $POST["idworkflowdado"][$key];
                  }

                  if (is_array($FILES["idcampoposto"]["tmp_name"]))
                  {
                      foreach ($FILES["idcampoposto"]["tmp_name"] as $key => $result)
                      {
                              if (!$result) continue;

                              $array[$key][idpostocampo]  = $key;
                              $array[$key][valor]  = base64_encode(addslashes(fread(fopen($result, "r"), filesize($result))))  ;

                              $array[$key][idworkflowdado]  = $POST["idworkflowdado"][$key];
                      }
                  }

                  $array[processo][valor]  = $POST["processo"];
                  $array[processo][acao]  = $POST["finalizar"];
                  $array[processo][idworkflowtramitacao_original]  = $POST["H"];

              //   echo "<pre>"; var_dump($array);echo "</pre>";

                  // salvando dados
                  $registering = CallAPI("POST", $SERVER_API."Registrar/".$GET["idworkflow"]."/".$GET["idposto"] , json_encode( $array) );

                  // TODO na hora que der pra fazer multiplos avaliadores pela base, tirar essa gambiarra
                //  if ($SYS_multiplos_avaliadores[$GET["idposto"]] > 0)
                 //     $registering = CallAPI("POST", $SERVER_API."Registrar/".$GET["idworkflow"]."/".$GET["idposto"] , json_encode( $array) );
                  //var_dump($registering);

                  if ($registering["resultado"] == "SUCESSO"){
                          $msg =  " <font color='#ff0000'>Dados registrados com sucesso</font> ";
                  }
                  if ($POST["idposto_anterior"]>0)
                  {
                      $GET["idposto"] = $POST["idposto_anterior"];
                      $GET["lista"]="L";
                  }

              }

              $msg = "<BR>  <pre>".$registering["DEBUG"]."</pre>";

              $saida[RESTORE] = $Restore;
              $saida[MSG] = $msg;
              $saida[ERRO] = $Erro;
              $saida[GET] = $GET;

              return $saida;
      }

      // salvando dados do form
     function SalvarDadosEngine($POST, $FILES, $GET)
     {
         require("classes/globais.php");



             // validando campos antes de enviar
             $msg_erro = null;


             foreach ( $POST["obrigatorio"] as $idcampo => $valor){
                $Restore[$idcampo][valor_postado] = $POST["idcampoposto"][$idcampo];
                if ($valor == 1)
                {
                   // todos obrigatorios
                     switch ($POST["inputtype"][$idcampo])
                     {
                       case("list"):
                         if (!is_array($POST["idcampoposto"][$idcampo]))
                         {
                             $Erro[$idcampo][erro] = "Campo Array Obrigatório";
                         }
                       break;

                       default:
                       IF ( empty( $POST["idcampoposto"][$idcampo])  ) {
                           $Erro[$idcampo][erro] = "Campo Obrigatório";
                       }
                     }


               }

             }
             if (is_array($FILES["idcampoposto"]))
             {
                 foreach ( $FILES["idcampoposto"] as $idcampo => $valor){

                     //$Restore[$idcampo][valor_postado] = $valor;
                     IF ($FILES["obrigatorio"][$idcampo] == 1){

                         IF ( empty( $FILES["idcampoposto"][$idcampo])  ) {
                             $Erro[$idcampo][erro] = "Campo Obrigatório";
                         }
                     }
                 }
             }

             if (!is_array($Erro))
             {

                 foreach ($POST["idcampoposto"] as $key => $result)
                 {

                     switch ($POST["inputtype"][$key])
                     {
                       case("list"):
                         $array[$key][idpostocampo]  = $key;
                         $array[$key][valor]  = implode(",",$result);
                       break;

                       default:
                         $array[$key][idpostocampo]  = $key;
                         $array[$key][valor]  = $result;
                     }




                         $array[$key][idworkflowdado]  = $POST["idworkflowdado"][$key];
                 }

                 if (is_array($FILES["idcampoposto"]["tmp_name"]))
                 {
                     foreach ($FILES["idcampoposto"]["tmp_name"] as $key => $result)
                     {
                             if (!$result) continue;

                             $array[$key][idpostocampo]  = $key;
                             $array[$key][valor]  = base64_encode(addslashes(fread(fopen($result, "r"), filesize($result))))  ;

                             $array[$key][idworkflowdado]  = $POST["idworkflowdado"][$key];
                     }
                 }

                 $array[processo][valor]  = $POST["processo"];
                 $array[processo][acao]  = $POST["finalizar"];
                 $array[processo][idworkflowtramitacao_original]  = $POST["H"];

             //   echo "<pre>"; var_dump($array);echo "</pre>";

                 // salvando dados
                   $registering = CallAPI("POST", $SERVER_API."Engine/Registrar/".$GET["idfeature"] , json_encode( $array) );

                 // TODO na hora que der pra fazer multiplos avaliadores pela base, tirar essa gambiarra
               //  if ($SYS_multiplos_avaliadores[$GET["idposto"]] > 0)
                //     $registering = CallAPI("POST", $SERVER_API."Registrar/".$GET["idworkflow"]."/".$GET["idposto"] , json_encode( $array) );
                 //var_dump($registering);

                 if ($registering["resultado"] == "SUCESSO"){
                         $msg =  " <font color='#ff0000'>Dados registrados com sucesso</font> ";
                 }
                 if ($POST["idposto_anterior"]>0)
                 {
                     $GET["idposto"] = $POST["idposto_anterior"];
                     $GET["lista"]="L";
                 }

             }

             $msg = "<BR>  <pre>".$registering["DEBUG"]."</pre>";

             $saida[RESTORE] = $Restore;
             $saida[MSG] = $msg;
             $saida[ERRO] = $Erro;
             $saida[GET] = $GET;

             return $saida;
     }



    function Assumir($POST, $FILES, $GET){
        require("classes/globais.php");
        // assumir idprocesso no posto

        $array[$SYS_DEPARA_CAMPOS["Responsavel"]][valor]  = $GET["processo"] ;
        $array[$SYS_DEPARA_CAMPOS["Responsavel"]]["idworkflowdado"]  = $GET["wkdaas"] ;
        $array[$SYS_DEPARA_CAMPOS["Responsavel"]]["idtramitacao"]  = $GET["H"] ;
        $array[processo][valor]  = $GET["processo"];

        if ($GET["wkdaas"])
            $desassociar  = CallAPI("POST", $SERVER_API."Posto/Desassociar/".$GET["idposto"] , json_encode( $array) );
        else
            $associar  = CallAPI("POST", $SERVER_API."Posto/Associar/".$GET["idposto"] , json_encode( $array) );

    //    $saida[RESTORE] = $Restore;


        return $saida;
    }


?>
