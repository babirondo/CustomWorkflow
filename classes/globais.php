<?php

    $usar = "windows";
if ($usar == "windows"){
  //windows
    $SERVER_API = "127.0.0.1:8080/CustomWorkflowAPI/";  
}
else{
//mac
    $SERVER_API = "localhost/CustomWorkflowAPI/";
    
}

$SYS_DEPARA_CAMPOS["Responsável"] = -1;
$SYS_DEPARA_CAMPOS["bt_handover"] = "Salvar e Avancar >";
 
?>