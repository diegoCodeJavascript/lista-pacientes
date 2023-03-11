<?php
  session_start();
  $_SESSION["cadastroinformacao"];
  $codsessao = $_SESSION["cadastroinformacao"];


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Informações Cadastro</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/tela-informacao-cadastro.css">
</head>
<body>
	<?php
      if($codsessao == "5650A"):
      	$msg = "Este CPF, já possuí um Login!";

      elseif($codsessao == "5ckja00"):
         $msg = "Login criado com sucesso!";
        elseif($codsessao == "d84d"):
       $msg = "Erro no servidor!";
      endif
	?>
 <div id="telainformacao">
 	  <img src="system-imagens/55f9fg.png" id="imilustraratencao" />
      <h2 id="tituloatencao">Atenção !</h2>
      <p id="msgdetalhes"><?php echo $msg ?></p>
    <a href=index.html><button id="btntelalogin">Tela de login</button></a>
    <button onclick="history.back()" id='btnmodificar'>Modificar cadastro?</button>
 </div>
</body>
</html>