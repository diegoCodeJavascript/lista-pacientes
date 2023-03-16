<?php
  session_start();
  $_SESSION["idconta"];
  $_SESSION["login"];
  $_SESSION["nomeus"];
  $_SESSION["satusc"];

  if($_SESSION["login"] AND $_SESSION["idconta"]):
   $idconta = $_SESSION["idconta"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Configuração da conta</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu-do-sistema.css">
	<link rel="stylesheet" type="text/css" href="css/telacofigconta.css">
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
  <?php
      //Conexao db 
       include("base.php");
     $sqlCadastroFuncionarios = "SELECT * FROM colaboradores WHERE coduser='$idconta'";
     $rescadastro = mysqli_query($con,$sqlCadastroFuncionarios);
        while($pgcom = mysqli_fetch_row($rescadastro)):
        	    $idcontadb = $pgcom[0];
        	    $cpflogin = $pgcom[1];
        	    $senhadb = $pgcom[2];
                $nomedb = $pgcom[3];
                $sobrenomedb = $pgcom[4];
                $emaildb = $pgcom[5];
                $satusLogin = $pgcom[6];

               //Descrip informação
                $cpfDescrip = base64_decode($cpflogin);
                $senhaDescrip = base64_decode($senhadb);
                $emailCrip = base64_decode($emaildb);

        endwhile

  ?>
  <h2 id="dadoscolaborador">Configurar dados/Colaborador(a)</h2>
  <div id="formcadastrocolaborador">
  	<table>
	  	  <form method="POST" action="">
	  	  	<tr>
	  	  	  <th>Nome:</th><td><input type="text" name="nomep" value="<?php echo $nomedb  ?>" required></td>
	  	  	  <th>Sobrenome:</th><td><input type="text" value="<?php echo $sobrenomedb ?>" name="sobrenome"></td>
	  	  	 </tr>
	  	  	 <tr>
	  	  	 	<th>CPF/Login:</th><td><input type="text" value="<?php echo $cpfDescrip ?>" name="logincpf"></td>
	  	  	 	<th>Nova senha:</th><td><input type="password" name="senhaend"></td>
	  	  	 </tr>
	  	  	 <tr>
	  	  	 	<th>E-mail:</th><td><input type="text" name="emailend" value="<?php echo $emailCrip ?>"></td>
	  	  	 </tr>
	  	  	 <button type="submit" id="btnatualizar">Atualizar cadastro</button>
	  	  </form>
  	 </table>
  </div>
<?php
  if(isset($_POST["nomep"])):
     //Pega dados form
  	$nomefm = mysqli_escape_string($con,$_POST["nomep"]);
  	$sobrenomefm = mysqli_escape_string($con,$_POST["sobrenome"]);
  	$loginfm = mysqli_escape_string($con,$_POST["logincpf"]);
  	$senhafm = mysqli_escape_string($con,$_POST["senhaend"]);
    $emailfm = mysqli_escape_string($con,$_POST["emailend"]);
  	//Tag espaco
  	$nomeEspaco = trim($nomefm);
  	$sobrenomeEspaco = trim($sobrenomefm);
  	$loginEspaco = trim($loginfm);
  	$senhaEspaco = trim($senhafm);
  	$emailEspaco = trim($emailfm);

  	//TagJs 
  	$nomeJS = htmlentities($nomeEspaco);
  	$sobrenomeJs = htmlentities($sobrenomeEspaco);
  	$loginJs = htmlentities($loginEspaco);
  	$senhaJs = htmlentities($senhaEspaco);
  	$emailJs = htmlentities($emailEspaco);
    
    //Deixa caractes maiusculos
    $nomeMn = mb_strtoupper($nomeJS);
    $sobrenomeMn = mb_strtoupper($sobrenomeJs);
    $loginMn = mb_strtoupper($loginJs);
    $senhaMb = mb_strtoupper($senhaJs);
     //E-mail Minusculo caractes
    $email = mb_strtolower($emailJs,"utf-8");
    //Crip dados 
    
    
    $loginCrip = base64_encode($loginMn);
    $senhaCrip = base64_encode($senhaMb);
    $emailCrip = base64_encode($email);

   //Atualiza dados no db
      //Procedural programação
    $sqlUpdados  = "UPDATE colaboradores SET senha='$senhaCrip',nome='$nomeMn',sobrenome='$sobrenomeMn',email='$emailCrip' WHERE coduser='$idconta'";
    $upres  = mysqli_query($con,$sqlUpdados);

   if($upres):
         print"<div id='cxnotificar'>";
         echo"<img src='system-imagens/55f9fg.png' id='iluscxnotifc'/>";
         echo"<a href=system-inicial.php><img src='system-imagens/btnffxc.png' id='btnfecharmd'/></a>";
         echo"<h2 id='tlcxnotifc'>Banco de dados </h2>";
         echo"<h3 id='subtitulontfc'>Dados atualizado!</h3>";
        print"</div>";
      
      else:
      print"<div id='cxnotificar'>";
         echo"<img src='system-imagens/55f9fg.png' id='iluscxnotifc'/>";
         echo"<a href=system-inicial.php><img src='system-imagens/btnffxc.png' id='btnfecharmd'/></a>";
         echo"<h2 id='tlcxnotifc'>Banco de dados </h2>";
         echo"<h3 id='subtitulontfc'>Erro desconhecido!</h3>";
        print"</div>";
   endif;





  endif;

?>
<?php
  else:
  	  header("Location: log-erro.php");
  endif;
?>
</body>
</html>