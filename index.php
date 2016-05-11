<?php
 

session_start();

if (!$_SESSION["idusuariologado"])
{
	header("Location: login.php");
}
else if ($_SESSION["idusuariologado"] > 0 )  
{

error_reporting(E_ALL ^ E_NOTICE );

require_once("classes/globais.php");
require_once("classes/diversos.php");
 // testando commit do mac 2

$retorno = CallAPI("get", $SERVER_API."getWorkflows/");
if ($_GET["idworkflow"] > 0){
	$array=null;
	$array[idusuario] = $_SESSION["idusuariologado"]; 
	$postos = CallAPI("POST", $SERVER_API.$_GET["idworkflow"]."/getPostos/", json_encode( $array));
	$array=null;
}

?>

<html>
	<head>
		<title></title>
	</head>
	<body>
		<table border=1 cellspacing=0 cellpadding=0  width=100% height=100%>
			<tr  height=15%>
				<td>
					<table border=0 width=100%>
						<tr>
							<td>cabecalho</td>
							<td align=right>
                                                            Usuário Logado: <?=$_SESSION["idusuariologado"];?><BR>
                                                            <a href='logout.php'>Logout</a>
                                                        </td>
						</tr>
					</table>
				</td>
				  
			</tr>
			<tr height=5%>
				<td>
					<table border=0 width=100% >
					  <tr>
					  <?php 
					  foreach ($retorno[FETCH] as $linha){
					  	echo "<TD> <a href='$PHP_SELF?idworkflow=". $linha["idworkflow"]."&idposto=". $linha["postoinicial"]."'>". $linha["workflow"]."</a></td>";
					  	
					  }
					  ?>
					  </tr>
					</table>
				</td>
			</tr>
			<tr height=5%>
				<td>
					<table border=0 width=100% >
					  <tr>
					  <?php 
					  foreach ($postos[FETCH] as $linha){
					  	echo "<TD> <a href='$PHP_SELF?idworkflow=".$_GET["idworkflow"]."&lista=". $linha["lista"]."&idposto=". $linha["idposto"]."'>". $linha["posto"]."</a></td>";
					  	
					  }
					  ?>
					  </tr>
					</table>
				</td>
			</tr>
			<tr >
				<td><?=require_once("corpo.php")?></td>
			</tr>
			 
		</table>
	</body>
</html>
<?php
} // usuario logado
?>