<?php
namespace raiz;

session_start();


if ($_GET["offline"]==1){


	session_destroy();
	define("OFFLINE",     1);
}
else {

		define("OFFLINE",    0);
}

if (!$_SESSION["idusuariologado"] && !OFFLINE)
{
	header("Location: login.php");
}
else if ($_SESSION["idusuariologado"] > 0 || OFFLINE)
{

	error_reporting(E_ALL ^ E_NOTICE );

	require_once("classes/globais.php");
	require_once("classes/diversos.php");
	// testando commit do mac 2

	$usuario_logado_array["idusuario"] = $_SESSION["idusuariologado"];

	$menus = CallAPI("POST", $SERVER_API."getMenus/",  json_encode( $usuario_logado_array) );

	//FIXME: Resolver navegacao entre variaveis workflow e menu, usando os 2 no comeco mas é pra tirar o workflow
	if ($_GET["idmenu"] >0){

		switch ($menus["FETCH"][$_GET["idmenu"]]["tipodestino"])
		{
			case("workflow"):
			// listando postos do workflow

			//carregando submenu, caso workflow
			$array=null;
			$array[idusuario] = $_SESSION["idusuariologado"];
			$_GET["idworkflow"] = $menus["FETCH"][$_GET["idmenu"]]["irpara"];
			//FIXME: _get associando na gambiarra....
			$postos = CallAPI("POST", $SERVER_API.$_GET["idworkflow"]."/getPostos/", json_encode( $array));
			$array=null;

			break;

			default:
			$array=null;
			$array[idusuario] = $_SESSION["idusuariologado"];
			$submenus = CallAPI("POST", $SERVER_API."getSubMenus/".$_GET["idmenu"], json_encode( $array));
			$array=null;
		}


	}

	?>

	<html>
	<head>
		<title>[Walmart.com] Processo de Recrutamento e Seleção</title>
		<link rel="stylesheet" type="text/css" href="grid.css" />
		<link rel="stylesheet" type="text/css" href="home.css" />
		<link rel="stylesheet" type="text/css" href="form.css" />
	</head>

	<body class=home>
		<table class=tablehome>
			<tr class=cabecalho>
				<td>
				<?php
				if (!OFFLINE){
				?>
					<table>
						<tr>
							<td class=server_ambiente>   <?=$usar_ambiente;?> </td>

							<td class=usuariologado>
								Usuário Logado: <?=$_SESSION["usuariologado"];?><BR>
									<a href='logout.php'>Logout</a>
								</td>
							</tr>
					</table>
					<?php
				}
					?>
				</td>
		</tr>

		<tr class=menu>
			<td>
				<table  >
					<tr>
						<?php
						if (is_array($menus)){
							foreach ($menus[FETCH] as $linha){

								echo "<TD> <a class=botao href='$PHP_SELF?idmenu=". $linha["idmenu"]."' >". $linha["menu"]."</a></td>";

							}

						}
						?>
					</tr>
				</table>
			</td>
		</tr>

		<tr  class=submenu>
			<td>
				<table  >
					<tr>
						<?php
						if (is_array($postos[FETCH]))
						{
							foreach ($postos[FETCH] as $linha){
								//FIXME: gambiarra pra fazer o idprocesso ser igual ao idusuario se o workflow for do tipo de cmapo simples, myprofile
								//if ( $_GET["idworkflow"] == 26) $complemento_processo_igual_idusuario = "&processo=".$_SESSION["idusuariologado"];
								echo "<TD> <a class=subbotao href='$PHP_SELF?idmenu=".$_GET["idmenu"]."&idworkflow=".$_GET["idworkflow"]."&lista=". $linha["lista"]."&idposto=". $linha["idposto"]."'>". $linha["posto"]."</a></td>";

							}
						}
						if (is_array($submenus[FETCH]))
						{
							foreach ($submenus[FETCH] as $idsubmenu => $linha){
								echo "<TD> <a href='$PHP_SELF?idmenu=".$_GET["idmenu"]."&idfeature=". $idsubmenu."'>". $linha["menu"]."</a></td>";
							}
						}


						?>
					</tr>
				</table>
			</td>
		</tr>

		<tr class=corpo>
			<td><?=require_once("corpo.php")?></td>
		</tr>

	</table>
 </body>
</html>
<?php
	} // usuario logado
//$chama_cron = CallAPI("get", $SERVER_API."cron.php");
?>
