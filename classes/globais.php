<?php
namespace raiz;
require_once("classes/diversos.php");


    $SYS_conf = CallAPI("GET", "localhost/CustomWorkflowAPI/"."getConfs/" );


    // configuracao de ambiente
    $banco = $SYS_conf["banco"];
    $sourcecode = $SYS_conf["sourcecode"];
    $environment = $SYS_conf["environment"];
    $verbose = $SYS_conf["verbose"];

    if ($sourcecode == "prod"){
        $caminho_sistema = "vagasAPI";

    }
    else if ($sourcecode == "local") {
        $caminho_sistema = "CustomWorkflowAPI";
    }

    if ($banco == "prod"){
    //  $caminho_sistema = "vagasAPI";

    }
    else if ($banco == "dev") {
    //  $caminho_sistema = "CustomWorkflowAPI";
    }

    if ($environment == "windows"){
      //windows
        $SERVER_API = "127.0.0.1:8080/$caminho_sistema/";
    }
    else if ($environment == "mac"){
    //mac
        $SERVER_API = "localhost/$caminho_sistema/";

    }
    else if ($environment == "mac-docker"){

        $SERVER_API = "localhost:10080/$caminho_sistema/";

    }
    $usar_ambiente = "Source: $sourcecode, BD: $banco, server: $SERVER_API, verbose: $verbose";

$SYS_DEPARA_CAMPOS["Responsavel"] = -1;
$SYS_DEPARA_CAMPOS["bt_handover"] = "Salvar e Avancar >";

?>
