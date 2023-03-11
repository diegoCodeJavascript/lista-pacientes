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
	<title>Cadastrar pacientes</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/cadastro-paciente.css">
	<link rel="stylesheet" type="text/css" href="css/menu-do-sistema.css">
</head>
<body>

<!-- Adicionando Javascript -->
  <script>
    
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
           
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
            
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";
                

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

    </script>

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
  <h2 id="titulocdp">Cadastro de paciente:</h2>
  <div id="cxformcadastropaciente">
  	<form method="POST" action="">
  	<table>

  		<tr>
  			<th>*Nome completo:</th><td><input type="text" name="nomepc" required></td><th>Data nas:</th><td><input type="text" name="datans"></td>
  		</tr>
  		<tr>
  			<th>Cartão do convênio:</th><td><input type="text" name="cardconvenio"></td><th>*Cartão SUS:</th><td><input type="text" name="cardsus" required></td>
  		</tr>
       <tr>
       	<th>Celular do Paciente:</th><td><input type="text" name="telpaciente"></td><th>CEP:</th><td><input name="cep" type="text" id="cep" value="" size="10" maxlength="9"
               onblur="pesquisacep(this.value);"  /></td>
       </tr>
     <tr>
     	<th>Rua:</th><td><input name="rua" type="text" id="rua"></td><th>Bairro:</th><td><input name="bairro" type="text" id="bairro"></td>
     </tr>
     <tr>
     	<th>End N°</th><td><input type="text" name="numeroend"/></td><th>Cidade:</th><td><input name="cidade" type="text" id="cidade">
     </tr>
     <tr>
     	</td><th>Estado:</th><td><input name="uf" type="text" id="uf"></td>
     </tr>
  	</table>
<button id="btngravarcadastro" type="submit">Gravar Dados</button>
  </form>
  </div>
  
  <?php
    if(isset($_POST["nomepc"])):
     //Pega conexao db
     include("base.php");
     $nome = mysqli_escape_string($con,$_POST["nomepc"]);
     $datans = mysqli_escape_string($con,$_POST["datans"]);
     $cardsus = mysqli_escape_string($con,$_POST["cardsus"]);
     $carconvenio = mysqli_escape_string($con,$_POST["cardconvenio"]);
     $telpaciente = mysqli_escape_string($con,$_POST["telpaciente"]);
     $cep = mysqli_escape_string($con,$_POST["cep"]);
     $rua = mysqli_escape_string($con,$_POST["rua"]);
     $bairro = mysqli_escape_string($con,$_POST["bairro"]);
     $numerocasa = mysqli_escape_string($con,$_POST["numeroend"]);
     $cidade = mysqli_escape_string($con,$_POST["cidade"]);
     $estado = mysqli_escape_string($con,$_POST["uf"]);

     //Tag js 
     $nome_js = htmlspecialchars($nome);
     $datanas_js = htmlspecialchars($datans);
     $carsus_js = htmlspecialchars($cardsus);
     $carconvenio_js = htmlspecialchars($carconvenio);
     $telpaciente_js = htmlspecialchars($telpaciente);
     $cep_js = htmlspecialchars($cep);
     $rua_js = htmlspecialchars($rua);
     $bairro_js = htmlspecialchars($bairro);
     $cidade_js = htmlspecialchars($cidade);
     $numerocasa_js = htmlspecialchars($numerocasa);
     $estado_js = htmlspecialchars($estado);
      //Tira espaco 
     $nome_espaco = trim($nome_js);
     $datanas_espaco = trim($datanas_js);
     $carsus_espaco = trim($carsus_js);
     $carconvenio_espaco = trim($carconvenio_js);
     $telpaciente_espaco = trim($telpaciente_js);
     $cep_espaco = trim($cep_js);
     $rua_espaco = trim($rua_js);
     $bairro_espaco = trim($bairro_js);
     $cidade_espaco = trim($cidade_js);
     $numerocasa_espaco = trim($numerocasa_js);
     $estado_espaco = trim($estado_js);
   
   //Letras Maiusculas
    $nomeMn = mb_strtoupper($nome_espaco,"utf-8");
    $ruaMn = mb_strtoupper($rua_espaco,"utf-8");
    $bairroMn = mb_strtoupper($bairro_espaco,"utf-8");
    $cidadeMn = mb_strtoupper($cidade_espaco,"utf-8");
    $estadoMn = mb_strtoupper($estado_espaco,"utf-8");
     
     //Criptografia
    $nomeCrip = base64_encode($nomeMn);
    $datanasCrip = base64_encode($datanas_espaco);
    $cartaosusCrip = base64_encode($carsus_espaco);
    $cartaoconvenioCrip = base64_encode($carconvenio_espaco);
    $celularCrip  = base64_encode($telpaciente_espaco);
    $cepCrip = base64_encode($cep_espaco);
    $ruaCrip = base64_encode($ruaMn);
    $bairroCrip = base64_encode($bairroMn);

  
      //Verifica se existe um cadastro
        $sqlVerificar = "SELECT * FROM pacientes WHERE cartaosus='$cartaosusCrip'";
        $resverificar = mysqli_query($con,$sqlVerificar);
           while($pgconsultaver = mysqli_fetch_row($resverificar)):
                $nomedbv = $pgconsultaver[1];
                $prontuariodb = $pgconsultaver[3];
                $cartaosusdb = $pgconsultaver[4];
                $bairrodb = $pgconsultaver[9];

           endwhile;
        //Verifica se existe cadastro, com mesmo cns e numero de prontuario
            

          if($cartaosusCrip == $cartaosusdb):
        print"<div id='cxmodalcadastroexistente'>";
                     echo"<img src='system-imagens/55f9fg.png' id='iluscadastroalert'/>";
                     echo"<h2 id='informodalcns'>Cartão CNS já tem cadastro!</h2>";
                      echo"<a href=system-inicial.php><img src='system-imagens/btnffxc.png' id='btnfcmdpcnsexiste'/></a>";
                     echo"<button onclick='history.back();' id='btnpreenchernvm'>Preencher novamente</button>";
                  print"</div>";
         else:
          $sqlInserir = "INSERT INTO pacientes VALUES(Null,'$nomeCrip','$datanasCrip','Sem informação','$cartaosusCrip','$cartaoconvenioCrip','$celularCrip','$cepCrip','$ruaCrip','$bairroCrip','$cidadeMn','$estadoMn','$numerocasa_espaco')";
      $rescadastrar =  mysqli_query($con,$sqlInserir);
         if($rescadastrar):
                  print"<div id='cxmodalcadastradopccnscomsucesso'>";
                      echo"<a href=cadastrar-pacientes.php><img src='system-imagens/btnffxc.png' id='btnfctelcdpndsc'/></a>";
                      echo"<img src='system-imagens/226f6g8.png' id='iluspstcnvs'/>";
                     echo"<h2 id='infrcadastradook'>Cadastrado com sucesso!</h2>";
                  print"</div>";
           endif;
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