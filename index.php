<?php 
error_reporting(E_ALL );

require_once("classes/globais.php");
require_once("classes/diversos.php");
 // testando commit do mac 2

$retorno = CallAPI("get", $SERVER_API."getWorkflows/");

?>

<html>
	<head>
		<title></title>
	</head>
	<body>
		<table border=1 cellspacing=0 cellpadding=0  width=100% height=100%>
			<tr  height=15%>
				<td>cabecalho</td>
			</tr>
			<tr height=5%>
				<td>
					<table border=0 width=100% >
					  <tr>
					  <?php 
					  foreach ($retorno[FETCH] as $linha){
					  	echo "<TD>". $linha["workflow"]."</td>";
					  	
					  }
					  ?>
					  </tr>
					</table>
				</td>
			</tr>
			<tr height=5%>
				<td>menu</td>
			</tr>
			<tr >
				<td>corpo</td>
			</tr>
			<tr  height=10%>
				<td>footer</td>
			</tr>
		</table>
	</body>
</html>