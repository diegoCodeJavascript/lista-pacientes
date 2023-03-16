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
	<title>Sair</title>
	<meta charset="utf-8">
</head>
<body>
	 <?php
	   session_unset();
       session_destroy();
      header("Location: index.html");

	 ?>
<?php
  else:
  	  header("Location: log-erro.php");
  endif;
?>
</body>
</html>