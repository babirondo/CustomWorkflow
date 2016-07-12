<?php
namespace raiz;
require_once("classes/globais.php");
require_once("classes/diversos.php");

$vida_processo = CallAPI("get", $SERVER_API."VidaProcesso/".$_GET["idprocesso"] );
?>
<HTML>
  <HEAD>
    <TITLE>Detalhes do Processo</TITLE>
  </HEAD>
  <BODY>
    <TABLE BORDER=1>
<?php
foreach ( $vida_processo["FETCH_POSTO"] as $idposto => $conteudo_posto)
{
  echo "<tr>
            <td>Posto</td>
            <td><b>$idposto</b></td>
        </tr> ";
        $exibir=null;
        foreach ($conteudo_posto[$_GET["idprocesso"]] as $campo => $valor )
        {
          if ($campo == "tramitacao_idusuario") continue;
          if ($campo == "-1") continue;
          if ($campo == "12-original") continue;
          if ($campo == "-1-ID") continue;
          if ($campo == "inicioprocesso") continue;
          if ($campo == "idworkflowtramitacao") continue;
          if ($campo == "atoresdoposto") continue;

          $exibir[$campo] = $valor;
        }

        $p=0;
        foreach ($exibir as $campo => $valor){
          if ($p == 0) echo "<tr>";
          echo "<td>$campo</td>";
          echo "<td>$valor</td>";
          $p++;
          if ($p == 3) {
              echo "</tr>";
              $p=0;
          }
        }
}

//echo "<pre>"; var_dump($vida_processo["FETCH_POSTO"]); echo "</pre>";
?>
   </TABLE>
  </BODY>
</HTML>
