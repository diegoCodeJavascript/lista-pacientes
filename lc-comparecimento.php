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
	<title>Lançar comparecimento</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/lccomparecimento.css">
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
  			<img src="logo.png" id="logolccomparecimento" />
  					<h2 id="titlefunc">Lançar comparecimento</h2>
  <div id="cxformpeslancarchegada">
	  	<table>
		  	  <form method="POST" action="">
		  	  	<tr>
			  	  	<th>Nome do paciente:</th><td><input type="text" name="pacnome"></td>
			  	  	<th>Data Nas:</th><td><input type="text" name="datanss"></td>
			  	</tr>
			  	<tr>
		            <th>Cartão do SUS:</th><td><input type="text" name="cardsus"></td><th>N° prontuário:</th><td><input type="text" name="noprontuario"></td>
			    </tr>
			    <button id="btnpsdados" type="submit">Pesquisar dados</button>
		  	  </form>
	  	 </table>
  </div>
 <div id="tabresultadocx">
<table id="tabpesquisadds">
	<tr>
		<th>Paciente:</th><th>Data nas:</th><th>Cartão do SUS:</th><th>N° prontuario:</th>
	</tr>

<?php
   if(isset($_POST["pacnome"])):
     //Conexao db 
     include("base.php");
   //Pg dados form
     $nome = mysqli_escape_string($con,$_POST["pacnome"]);
     $datanas = mysqli_escape_string($con,$_POST["datanss"]);
     $cartsus = mysqli_escape_string($con,$_POST["cardsus"]);
     $prontuariocd  = mysqli_escape_string($con,$_POST["noprontuario"]);
    //Tag js
     $nomeJs = htmlspecialchars($nome);
     $datanasJs = htmlspecialchars($datanas);
     $cartaosusJs = htmlspecialchars($cartsus);
     $prontarioJs = htmlspecialchars($prontuariocd);

     //Espaco remover
     $nomeEspaoco = trim($nomeJs);
     $datanasEspaco = trim($datanasJs);
     $cartaoEspaco = trim($cartaosusJs);
     $prontuarioEspaco = trim($prontarioJs);
     
     //Letras maiusculas
     $nomeMb = mb_strtoupper($nomeEspaoco);

     //Cripgrafa dados
     $nomeCrip = base64_encode($nomeMb);
     $datanasCrip = base64_encode($datanasEspaco);
     $cartaoCrip = base64_encode($cartaoEspaco);

//POO 
    class psdados{
       var $nomeclas;
       var $datanasclas;
       var $cartaosusclas;
       var $prontuarioclas;

     function psdados($nmp,$dtns,$ctcns,$codpst){
     	  $this->nomeclas = $nmp;
     	  $this->datanasclas = $dtns;
     	  $this->cartaosusclas = $ctcns;
     	  $this->prontuarioclas = $codpst;

     }
       function pesquisarreg(){
       	    //Conexao com db 
       	   include("base.php");
       	   $nomepsclas = $this->nomeclas;
       	   $datanaspsclas = $this->datanasclas;
       	   $cartsuspsclas = $this->cartaosusclas;
       	   $prontuariopsclas = $this->prontuarioclas;
           //Pesquisa dados
            $sqlPs = "SELECT * FROM pacientes WHERE nome LIKE'%$nomepsclas%' AND datanas LIKE'%$datanaspsclas%' AND 	prontuario LIKE'%$prontuariopsclas%' AND cartaosus LIKE'%$cartsuspsclas%'";
            $respesquisa  = mysqli_query($con,$sqlPs);
              while($pgdadosconsult = mysqli_fetch_row($respesquisa)):
              	  $idpaciente = $pgdadosconsult[0];
              	  $nomepacientedb = $pgdadosconsult[1];
              	  $datanasdb = $pgdadosconsult[2];
              	  $prontuariodb = $pgdadosconsult[3];
              	  $carsusdb = $pgdadosconsult[4];
                  
                  //Descrip
                  $nomeDescrip = base64_decode($nomepacientedb);
                  $datanasDescrip = base64_decode($datanasdb);
                  $cartaosusDescrip = base64_decode($carsusdb);
                print"<tr id='treslinhasd'>";
                echo"<td>$nomeDescrip</td><td>$datanasDescrip</td><td>$cartaosusDescrip</td><td>$prontuariodb</td><td><a href=lcc-selecionar.php?idcd=".urlencode($idpaciente)."><button>Selecionar</button></a></td>";
                print"</tr>";
  

              endwhile;
             print"</table>";
             print"</div>";
              
       }


  }
$pgps = new  psdados($nomeCrip,$datanasCrip,$cartaoCrip,$prontuarioEspaco);
$pgps->pesquisarreg();
//Fecha conexao db 
  include("base.php");

endif;
?>
<?php
  else:
  	  header("Location: log-erro.php");
  endif;
?>
</body>
</html>