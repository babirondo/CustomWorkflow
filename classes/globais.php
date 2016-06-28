<?php
    // configuracao de ambiente
    $usar = "windows";
    $usar = "mac";

    $usar_ambiente = "dev";
  //  $usar_ambiente = "prod";



    if ($usar_ambiente == "prod"){
      $caminho_sistema = "vagasAPI";

    }
    else if ($usar_ambiente == "dev") {
      $caminho_sistema = "CustomWorkflowAPI";
    }

    if ($usar == "windows"){
      //windows
        $SERVER_API = "127.0.0.1:8080/$caminho_sistema/";
    }
    else{
    //mac
        $SERVER_API = "localhost/$caminho_sistema/";

    }




$SYS_DEPARA_CAMPOS["Responsavel"] = -1;
$SYS_DEPARA_CAMPOS["bt_handover"] = "Salvar e Avancar >";

?>
