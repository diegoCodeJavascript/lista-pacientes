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
	<title>Consultar comparecimento</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/consultar-llcomp.css">
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
  <img src="logo.png" id="logoconsultpresenca" />
  <h2 id="consultpresenca">Consultar Presença de paciente</h2>
  <div id="cxformpesquisarcomplis">
     <form method="POST" action="">
     <table> 
        <tr>
           <th>Paciente:</th><td><input type="text" name="nomepc"></td>
           <th>Data:</th><td><input type="text" name="datadia"></td>
        </tr>
        <tr>
           <th>N° prontuário:</th><td><input type="text" name="cdprontuario"></td><th>Data Nas:</th><td><input type="text" name="datanas"></td>
        </tr>
     </table>
       <button id="btnpesreg" type="submit">Pesquisar registros</button>
     </form>
  </div>
  <div id="cxresultadocomparecimentos">
  <table id='tabconsultachegada'>
    <tr>
       <th>Paciente:</th><th>Prontuário n°:</th><th>Hora de chegada:</th><th>Data:</th>
    </tr>
<?php
 if(isset($_POST["nomepc"])):
   //Conexao db
    include("base.php");
   //dados form 
    $nome = mysqli_escape_string($con,$_POST["nomepc"]);
    $data = mysqli_escape_string($con,$_POST["datadia"]);
    $codprontuario = mysqli_escape_string($con,$_POST["cdprontuario"]);
    $dtnas = mysqli_escape_string($con,$_POST["datanas"]);

   //Deixa maisculo caracteres
    $nomeMn = mb_strtoupper($nome);
     $sqlSql  = "SELECT * FROM chegadac WHERE  paciente LIKE'%$nomeMn%' AND prontuario LIKE'%$codprontuario%' AND data LIKE'%$dtnas%' ORDER BY chegadahora";
     $sqlRes = mysqli_query($con,$sqlSql);
        while($pgdadoschegada = mysqli_fetch_row($sqlRes)):
            $idchegada = $pgdadoschegada[0];
            $pacientedb = $pgdadoschegada[1];
            $prontuariodb = $pgdadoschegada[2];
            $hrchegadadb = $pgdadoschegada[3];
            $dtchegadadb  = $pgdadoschegada[4];
              print"<tr id='linresultchegada'>";
              echo"<td id='cedchegada'>$pacientedb</td><td id='cedchegada'>$prontuariodb</td><td id='cedchegada'>$hrchegadadb</td><td id='cedchegada'>$dtchegadadb</td>";
              print"</tr>";
        endwhile;
         echo"</table>";
         echo"</div>";
 endif;

?>
<?php
else:
	  header("log-erro.php");
	endif;

?>
</body>
</html>