<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tela - Cadastro</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/tela-cadastro.css">
</head>
<body>
<img src="logo.png" id="logotelacadastro" />
<!-- Formulário cadastro -->
<h2 id="titulofomr">Cadastro de Colaboradores..:</h2>
<div id="cxfomrconta">
<form method="POST" action="">
  <label id="labelnome">Nome:</label><input type="text" id="cmpnome" name="nomeuser" required ><label id="labelsobrenome">Sobrenome:</label><input type="text" id="campsobrenome" name="sobrenomeus" required >
  <label id="labeldoc">CPF:</label>
  <input type="text" id="campdoc" name="cpfdoc" required >

  <label id="labelemail">E-mail:</label>
  <input type="text" id="campemail" name="email" required placeholder="E-mail...">
<label id="labelsenha">Senha:</label>
<input type="password" id="campsenha" name="senhadc" required>
  

<button id="btncriarconta" type='submit'>Criar conta</button>

</form>
<a href="index.html"><button id="btnvoltar">Voltar</button></a>
</div>
<?php
 //Pega dados form
 if(isset($_POST["nomeuser"])):
     //Conexao db 
     include("base.php");
     $nomefm = mysqli_escape_string($con,$_POST["nomeuser"]);
     $sobrenomefm =  mysqli_escape_string($con,$_POST["sobrenomeus"]);
     $emailfm = mysqli_escape_string($con,$_POST["email"]);
     $docfm  = mysqli_escape_string($con,$_POST["cpfdoc"]);
     $senhafm  = mysqli_escape_string($con,$_POST["senhadc"]);

     //Deixa letras  maiusculos
    $nomemn = mb_strtoupper($nomefm,"utf-8");
    $sobrenomemn = mb_strtoupper($sobrenomefm,"utf-8");
      //Deixa minusculo email caracteres
    $email_minusculo = mb_strtolower($emailfm,"utf-8");
    $senhamn = mb_strtoupper($senhafm,"utf-8");
    //Tira espaço

    $nomeEspaco = trim($nomemn);
    $sobrenomeEspaco = trim($sobrenomemn);
    $emailEspaco = trim($email_minusculo);
    $senhaEspaco = trim($senhamn);
    $cpfEspaco = trim($docfm);
    
    //Js tags 
    $nome_js = htmlentities($nomeEspaco);
    $sobrenome_js = htmlentities($sobrenomeEspaco);
    $email_js = htmlentities($emailEspaco);
    $senha_js = htmlentities($senhaEspaco);
    $cpfdoc_js = htmlentities($cpfEspaco);



    //POO
    class conta{
       var $nomeclas;
       var $sobrenomeclas;
       var $emailclas;
       var $doccpfclas;
       var $senhaclas;

      function conta($nm,$sbn,$email,$doc,$senhad){
           $this->nomeclas = $nm;
           $this->sobrenomeclas = $sbn;
           $this->emailclas = $email;
           $this->doccpfclas = $doc;
           $this->senhaclas = $senhad;

      }

      function criarconta(){
            //Conexao db 
           include("base.php");
          $nomepgclas= $this->nomeclas;
          $sobrenomepgclas = $this->sobrenomeclas;
          $emailpgclas = $this->emailclas;
          $docpgclas = $this->doccpfclas;
          $senhapgclas = $this->senhaclas;
            
             //Cripdados
           $emailcrip  = base64_encode($emailpgclas);
           $cpfCrip = base64_encode($docpgclas);
           $senhacrip = base64_encode($senhapgclas);

           //Verifica se existe alguma conta
             $sqlConta = "SELECT * FROM colaboradores WHERE cpf='$cpfCrip'";
             $resconta = mysqli_query($con,$sqlConta);
              while($pgcontaExiste = mysqli_fetch_row($resconta)):
                    $cpfcontadb = $pgcontaExiste[1];
              endwhile;
              //Verifica se existe uma conta
               if($cpfCrip == $cpfcontadb):
                   //Notifica já existe um cadastro,vinculado ao cpf
                     
                      session_start();
                      $_SESSION["cadastroinformacao"] = "5650A";
                      header("Location: informacoes-cadastro.php");
                      
               else:
                   //Permite criar
                  $sqlCriar = "INSERT INTO colaboradores VALUES(Null,'$cpfCrip','$senhacrip','$nomepgclas','$sobrenomepgclas','$emailcrip','ativo')";
                  $sqlcadastro = mysqli_query($con,$sqlCriar);
                    if($sqlcadastro):
                      
                      session_start();
                      $_SESSION["cadastroinformacao"] = "5ckja00";
                      header("Location: informacoes-cadastro.php");
                      
                    else:
                      
                      session_start();
                      $_SESSION["cadastroinformacao"] = "d84d";
                      header("Location: informacoes-cadastro.php");
                      
                    endif;
               endif;


      }
    }
$opccriar = new conta($nome_js,$sobrenome_js,$email_js,$cpfEspaco,$senha_js);
$opccriar->criarconta();
 endif;

?>

</body>
</html>