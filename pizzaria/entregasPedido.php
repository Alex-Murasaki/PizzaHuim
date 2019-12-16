<!DOCTYPE html>
<html>
<head>
	<title>Entregas</title>
	<?php
	include('conexao.php');
	$codUsuario = $_REQUEST['codUsuario'];?>
	<h1>Entregas a serem feitas<?php echo " - ID-Entregador: ".$codUsuario ?></h1>
	<h2><a href="logout.php">Sair</a></h2>
	<hr>

<?php

$pedidosACaminho = mysqli_query($conexao, " SELECT * FROM pedido WHERE status_pedido=3 ");
$row = mysqli_num_rows($pedidosACaminho);
if($row > 0){
	echo "Ainda tem coisa. <br>";
	while ($pedido = $pedidosACaminho->fetch_assoc()) {

		echo "<form action='avaliacaoPedido.php'>";
		echo "<b>ID-Pedido:</b> ".$pedido['cod_pedido']." - ";
		echo "<input type='hidden' name='codPedido' value='".$pedido['cod_pedido']."' >";
		echo "<input type='hidden' name='codUsuario' value='$codUsuario' >";
		echo "<input type='submit' value='Entregue!'<br><br>";
		echo "<b>Sabor(es):</b><br>";

		$pegaProdutos = mysqli_query($conexao, " SELECT cod_produto FROM aux_pedido_produto WHERE cod_pedido=".$pedido['cod_pedido']." ");
		while ($codProduto = $pegaProdutos->fetch_assoc()) {

			$dadosProduto = mysqli_query($conexao, " SELECT * FROM produto WHERE cod_produto='".$codProduto['cod_produto']."' ");
			$cadaProduto = $dadosProduto->fetch_assoc();

			if ($cadaProduto['tipo_produto'] == 1) {
				echo $cadaProduto['sabor_produto']."<br>";
			}		

		}



	}
	echo "</form>";
	echo "<hr>";
} else {
	echo "Todos pedidos entregues, amigão.";
}
?>

</head>
<body>
<?php
echo "<br><a href='menuEntregador.php?codUsuario=$codUsuario'>Voltar</a>";
?>


</body>
</html>