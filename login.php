<?php
namespace raiz;
session_start();
error_reporting(E_ALL ^ E_NOTICE );

require_once("classes/globais.php");
require_once("classes/diversos.php");
 // testando commit do mac 2


if ($_GET["msg"]) $erro = $_GET["msg"];

if ( $_POST["logar"] == 1){
	$array[login] = $_POST["login"];
	$array[senha] = $_POST["senha"];

	$auth = CallAPI("POST", $SERVER_API."Autenticar/"  , json_encode( $array) );

	if ($auth["resultado"] == "SUCESSO"){

		$_SESSION['idusuariologado']= $auth["id"];
		$_SESSION['usuariologado']= $auth["nome"];
	}
	else
		$erro = $auth["erro"];



}

if ( $_SESSION["idusuariologado"] > 0){

	header("Location: index.php");
}

?>

<html>
	<head>
		<title></title>
	</head>
	<body>


		<table border=1 cellspacing=0 cellpadding=0  width=100% height=100%>
			<form action="<?=$_SERVER["PHP_SELF"];?>" method=post>
				<input type=hidden name=logar value=1>
			<tr height=5%>
				<td>
					<table border=0	width=30% align=center>
						<tr>

							<td colspan=10 align=center> <font color=#0000ff><h3><?=(($usar_ambiente)?"$usar_ambiente":"Não Conectado"); ?></h3></font> </td>
						</tr>

					  <tr>
					 		<td>Login</td>
					 		<td> <input type=text name=login ></td>

					  </tr>
					  <tr>
					 		<td>Senha</td>
					 		<td> <input type=password name=senha ></td>
							  <td> <input type=submit value="Logar" ></td>
					  </tr>
					  <tr>
					 		<td><BR><a href='index.php?offline=1&idfeature=18'>Solicitar acesso</a> </td>

					  </tr>

					  <tr>
					 		<td> </td>
					 		<td> <font color=#ff0000><?=$erro; ?></font> </td>
					  </tr>
					</table>
				</td>
			</tr>
			</form>

		</table>
	</body>
</html>
