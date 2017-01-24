<?php
namespace raiz;
session_start();
error_reporting(E_ALL ^ E_NOTICE );

require_once("classes/globais.php");
require_once("classes/diversos.php");
 // testando commit do mac 2




if ( $_POST["solicitaracesso"] == 1){
	$array[nome] = $_POST["nome"];
	$array[login] = $_POST["login"];
	$array[email] = $_POST["email"];
	$array[timeatual] = $_POST["timeatual"];

	$auth = CallAPI("POST", $SERVER_API."SolicitarAcesso/"  , json_encode( $array) );

	if ($auth["resultado"] == "SUCESSO"){

		$msg=  "Você receberá seus dados de acesso por email";
	}
	else
		$msg = $auth["erro"];



}



?>

<html>
	<head>
		<title></title>
	</head>
	<body>


		<table border=1 cellspacing=0 cellpadding=0  width=100% height=100%>
			<form action="<?=$_SERVER["PHP_SELF"];?>" method=post>
				<input type=hidden name=solicitaracesso value=1>
			<tr height=5%>
				<td>
					<table border=0	width=30% align=center>
						<tr>
					 		<td>Nome:</td>
					 		<td> <input type=text name=nome ></td>
					  </tr>
						<tr>
					 		<td>Email :</td>
					 		<td> <input type=text name=email value='@walmart.com'></td>
					  </tr>

					  <tr>
					 		<td>Login de Rede:</td>
					 		<td> <input type=text name=login ></td>
					  </tr>

						<tr>
					 		<td>Time Atual:</td>
					 		<td> <input type=text name=timeatual > Exemplo: Checkout</td>
					  </tr>

						<tr>
					 		<td> </td>
						  <td> <input type=submit value="Solicitar Acesso" ></td>
					  </tr>
					  <tr>
					 		<td> </td>
					 		<td> <font color=#ff0000><?=$msg; ?></font> </td>
					  </tr>
					</table>
				</td>
			</tr>
			</form>

		</table>
	</body>
</html>
