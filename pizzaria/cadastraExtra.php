<!DOCTYPE html>
<html>
<head>
	<title>Cadastra Extras</title>
	<h1>Cadastre Extras para a pizza!</h1>
	<hr>

<?php
include('conexao.php');
$codUsuario=$_REQUEST['codUsuario'];
if (isset($_REQUEST['nomeExtra'])) {
	$nomeExtra = $_REQUEST['nomeExtra'];

	mysqli_query($conexao, " insert into extra(nome_extra) values('$nomeExtra') ");
	echo "Cadastrado com sucesso!<hr>";
}
?>

</head>
<body>

<form>
	Nome:<br><input type="text" name="nomeExtra"><br>
	<?php echo "<input type='hidden' name='codUsuario' value='$codUsuario'> " ?>
	<br><input type="submit">
</form><br><?php
echo "<a href='menuGerente.php?codUsuario=$codUsuario'>Voltar</a>" ?>
</body>
</html>