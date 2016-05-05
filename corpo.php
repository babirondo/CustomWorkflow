<table border=1>
<?php
if ($_GET["idposto"] > 0){
	
	if ($_GET["lista"]==1)
	{
		require_once("lista.php");
	
	}
	else
	{
		require_once("form.php");
	
	
	}
	
}

?>
</table> 