<?php
namespace raiz;

session_start();

error_reporting(E_ALL ^ E_NOTICE );

require_once("classes/globais.php");
require_once("classes/diversos.php");
$vida_processo = CallAPI("get", $SERVER_API."VidaProcesso/".$_GET["processo"] );

//echo "<pre>"; var_dump($vida_processo);

$cv =  $vida_processo[FETCH][$_GET["processo"] ] [ $vida_processo[ "CV"] ]  ;
//echo "<PRE>" ; var_dump($cv); exit;

$quebrado = explode("|||",$cv);
//echo "<PRE>" ; var_dump($quebrado); exit;
//$cv = base64_decode($cv);
$tempfile= $quebrado[0];
$arquivo = $quebrado[1];

header("Content-Type: application/pdf"  );
header("Content-Disposition: inline; filename=\"" . $tempfile . "\";");
echo file_get_contents('data://application/pdf;base64,'. $arquivo);
