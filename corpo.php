<table border=1>
<?php
if ($_GET["idposto"] != null){
    
     // salvando dados do form
    if ($_POST["processar"]==1)
    {
          
    // echo "<pre>"; var_dump($_FILES);echo "</pre>";

            // validando campos antes de enviar
            $msg_erro = null;
            foreach ( $_POST["idcampoposto"] as $idcampo => $valor){

                $Restore[$idcampo][valor_postado] = $valor;
                IF ($_POST["obrigatorio"][$idcampo] == 1){

                    IF ( empty( $_POST["idcampoposto"][$idcampo])  ) {
                        $Erro[$idcampo][erro] = "Campo ObrigatÃ³rio";
                    }
                }
            }
            if (is_array($_FILES["idcampoposto"]))
            {
                foreach ( $_FILES["idcampoposto"] as $idcampo => $valor){

                    //$Restore[$idcampo][valor_postado] = $valor;
                    IF ($_FILES["obrigatorio"][$idcampo] == 1){

                        IF ( empty( $_FILES["idcampoposto"][$idcampo])  ) {
                            $Erro[$idcampo][erro] = "Campo ObrigatÃ³rio";
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

                if (is_array($_FILES["idcampoposto"]["tmp_name"]))
                { 
                    foreach ($_FILES["idcampoposto"]["tmp_name"] as $key => $result)
                    {
                            if (!$result) continue;

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
                if ($_POST["idposto_anterior"]>0)
                {
                    $_GET["idposto"] = $_POST["idposto_anterior"];    
                    $_GET["lista"]="L";
                }
                
            }

            echo "<BR>  <pre>".$registering["DEBUG"]."</pre>";
    }    
    if ($_GET["amr"]==1){
        // assumir idprocesso no posto
        
        $array[$SYS_DEPARA_CAMPOS["Responsável"]][valor]  = $_SESSION["idusuariologado"];		
        $array[$SYS_DEPARA_CAMPOS["Responsável"]]["idworkflowdado"]  = $_GET["wkdaas"] ;
        $array[$SYS_DEPARA_CAMPOS["Responsável"]]["idtramitacao"]  = $_GET["H"] ;
        $array[processo][valor]  = $_GET["processo"];	
        
        if ($_GET["wkdaas"])
            $desassociar  = CallAPI("POST", $SERVER_API."Posto/Desassociar/".$_GET["idposto"] , json_encode( $array) );
        else
            $associar  = CallAPI("POST", $SERVER_API."Posto/Associar/".$_GET["idposto"] , json_encode( $array) );
        
    }
    
    switch ($_GET["lista"]){
        case("R"):
            require_once("relatorios.php");
        break;

        case("L"):
            require_once("lista.php");
        break;

        case("F"):
            require_once("form.php");
        break;
    }
}

?>
</table> 