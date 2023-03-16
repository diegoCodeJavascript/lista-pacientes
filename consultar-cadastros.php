<?php
   session_start();
   $_SESSION["idconta"];
   $_SESSION["login"];
   $_SESSION["nomeus"];
   $_SESSION["satusc"];

  if($_SESSION["idconta"] AND $_SESSION["login"]):

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Consultar cadastro</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/consultar-cadastropc.css">
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
  <h2 id="consultinformpac">Consultar informações de paciente</h2>
  <div id="cxformpesquisa">
	  	<form method="POST" action="">
		  	<table>
		  		<tr>
		  			<th>Paciente:</th><td><input type="text" name="nomepc"></td>
		  			<th>Data nas:</th><td><input type="text" name="dtnas"></td>
		  		</tr>
		  		<tr>
		  			<th>Cartão do sus:</th><td><input type="text" name="cartsus"></td><th>Celular de contato:</th><td><input type="text" name="celcontato"></td>
		  		</tr>
		  		<tr>
		  			<th>Rua:</th><td><input type="text" name="ruaend"></td>
		  			<th>Bairro:</th><td><input type="text" name="bairroend"></td>
		  		</tr>
		  	</table>
		  	<button type="submit" id="btnpesreg">Pesquisar registro</button>
	  </form>
  </div>

  <div id="cxresultado">
    <table id='tabdadospcadastros'>
      <tr>
        <th>Paciente:</th><th>Data nas:</th><th>Contato:</th><th>Prontuário:</th>
      </tr>
  
<?php
  if(isset($_POST["nomepc"])):
      //Conexao db 
  	include("base.php");
  	$nomefm = mysqli_escape_string($con,$_POST["nomepc"]);
  	$dtnasfm = mysqli_escape_string($con,$_POST["dtnas"]);
  	$cartsus = mysqli_escape_string($con,$_POST["cartsus"]);
  	$ruafm = mysqli_escape_string($con,$_POST["ruaend"]);
  	$bairrofm = mysqli_escape_string($con,$_POST["bairroend"]);
     //Tag js
  	
  	$nomeJs = htmlspecialchars($nomefm);
  	$dtnasJs = htmlspecialchars($dtnasfm);
  	$cartaosusJs = htmlspecialchars($cartsus);
  	$ruafmJs = htmlspecialchars($ruafm);
  	$bairroJs = htmlspecialchars($bairrofm);
  	 
  	//Espaco 
  	$nomeEspaco = trim($nomeJs);
  	$dtnasEspaco = trim($dtnasJs);
  	$cartaosusEspaco = trim($cartaosusJs);
  	$ruaEspaco = trim($ruafmJs);
  	$BairroEspaco = trim($bairroJs);

  	//Letras Maiusculas
  	$nomeMn = mb_strtoupper($nomeEspaco);
  	$ruaMn = mb_strtoupper($ruaEspaco);
  	$bairroMn = mb_strtoupper($BairroEspaco);


  	//CripDados
  	$nomeCrip = base64_encode($nomeMn);
  	$ruaCrip = base64_encode($ruaMn);
  	$bairroCrip = base64_encode($bairroMn);
    $cartaosusCrip = base64_encode($cartaosusEspaco);
//POO 
  class pesquisads{
  	  var $nomeclas;
  	  var $ruaclas;
  	  var $bairroclas;
      var $carsusclas;

   function pesquisads($nm,$rra,$bda,$card){
       $this->nomeclas = $nm;
       $this->ruaclas = $rra;
       $this->bairroclas = $bda;
       $this->carsusclas = $card;

   	 
  }
   function pscadastro(){
      //Conexao db 
       include("base.php");
      $nomepsclas = $this->nomeclas;
      $ruapsclas = $this->ruaclas;
      $bairroclas = $this->bairroclas;
      $cardsuspsclas = $this->carsusclas;

      $sqlpsdados = "SELECT * FROM pacientes WHERE nome LIKE'%$nomepsclas%' AND rua LIKE'%$ruapsclas%' AND bairro LIKE'%$bairroclas%' AND cartaosus LIKE'%$cardsuspsclas%' ";
      $respsdados = mysqli_query($con,$sqlpsdados);
         while($pgdadosdb = mysqli_fetch_row($respsdados)):
               $idcadastrodb = $pgdadosdb[0];
               $nomedb = $pgdadosdb[1];
               $dtnasdb = $pgdadosdb[2];
               $prontuariodb = $pgdadosdb[3];
               $cnsdb = $pgdadosdb[4];
               $cnconveniodb = $pgdadosdb[5];
               $celulardb = $pgdadosdb[6];
              //Descrip dados
               $nomeDescript = base64_decode($nomedb);
               $dtanasDescrip = base64_decode($dtnasdb);
               $celularDescrip = base64_decode($celulardb);


              print"<tr id='linprocs'>";
              echo"<td>$nomeDescript</td><td>$dtanasDescrip</td><td>$celularDescrip</td><td>$prontuariodb</td><td><a href=inforcadastro.php?idc=".urlencode($idcadastrodb)."><button>Ver mais</button></a></td>";
              print"</tr>";


         endwhile;
       print"</table>";
       echo"</div>";
   }


}

$pgdadops = new pesquisads($nomeCrip,$ruaCrip,$bairroCrip,$cartaosusCrip);
$pgdadops->pscadastro();






  endif;

?>
<?php
 else:
   header("Location: log-erro.php");
   endif;
?>
</body>
</html>