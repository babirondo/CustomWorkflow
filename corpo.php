<table border=1>
<?php
if ($_GET["idposto"] != null){
    if ($_GET["amr"]==1){
        // assumir idprocesso no posto
        
        $array[$SYS_DEPARA_CAMPOS["Respons�vel"]][valor]  = $_SESSION["idusuariologado"];		
        $array[$SYS_DEPARA_CAMPOS["Respons�vel"]]["idworkflowdado"]  = $_GET["wkdaas"] ;
        $array[processo][valor]  = $_GET["processo"];	
        
        if ($_GET["wkdaas"])
            $desassociar  = CallAPI("POST", $SERVER_API."Posto/Desassociar/".$_GET["idposto"] , json_encode( $array) );
        else
            $associar  = CallAPI("POST", $SERVER_API."Posto/Associar/".$_GET["idposto"] , json_encode( $array) );
    }
    
    switch ($_GET["lista"]){
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