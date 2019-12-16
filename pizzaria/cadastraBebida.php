<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Bebidas</title>
	<h1>Cadastrar bebidas para acompanhamento</h1>

<?php
include('conexao.php');
$codUsuario=$_REQUEST['codUsuario'];
if (isset($_REQUEST['nomeBebida'])) {
	$nomeBebida = $_REQUEST['nomeBebida'];
	$valorBebida = $_REQUEST['valorBebida'];

	myslqi_query(" insert into bebida(nome_bebida,valor_bebida) values('$nomeBebida','$valorBebida') ");
	echo "Cadastrado com sucesso<hr>";

}
?>
</head>
<body>
<form>
	Nome:<br><input type="text" name="nomeBebida"><br>
	Valor:<br><input type="text" name="valorBebida"><br>
	<?php echo "<input type='hidden' name='codUsuario' value='$codUsuario'> " ?>
	<br><input type="submit">
</form><br><?php
echo "<a href='menuGerente.php?codUsuario=$codUsuario'>Voltar</a>" ?>
</body>
</html>