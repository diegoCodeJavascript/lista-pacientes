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
	<title>Excluir paciente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/procssexcluir-paciente.css">

</head>
<body>
	<?php
       //Pega conexao db 
	  include("base.php");
	 $codpcn = mysqli_escape_string($con,$_GET["idcds"]);
	 //tira espaço 
	 $codpcn_espaco= trim($codpcn);
	 //TagJs 
	 $codpcn_js = htmlspecialchars($codpcn_espaco);
      //Cod excluir dados do banco de dados
	  $sqlExcluir = "DELETE FROM pacientes WHERE idr='$codpcn_js'";
	  $sqlResexcluir = mysqli_query($con,$sqlExcluir);
	       if($sqlResexcluir):
	       	  $msgdel = "Dados deletado!";
	       	else:
	       		//Caso tenha falha de conexao com servidor.
	       		//Evite um erro.
	       		$msgdel="Erro ao deletar!";
	       endif;
    ?>
   <div id='cxalertmsg'>
   	   <img src="system-imagens/55f9fg.png" id="ilusalert"/>
   	   <a href=system-inicial.php><img src="system-imagens/btnffxc.png" id="btnfcmd" /></a>
   	   <h3 id='msgbancotit'>Banco de dados</h3>
   	   <h4 id='msgstatusprocesso'><?php echo $msgdel; ?></h4>

 </div>
<?php
  else:
  	  header("Location: log-erro.php");
  endif;
?>   
</body>
</html>