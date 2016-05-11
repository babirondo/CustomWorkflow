<table border=1>
<?php
if ($_GET["idposto"] != null){
    if ($_GET["amr"]==1){
        // assumir idprocesso no posto

        
        $array[$SYS_DEPARA_CAMPOS["Responsável"]][valor]  = $_SESSION["idusuariologado"];		
        $array[$SYS_DEPARA_CAMPOS["Responsável"]][idworkflowdado]  = $_GET["wkdaas"] ;

        $array[processo][valor]  = $_GET["processo"];	

        $salvando_assumir = CallAPI("POST", $SERVER_API."Registrar/".$_GET["idworkflow"]."/".$_GET["idposto"] , json_encode( $array) );
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