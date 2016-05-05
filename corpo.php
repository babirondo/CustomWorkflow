<table border=1>
<?php
if ($_GET["idposto"] > 0){
	
	if ($_GET["lista"]=="L")
	{
		require_once("lista.php");
	
	}
	else if ($_GET["lista"]=="F")
	
	{
		require_once("form.php");
	
	
	}
	
}

?>
</table> 