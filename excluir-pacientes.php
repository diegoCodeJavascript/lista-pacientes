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
	<title>Excluir - pacientes</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/excluir-pacientes.css">
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
    <!--Orientação ao dev/programador colocar um logo com/fundo transparente -->
  <img src="logo.png" id="logotelaexcluirpaciente" />
   <h3 id="tituloexcluir">Excluir paciente:</h3>
  
  <div id="cxformpesquisaexcluir">
  	<table>
  		<form method="POST" action="">
  	     <tr>
  	     	<th>Nome:</th><td><input type="text" name="nomepc"></td><th>Celular:</th><td><input type="text" name="celular"></td>
  	     </tr>
  		<tr>
  			<th>N° Cartão do SUS:</th><td><input type="text" name="cnsnumero"></td><th>Data de Nas:</th><td><input type="text" name="dtnas"></td>
  		</tr>
  		  <button id="btnpesreg" type="submit">Pesquisar Registro</button>
  		</form>
  	</table>
  </div>
  <div id="tabcxpsexcluir">

  <table id='tabpgresult'>
      <tr>
        <th>Paciente:</th><th>CNS N°:</th><th>Data nas:</th><th>Cartão Convênio:</th><th>Celular do paciente:</th>
      </tr>
  		
  	
  
 <?php
     if(isset($_POST["nomepc"])):
     	  //Conexao db 
     	   include("base.php");
     	$nome  = mysqli_escape_string($con,$_POST["nomepc"]);
     	$numerocel = mysqli_escape_string($con,$_POST["celular"]);
     	$cnsn = mysqli_escape_string($con,$_POST["cnsnumero"]);
        $dtnas =  mysqli_escape_string($con,$_POST["dtnas"]);

        //tira espaco 
        $nome_espaco = trim($nome);
        $numerocel_espaco = trim($numerocel);
        $cns_espaco = trim($cnsn);
        $dtnas_espaco = trim($dtnas);

        //Tag Js
        $nome_js = htmlspecialchars($nome_espaco);
        $numerocel_js = htmlspecialchars($numerocel_espaco);
        $cns_js = htmlspecialchars($cns_espaco);
        $dtnas_js = htmlspecialchars($dtnas_espaco);

        //Letras Maiusculas
        $nomeMn = mb_strtoupper($nome_js,"utf-8");

        //Criptografa os dados
        $nomeCrip = base64_encode($nomeMn);
        $celularCrip = base64_encode($numerocel_js);
        $dtnascrip = base64_encode($dtnas_js);
        $cardsusCrip = base64_encode($cns_js);

 //POO pg cadastros
 class pgregistros{
 	  var $nomeclas;
 	  var $datanasclas;
 	  var $cartaosusclas;
 	  var $celularclas;

    function pgregistros($nm,$dtn,$cns,$cel){
          $this->nomeclas = $nm;
          $this->datanasclas= $dtn;
          $this->cartaosusclas = $cns;
          $this->celularclas = $cel;


    }
    
    function pesquisardbase(){
    	  //Conexao db
    	include("base.php");
    	$nomePsclas = $this->nomeclas;
    	$dataPsclas = $this->datanasclas;
    	$cartaosusPsclas = $this->cartaosusclas;
    	$celularPsclas = $this->celularclas;

          //Faz a consulta banco de dados
    	$sqlPesquisa = "SELECT * FROM pacientes WHERE nome LIKE'%$nomePsclas%' AND datanas LIKE'%$dataPsclas%' AND cartaosus LIKE'%$cartaosusPsclas%' AND celularp LIKE'%$celularPsclas%'";
    	$sqlPes = mysqli_query($con,$sqlPesquisa);
    	    while($pgps =  mysqli_fetch_row($sqlPes)):
    	    	  $idpaciente = $pgps[0];
    	    	  $nomedb = $pgps[1];
    	    	  $datanasdb = $pgps[2];
    	    	  $prontuariodb  = $pgps[3];
    	    	  $cartaosusdb = $pgps[4];
    	    	  $cartaoconveniodb = $pgps[5];
    	    	  $celulardb = $pgps[6];
    	    	  $cepdb = $pgps[7];
    	    	  $ruadb = $pgps[8];

    	    	  //Descrip 
    	    $nomeDescrip = base64_decode($nomedb);
    	    $datansDescrip = base64_decode($datanasdb);
    	    $cartaoSusdescrip = base64_decode($cartaosusdb);
    	    $cartaoconvenioDescrip = base64_decode($cartaoconveniodb);
            $celularDescrip = base64_decode($celulardb);
               //Mostra em tab
               print"<tr id='lintabres'>";
               echo"<td id='ceduladados'>$nomeDescrip</td><td id='ceduladados'>$cartaoSusdescrip</td><td id='ceduladados'>$datansDescrip</td><td id='ceduladados'>$cartaoconvenioDescrip</td><td id='ceduladados'>$celularDescrip</td><td><a href=excluir-pacienteprocess.php?idcds=".urlencode($idpaciente)."><button>Excluír</button></a></td>";
               print"</tr>";
    	    endwhile;
    	    print"</table>";
    	    print"</div>";

         
    }   

}

$oprdelps = new pgregistros($nomeCrip,$dtnascrip,$cardsusCrip,$celularCrip);
$oprdelps->pesquisardbase();
 //Fecha conexao 
   mysqli_close($con);
       



    endif;

 ?>
 
<?php
  else:
  	  header("Location: log-erro.php");
  endif;
?>
</body>
</html>