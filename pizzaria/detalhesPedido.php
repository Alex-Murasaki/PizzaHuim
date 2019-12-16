<!DOCTYPE html>
<html>
<head>
	<title>Detalhes do pedido</title>
	<h1>Veja aqui seu pedido de codigo:<?php echo $_REQUEST['codPedido']."</h1><hr>";
	$codPedido = $_REQUEST['codPedido'];
	include('conexao.php');
	 // Captura os códigos do cliente e do pedido
	if (isset($_REQUEST['codCliente'])) {
		$codCliente = $_REQUEST['codCliente'];
		$tipo = 1;
	}
	if (isset($_REQUEST['codUsuario'])) {
		$codUsuario = $_REQUEST['codUsuario'];
		$tipo = 2;
		mysqli_query($conexao, " UPDATE pedido SET status_pedido=1 WHERE cod_pedido=$codPedido ");
		mysqli_query($conexao, "INSERT INTO aux_usuario_pedido (cod_usuario, cod_pedido) VALUES('$codUsuario','$codPedido') ");
		echo " *selecione o que estiver pronto e atualize o pedido.<br><br> ";
	}
	$teste = 0;
	// COZINHEIRO MANIPULANDO PEDIDO
	if (isset($_REQUEST['pronto'])) {
		$pronto = $_REQUEST['pronto'];
		$teste = 1;
	}
	?>
</head>
<body>

<?php

	$pizzas = [];
	$bebidas = [];
	$valor = 0;
	$dadosProduto = mysqli_query($conexao, " SELECT * FROM aux_pedido_produto WHERE cod_pedido=$codPedido ORDER BY cod_pedido ASC ");
	$bebida = '';
	
	while ($umProduto = $dadosProduto->fetch_assoc()) {
		$codProduto = $umProduto['cod_produto'];
		$dadosPizza = mysqli_query($conexao, " SELECT * FROM produto WHERE cod_produto=$codProduto AND tipo_produto=1 ORDER BY cod_produto ASC ");
		while ($umaPizza = $dadosPizza->fetch_assoc()) {
			if ($teste == 1) {
				foreach ($pronto as $piz) {
					if ($umaPizza['nome_produto'] != $piz) {
						$pizzas[] = $umaPizza['nome_produto'];
					}
				}
			} else {
				$pizzas[] = $umaPizza['nome_produto'];
			}
			if ($umaPizza['valor_produto'] > $valor) {
				$valor = $umaPizza['valor_produto'];
			}
		
		}
		
		$dadosBebida = mysqli_query($conexao, " SELECT * FROM produto WHERE cod_produto='".$umProduto['cod_produto']."' AND tipo_produto='2' ORDER BY cod_produto ASC ");
		while ($umaBebida = $dadosBebida->fetch_assoc()) {
			$valor += $umaBebida['valor_produto'];
		
			if ($bebida != $umaBebida['nome_produto']) {
				$bebidas[] = $umaBebida['nome_produto'];
			}
		
			$bebida = $umaBebida['nome_produto'];
		}
	
	}
	
	if ($tipo == 1) {
	
		echo "<b>Pizzas:</b><br> ";
		
		foreach ($pizzas as $pi) {
			echo $pi."<br>";
		}
		echo "<br><b>Bebidas:</b><br> ";
		if (count($bebidas) < 1) {
			echo "Sem bebidas.<br>";
		}
		foreach ($bebidas as $bbd) {
			echo $bbd."<br>";
		}
		echo "<br><b>Valor:</b> ".$valor;
	
	} else {
		
		if (count($pizzas) < 1 || isset($_REQUEST['ultimo'])) {
			mysqli_query($conexao, " UPDATE pedido SET status_pedido=2 WHERE cod_pedido=$codPedido ");
			echo " <meta http-equiv='refresh' content='0; URL=mostraPedido.php?codUsuario=$codUsuario&codCliente=$codCliente'/> ";
		} else {
			
			echo "<form>";
			echo "<b>Pizzas:</b><br> ";
			foreach ($pizzas as $pi) {
				if($teste == 1) {
					if (count($pronto) == 1) {
						echo "<input type='checkbox' name='ultimo' value='$pi'>$pi<br>";
					} 
				} else { 
						echo "<input type='checkbox' name='pronto[]' value='$pi'>$pi<br>";
					}
			}
			
			echo "<br><b>Bebidas:</b><br> ";
			if (count($bebidas) < 1) {
				echo "Sem bebidas.<br>";
			}
			foreach ($bebidas as $bbd) {
				echo $bbd."<br>";
			}
			echo " <input type='hidden' name='codUsuario' value='$codUsuario'> ";
			echo " <input type='hidden' name='codCliente' value='$codCliente'> ";
			echo " <input type='hidden' name='codPedido' value='$codPedido'> ";
			echo "<br><input type='submit' value='Atualizar'> ";
			echo "</form>";
		}
	}
	

?>


<?php
if ($tipo == 1) {
	echo "<br><br><a href='mostraPedido.php?codCliente=$codCliente'>Voltar</a>";
} else {
	echo "<br><br><a href='mostraPedido.php?codCliente=$codCliente&codUsuario=$codUsuario'>Voltar</a>";
}
 ?>
</body>
</html>