<!DOCTYPE html>
<html>
<head>
	<title>Adicione Pizzas</title>
	
	<?php
	include('conexao.php');
	// Captura os códigos do cliente e do pedido
	if (isset($_REQUEST['codCliente'])) {
		$codCliente = $_REQUEST['codCliente'];
		$tipo = 1;
	}
	if (isset($_REQUEST['codUsuario'])) {
		$codUsuario = $_REQUEST['codUsuario'];
		$tipo = 2;
	}
	
	// Mostra esses códigos (confirmar que recebeu)
	if ($tipo == 1) {
		echo "<h1>Adicone pizzas ao seu pedido - ID cliente: 0$codCliente.</h1>
	<hr>";
	} else {
		echo "<h1>Pedidos abertos para este cliente. - ID cliente: $codCliente</h1>
		<hr>";
	}?>
	
</head>
<body>
<!-- A -->

<!-- Manda o usuario para onde suas pizzas serão montadas -->
<?php if ($tipo == 1) {
	echo " <a href='produtoPedido.php?codCliente=$codCliente'>Monte seu combo pizza-bebidas!</a><br><br>";
}?>

<?php

$combosCliente = mysqli_query($conexao, " SELECT cod_pedido FROM aux_usuario_pedido WHERE cod_usuario='$codCliente' ORDER BY cod_pedido ASC ");
$row = mysqli_num_rows($combosCliente);


if($row > 0) {

	echo "<b>Combos pizza-bebida montados até o momento:</b><br>
	<br>";

	// Abre a tabela
	echo "<b>Pizzas:</b><br>
	<table border='1'>
    <tr>
        <td><b>ID</b></td>
        <td><b>Status</b></td>
        <td><b>Valor</b></td>
        <td><b>Abrir pedido</b></td>
    </tr>";


	$ultimaEntrega = new DateTime();
	$ultimaEntrega->setTime(0, 0, 0);

	while($combo = $combosCliente->fetch_assoc()){
		$codPedido = $combo['cod_pedido'];
		$pedidosCliente = mysqli_query($conexao, " SELECT * FROM pedido WHERE cod_pedido='$codPedido' ");
		$umPedido = $pedidosCliente->fetch_assoc();

		if(($tipo == 1 && $umPedido['status_pedido'] < 4) || ($tipo == 2 && $umPedido['status_pedido'] < 2)){

			$horaCadastro = mysqli_query($conexao, " SELECT cast(datahoraRegistro_pedido AS time) FROM pedido WHERE cod_pedido='$codPedido' ");
			$horinha = $horaCadastro->fetch_assoc();

		    // TRATANDO HORARIO // 
			$horario = new DateTime($horinha['cast(datahoraRegistro_pedido AS time)']);

			$hour = $horario->format('H');
			$min = $horario->format('i')+40;
			$sec = $horario->format('s');
			
			$horario->setTime($hour, $min, $sec);
			if ($horario > $ultimaEntrega) {
				$hour = $horario->format('H');
				$min = $horario->format('i');
				$sec = $horario->format('s');

				$ultimaEntrega->setTime($hour, $min, $sec);
			}
			// MOSTRANDO OS DADOS //
			$echoId =  $combo['cod_pedido'];
			switch ($umPedido['status_pedido']) {
				case 0:
					$echoStatus = "Aguardando preparo...";
					break;
				case 1:
					$echoStatus = "Em preparo...";
					break;
				case 2:
					$echoStatus = "Aguardando entrega...";
					break;
				case 3:
					$echoStatus = "Em processo de entrega...";
					break;
				case 4:
					$echoStatus = "Entregue!";
					break;
			}
			$echoValor = $umPedido['valor_pedido'];
			if ($tipo == 1) {
				$echoAbrir = " <a href='detalhesPedido.php?codCliente=$codCliente&codPedido=$codPedido'>Detalhes</a> ";
			} else {
				$echoAbrir = " <a href='detalhesPedido.php?codUsuario=$codUsuario&codCliente=$codCliente&codPedido=$codPedido'>Detalhes</a> ";
			}
			
				echo"<tr>
			        <td>$echoId</td>
			        <td>$echoStatus</td>
			        <td>$echoValor</td>
			        <td>$echoAbrir</td>
			    </tr>";
		}	
	}
	echo "</table><br>";
	echo "<b>Horario de entrega:</b>  ".$ultimaEntrega->format('H:i:s')."<br>";
} else {
	echo "sem pedidos parça<br>";
}


?><br>
<?php 
if ($tipo == 1) {
	echo " <a href='menuCliente.php?codCliente=$codCliente'>Voltar</a> ";
} else {
	echo " <a href='pedidosAbertos.php?codUsuario=$codUsuario'>Voltar</a> ";
}
	

 ?>

</body>
</html>