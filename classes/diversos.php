<?php

namespace raiz;



Function ArrayMergeKeepKeys() {
 $arg_list = func_get_args();

 foreach((array)$arg_list as $arg){
   if (is_array ($arg) )
   {
     foreach((array)$arg as $K => $V){
         $Zoo[$K]=$V;
     }
   }
 }
 return $Zoo;
}

function link_download($processo){
  $link ="<a href='download.php?campo=cv&processo=$processo' target='_blank'>Download</a>";

  return $link;
}

function match_candidato_vaga($nota){
  if ($nota > 80) $retorno = "<font color=blue>". round(  $nota). " %</font>";
  else if ($nota > 55) $retorno = "<font color=yellow>". round(  $nota). " %</font>";
  else if ($nota > 35) $retorno = "<font color=orange>". round(  $nota). " %</font>";
  else  $retorno = "<font color=red>". round(  $nota). " %</font>";

  return   ( $retorno ) ;
}

 function CallAPI($method, $url, $data = false, $verbose=1)
 {

 	GLOBAL $usar_ambiente;
 	$curl = curl_init();

	//$verbose = 1;
 	if ($usar_ambiente == "prod") $verbose = 0;

 	switch ($method)
 	{
 		case "POST":
 			curl_setopt($curl, CURLOPT_POST, 1);

 			if ($data){
 				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
 				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
 			}
  			if ($verbose) echo " <BR> curl -H 'Content-Type: application/json' -X POST -d '$data' $url  ";
 			break;
 		case "PUT":
 			curl_setopt($curl, CURLOPT_PUT, 1);
 if ($verbose) echo " <BR> curl -H 'Content-Type: application/json' -X POST -d '$data' $url  ";

 			break;
 		default:
  			if ($verbose) echo " <BR>   $url  ";

     if ($data)
             $url = sprintf("%s?%s", $url, http_build_query($data));
 	}

 	// Optional Authentication:
 	//curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 	//curl_setopt($curl, CURLOPT_USERPWD, "username:password");



 	curl_setopt($curl, CURLOPT_URL, $url);
 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

 	$result = curl_exec($curl);

 	curl_close($curl);

 	return  json_decode( $result , true);
 }

?>
