<?php
namespace raiz;
?>
<table  width=100% border=1>
<?php

require_once("regras_negocio.php");

// POSTO exclusivo do workflow
if ($_GET["idposto"] != null){
    // so WORKFLOW legado


      if ($_POST["aplicar_candidatos"]==1)
      {
            // salvando dados do form
           $retorno = AplicarCandidatos($_POST, $_FILES, $_GET);

           $Restore  = $retorno[RESTORE]  ;
           $_GET = $retorno[GET]  ;
           $msg  = $retorno[MSG] ;
           $Erro = $retorno[ERRO] ;
      }

      if ($_POST["processar"]==1)
      {
            // salvando dados do form
           $retorno = SalvarDados($_POST, $_FILES, $_GET);

           $Restore  = $retorno[RESTORE]  ;
           $_GET = $retorno[GET]  ;
           $msg  = $retorno[MSG] ;
           $Erro = $retorno[ERRO] ;
      }


    if ($_GET["amr"]==1){
        // assumir idprocesso no posto
        $retorno = Associar($_POST, $_FILES, $_GET);

        $Restore  = $retorno[RESTORE]  ;
        $msg  = $retorno[MSG] ;
        $Erro = $retorno[ERRO] ;
    }

    switch ($_GET["lista"]){
        case("R"):
            require_once("relatorios.php");
        break;

        case("L"):
            require_once("lista.php");
        break;

        case("Agrupado"):
            require_once("lista.agrupada.php");
        break;

        case("F"):
            require_once("form.php");
        break;

        case("VagaXCandidato"):
            require_once("lista.vaga.por.candidato.php");
        break;

        case("ListarCandidatos"):
            require_once("listar.candidatos.php");
        break;

        default:
            echo "workflow - Não achou nenhum lista";
    }
} // fim do fluco de workflow


// TRATANDO FUNCOES DA ENGINE
if ($_GET["idfeature"] > 0){
  //var_dump($_REQUEST);

    if ($_GET["idmenu"] == 11){
   //FIXME: gambiarra master pra ver se funciona rapidao
      $_GET["processo"] = $_SESSION["idusuariologado"];
    }

    if ($_POST["processar"]==1)
    {
          // salvando dados do form - caso engine
         $retorno = SalvarDadosEngine($_POST, $_FILES, $_GET);

         $Restore  = $retorno[RESTORE]  ;
         $_GET = $retorno[GET]  ;
         $msg  = $retorno[MSG] ;
         $Erro = $retorno[ERRO] ;
    }

/*
// FALTA CRIAR FUNCAO DE ASSOCIAR PARA O ENGINE
  if ($_GET["amr"]==1){
      // assumir idprocesso no posto
      $retorno = Associar($_POST, $_FILES, $_GET);

      $Restore  = $retorno[RESTORE]  ;
      $msg  = $retorno[MSG] ;
      $Erro = $retorno[ERRO] ;
  }
*/

  $dados_feature = CallAPI("GET", $SERVER_API."Engine/".$_GET["idfeature"] );


  switch ($dados_feature["DADOS_FEATURE"] ["lista"]){
      case("L"):
          require_once("engine/lista.php");
      break;

      case("F"):
          require_once("engine/form.php");
      break;

      default:
        echo "nao achou nada";
  }

}

?>
</table>
