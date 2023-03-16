<?php
  session_start();
  $_SESSION["idconta"];
  $_SESSION["login"];
  $_SESSION["nomeus"];
  $_SESSION["satusc"];

  if($_SESSION["login"] AND $_SESSION["idconta"]):

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Painel Inicial</title>
  <link rel="stylesheet" type="text/css" href="css/system-inicial.css">
  <link rel="stylesheet" type="text/css" href="css/menu-do-sistema.css">
</head>
<body>
  <div id="cxcaixamenu">
    <h1 id='txtopcsystem'>Opções do Sistema</h1>
    <a href=system-inicial.php><button id="btnpainel">Painel</button></a>
    <a href=cadastrar-pacientes.php><button id="btncadastrarpaciente">Cadastrar paciente</button></a>
    <a href=excluir-pacientes.php><button id="btnexcluirpaciente">Excluir paciente</button></a>
    <a href=lc-comparecimento.php><button id="btnlancarcomparecimento">Lançar comparecimento</button></a>
    <a href=consultar-lccomp.php><button id="btnexcluircomparecimento">Consultar comparecimento</button></a>
    <a href=consultar-cadastros.php><button id="consultarpacientes">Consultar paciente</button></a>
    
  </div>
  <a href=sair.php><button id="btnsairsistema">Sair do sistema</button></a>
  <!--Orientação ao dev/programador colocar um logo com/fundo transparente -->
  <img src="logo.png" id="logotelainicial" />
  <a href=dconfigurar-conta.php><img src="system-imagens/55699f9gcofing.jpg" id="btncofigconta" /></a>
<?php
  else:
  	  header("Location: log-erro.php");
  endif;
?>
</body>
</html>
