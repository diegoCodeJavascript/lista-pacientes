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
	<title>Informações do paciente</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/menu-do-sistema.css">
	<link rel="stylesheet" type="text/css" href="css/inforcadastro.css">
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
  <img src="logo.png" id="logotelacadastropaciente" />
   <?php
     //Conexao db 
     include("base.php");
      $codcadastro = mysqli_escape_string($con,$_GET["idc"]);
      //Tira espaço tag
      $codcadastroEspaco = trim($codcadastro);
      //TagJs
      $codcadastroJs = htmlspecialchars($codcadastroEspaco);

      //Pesquisar dados
      $sqlPesquisar = "SELECT * FROM pacientes WHERE idr='$codcadastroJs'";
      $respequisa = mysqli_query($con,$sqlPesquisar);
        while($pgpscadastros = mysqli_fetch_row($respequisa)):
        	   $idcadastrodb = $pgpscadastros[0];
        	   $nomedb = $pgpscadastros[1];
        	   $dtnasdb = $pgpscadastros[2];
        	   $prontuariodb = $pgpscadastros[3];
        	   $cartaosusdb = $pgpscadastros[4];
        	   $cartaoconveniodb = $pgpscadastros[5];
        	   $celulardb = $pgpscadastros[6];
        	   $cepdb = $pgpscadastros[7];
        	   $ruadb = $pgpscadastros[8];
        	   $bairrodb = $pgpscadastros[9];
        	   $cidadedb = $pgpscadastros[10];
        	   $estadodb = $pgpscadastros[11];
        	   $numerodb = $pgpscadastros[12];

        	   //Descrip dados
        	   $nomeDescrip = base64_decode($nomedb);
        	   $dtnsDescrip = base64_decode($dtnasdb);
        	   $cartaocnsDescript = base64_decode($cartaosusdb);
        	   $cartaoconvenioDescrip = base64_decode($cartaoconveniodb);
        	   $celularDescrip = base64_decode($celulardb);
        	   $cepdbDescript = base64_decode($cepdb);
        	   $ruaDescript = base64_decode($ruadb);
        	   $bairroDescript = base64_decode($bairrodb);
           endwhile;


   ?>
   <div id="dadosformcl">
   	<table>
   	<form method="POST" action="">
      <tr>
   		<th>Paciente:</th><td><input type="text" name="namepc" value="<?php echo $nomeDescrip ?>" required></td><th>Data nas:</th><td><input type="text" name="datanas" value="<?php echo $dtnsDescrip ?>" required></td>
     </tr>
     <tr>
     	<th>Cartão CNS:</th><td><input type="text" name="cardcns" value="<?php echo $cartaoconvenioDescrip ?>"></td><th>Cartão do convênio</th><td><input type="text" name="cardconvenio" value="<?php echo $cartaoconvenioDescrip ?>"></td>
     </tr>
     <tr>
     	<th>Prontuário n°:</th><td><input type="text" name="proncnumero" value="<?php echo $prontuariodb ?>"></td><th>Cep:</th><td><input type="text" name="cepend" value="<?php echo $cepdbDescript ?>"></td>
     </tr>
     <tr>
     	<th>Rua:</th><td><input type="text" name="ruaend" value="<?php echo $ruaDescript ?>"></td><th>N° end:</th><td><input type="text" name="emdnumero" value="<?php echo $numerodb ?>"></td>
     </tr>
     <tr>
     	<th>Bairro:</th><td><input type="text" name="bairroend" value="<?php echo $bairroDescript ?>"></td> <th>Cidade:</th><td><input type="text" name="cidade" value="<?php echo $cidadedb?>"></td>
     </tr>
     
     <th>Estado:</th><td><input type="text" name="estado" value="<?php echo $estadodb ?>"></td><th>Celular:</th><td><input type="text" name="celpacient" value="<?php echo $celularDescrip ?>"></td>
     	<button type="submit" id="btnaltdados">Alterar Dados</button>
   	</form>
   
   	</table>
   </div>
 <?php
  if(isset($_POST["namepc"])):
    //conexao db 
  	  include("base.php");
  	  //Tipo  procedural 
  	  $nomefm = mysqli_escape_string($con,$_POST["namepc"]);
  	  $datansfm = mysqli_escape_string($con,$_POST["datanas"]);
  	  $cnsfm = mysqli_escape_string($con,$_POST["cardcns"]);
  	  $carconvenio = mysqli_escape_string($con,$_POST["cardconvenio"]);
  	  $codpront  = mysqli_escape_string($con,$_POST["proncnumero"]);
  	  $celular = mysqli_escape_string($con,$_POST["celpacient"]);
  	  $cepfm = mysqli_escape_string($con,$_POST["cepend"]);
  	  $ruafm = mysqli_escape_string($con,$_POST["ruaend"]);
  	  $numeroend = mysqli_escape_string($con,$_POST["emdnumero"]);
  	  $bairroend = mysqli_escape_string($con,$_POST["bairroend"]);
  	  $cidadeend = mysqli_escape_string($con,$_POST["cidade"]);
  	  $estadoend = mysqli_escape_string($con,$_POST["estado"]);
      
      //Tira espaco 
      $nomeEspaco = trim($nomefm);
      $dataEspaco = trim($datansfm);
      $cnsEspacao = trim($cnsfm);
      $carconvenioEspaco = trim($carconvenio);
      $celularEspaco = trim($celular);
      $codprontuario = trim($codpront);
      $cepEspaco = trim($cepfm);
      $ruaEspaco = trim($ruafm);
      $numeroendEspaco = trim($numeroend);
      $bairroEdnEspaco = trim($bairroend);
      $cidadeEspaco = trim($cidadeend);
      $estadoEspaco = trim($estadoend);
  
  //Deixa caracteres maiusculos
      $nomeMn = mb_strtoupper($nomeEspaco,"utf-8");
      $ruaMn = mb_strtoupper($ruaEspaco,"utf-8");
      $bairroMn = mb_strtoupper($bairroEdnEspaco,"utf-8");
      $cidadeMn = mb_strtoupper($cidadeEspaco,"utf-8");
      $estadoMn = mb_strtoupper($estadoEspaco,"utf-8");

   //Crip dados
      $nomeCrip = base64_encode($nomeMn);
      $datanasCrip = base64_encode($dataEspaco);
      $cnsCrip = base64_encode($cnsEspacao);
      $carconvenioCrip = base64_encode($carconvenioEspaco);
      $celularCrip = base64_encode($celularEspaco);
      $cepCrip = base64_encode($cepEspaco);
      $ruaCrip = base64_encode($ruaMn);
      $bairroCrip = base64_encode($bairroMn);

     //Salva alterações
      $sqlAlterar = "UPDATE pacientes SET nome='$nomeCrip',	datanas='$datanasCrip',prontuario='$codpront',cartaosus='cnsCrip',cartaoconvenio='$carconvenioCrip',celularp='$celularCrip',cep='$cepCrip',rua='$ruaCrip',bairro='$bairroCrip',cidade='$cidadeMn',estado='$estadoMn',numerocs='$numeroendEspaco' WHERE idr='$codcadastroJs'";
      $resatualizar = mysqli_query($con,$sqlAlterar);

       //Msg 
      if($resatualizar):
         print"<script>alert('Dados atualizados!')</script>";
     else:
     	print"<script>alert('Erro ao atualizar!')</script>";
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