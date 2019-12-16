<!DOCTYPE html>
<html>
<head>
	<title>Cadastra Produtos</title>

<h1>Cadastre novos produtos!</h1>

<?php 
include('conexao.php');
$codUsuario=$_REQUEST['codUsuario'];
if (isset($_REQUEST['nomeProduto'])) {
	$nomeProduto = $_REQUEST['nomeProduto'];
	$volumeProduto = $_REQUEST['volumeProduto'];
	$valorProduto = $_REQUEST['valorProduto'];
	$saborProduto = $_REQUEST['saborProduto'];
	$tipoProduto = $_REQUEST['tipoProduto'];
	$descricaoProduto = $_REQUEST['descricaoProduto'];

	mysqli_query($conexao, " insert into produto(nome_produto,tipo_produto, volume_produto, valor_produto, sabor_produto, descricao_produto) values('$nomeProduto', '$tipoProduto', '$volumeProduto', '$valorProduto', '$saborProduto', '$descricaoProduto') ");
	echo "Cadastrado com sucesso!<hr>";
}
 ?>
<!--
nome_produto	
tipo_produto	
volume_produto	
valor_produto	
sabor_produto	
descricao_produto
-->
</head>
<body>
<form>
	Nome:<br><input type="text" name="nomeProduto">
	<br>

	Volume (Kg/L):<br>
	<input type="text" name="volumeProduto">
	<br>

	Valor:<br><input type="text" name="valorProduto">
	<br>
	
	O produto possui algum sabor?<br>
	<input type="text" name="saborProduto"><br>
	<br>
	
	Tipo de produto:<br>
		<select name='tipoProduto'>
			<option value='1'>Pizza</option>
			<option value='2'>Bebida</option>
		</select>
		<br>
	
	Descrição:<br>
	<input type="text" name="descricaoProduto">
	<br>
	
	<?php echo "<input type='hidden' name='codUsuario' value='$codUsuario'> " ?>
	<br><input type="submit">

</form><br><?php

echo "<a href='menuGerente.php?codUsuario=$codUsuario'>Voltar</a>" ?>

</body>
</html>