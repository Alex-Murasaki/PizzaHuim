<!DOCTYPE html>
<html>
<head>
	<?php session_start() ?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!-- Sem isso os acentos buggam -->
	<!-- <link rel='stylesheet' href='css/style.css'>  Importa o arquivo CSS -->
	<title>Log-in</title>

	<h1>Já possui uma conta?</h1>

</head>
<body>
	<?php   
	if (isset($_SESSION['invalido'])) {
		echo "<hr><b>ERRO: </b>Usuário ou senha inválidos.<hr>";
		unset($_SESSION['invalido']);
	} ?>

	<form action='login.php' id='id-login'> <!-- Formatação bonita do CSS -->
		Usuário:<br> <input type='text' name='nomeUsuario'/><br>
		Senha:<br> <input type='password' name='senhaUsuario'/><br>
		<br><input type='submit'>
	</form><br>
	<p>Ainda não possui uma conta? <a href="cadastraUsuario"> Criar!</a></p>
	
</body>
</html>