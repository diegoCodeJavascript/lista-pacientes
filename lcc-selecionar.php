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
	<title>Cadastro selecionado</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/cadastro-selecionadofm.css">
</head>
<body>
	<?php
      //conexao db 
	   include("base.php");
	    //Pega cod cadastro
	    $codcadastro  = mysqli_escape_string($con,$_GET["idcd"]);
	    //Tira espaco 
	    $codespaco = trim($codcadastro);
	    //Tag js 
	    $codJs = htmlspecialchars($codespaco);

	
    
     	 //Pesquisar no banco de dados
     	 $sqlPs = "SELECT * FROM pacientes WHERE idr='$codJs'";
     	 $resPs = mysqli_query($con,$sqlPs);
     	   while($pgconsultadb = mysqli_fetch_row($resPs)):
     	   	  $nomepacientedb = $pgconsultadb[1];
     	   	  $datanasdb = $pgconsultadb[2];
     	   	  $prontuariodb = $pgconsultadb[3];
     	   	  $cartaosusdb = $pgconsultadb[4];
     	   	  $celulardb = $pgconsultadb[6];
     	   	  $ruadb = $pgconsultadb[8];
     	   	  $bairrodb = $pgconsultadb[9];
     	   	  $cidadedb = $pgconsultadb[10];
     	   	  $numeroend = $pgconsultadb[12];

     	   	 //Descrip infor
     	   	  $nomeDescrip = base64_decode($nomepacientedb);
     	   	  $datansDescrip = base64_decode($datanasdb);
     	   	  $cartaosusDescrip = base64_decode($cartaosusdb);
            $celularDescrip = base64_decode($celulardb);
            $ruaDescript = base64_decode($ruadb);
            $bairroDescript = base64_decode($bairrodb);
            

              endwhile;



	?>
	<img src="logo.png" id="logotelaselecao" />
	 <h2 id='tituloselecao'>Cadastro selecionado</h2>
	 
   <div id='cxformlancarchegada'>
   	<table>
   	<form method="POST" action="">
   		<tr>
   			<tr>
        	<th>Paciente:</th><td><input type="text" name="pacientenome" value="<?php echo $nomeDescrip ?>"></td><th>Data nas:</th><td><input type="text" name="datanas" value="<?php echo $datansDescrip ?>"></td>
        </tr>
   			<th>Hora Chegada:</th><td><input type="time" name="horaschegada"></td>
   			<th>Prontuário n°:</th><td><input type="text" name="numprontuario" value="<?php echo $prontuariodb ?>"></td>
   		</tr>
        
   	</table>
   	<button type="submit" id="btngravar">Gravar informação</button>
   	</form>
 </div>
<?php
   if(isset($_POST["pacientenome"])):
   	   $horachegada = mysqli_escape_string($con,$_POST["horaschegada"]);
   	   $dataatual = date("d/m/Y H:i");
   	   //Salva chegada
   	   $sqlChegada = "INSERT INTO chegadac VALUES(Null,'$nomeDescrip','$prontuariodb','$horachegada','$dataatual')";
   	   $reschegada = mysqli_query($con,$sqlChegada);
   	     //Após confirmar exibe um modal
   	   if($reschegada):
   	   	    print"<div id='cxmodalt'>";
   	   	    echo"<img src='system-imagens/55f9fg.png' id='ilusmodalc'/>";
   	   	    echo"<h3 id='titlmda'>Presença confirmada!</h3>";
   	   	    echo"<a href=system-inicial.php><img src='system-imagens/btnffxc.png' id='btnfehcarmd'/></a>";
   	   	    print"<div>";
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