<?php
namespace raiz;

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

$menus = CallAPI("get", $SERVER_API."getMenus/");



//FIXME: Resolver navegacao entre variaveis workflow e menu, usando os 2 no comeco mas é pra tirar o workflow

// listando postos do workflow
if ( $_GET["idworkflow"] > 0  ){
//	$idworkflow = $_GET["idworkflow"] = $_GET["irpara"];
	$array=null;
	$array[idusuario] = $_SESSION["idusuariologado"];
	$postos = CallAPI("POST", $SERVER_API.$_GET["idworkflow"]."/getPostos/", json_encode( $array));
	$array=null;
}
else if ( $_GET["tipodestino"] == "item"  ){
//	$idworkflow = $_GET["idworkflow"] = $_GET["irpara"];
	$array=null;
	$array[idusuario] = $_SESSION["idusuariologado"];
	$submenus = CallAPI("POST", $SERVER_API."getSubMenus/".$_GET["idmenu"], json_encode( $array));
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
								<td>cabecalho  <h1><font color=red> <?=$usar_ambiente;?> </h1></font> </td>
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
					  foreach ($menus[FETCH] as $linha){
							switch ($linha["tipodestino"])
							{
									case("workflow"):
										echo "<TD> <a href='$PHP_SELF?tipodestino=". $linha["tipodestino"]."&idworkflow=". $linha["irpara"]."&idmenu=". $linha["idmenu"]."&irpara=". $linha["irpara"]."'>". $linha["menu"]."</a></td>";

									break;
									default:
										echo "<TD> <a href='$PHP_SELF?tipodestino=". $linha["tipodestino"]."&idmenu=". $linha["idmenu"]."&irpara=". $linha["irpara"]."'>". $linha["menu"]."</a></td>";
							}
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
						if (is_array($postos[FETCH]))
						{
  					  foreach ($postos[FETCH] as $linha){
								//FIXME: gambiarra pra fazer o idprocesso ser igual ao idusuario se o workflow for do tipo de cmapo simples, myprofile
								if ( $_GET["idworkflow"] == 26) $complemento_processo_igual_idusuario = "&processo=".$_SESSION["idusuariologado"];
						  	echo "<TD> <a href='$PHP_SELF?idmenu=".$_GET["idmenu"].$complemento_processo_igual_idusuario."&idworkflow=".$_GET["idworkflow"]."&lista=". $linha["lista"]."&idposto=". $linha["idposto"]."'>". $linha["posto"]."</a></td>";

						  }
						}
						if (is_array($submenus[FETCH]))
						{
  					  foreach ($submenus[FETCH] as $linha){
						  	echo "<TD> <a href='$PHP_SELF?processo=".$_SESSION["idusuariologado"]."&tipodestino=".$_GET["tipodestino"]."&idmenu=".$_GET["idmenu"]."&idfeature=". $linha["irpara"]."'>". $linha["menu"]."</a></td>";
						  }
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
$chama_cron = CallAPI("get", $SERVER_API."cron.php");
?>
