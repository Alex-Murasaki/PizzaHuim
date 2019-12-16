<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel='stylesheet' href='css/style.css'>
	<title>Menu Admin</title>

<?php
	$codUsuario = $_REQUEST['codUsuario'];
?>

</head>
<body>
	<h1>Menu do Administrador<?php echo ' - ID: 0'.$codUsuario."." ?></h1>
	<h2><a href="logout.php?">Sair</a></h2>
	<hr>
<!-- Não esquece disso quando fizer um formulario
	<input type="hidden" name="codUsuario" value="$codUsuario">
--><?php
	echo "<a href='cadastraGerente.php?codUsuario=$codUsuario''>*Cadastrar um novo gerente</a><br>" ?>
	<br>
	<br>
	<a href="teste.php">testes do administrador.</a>

</body>
</html>