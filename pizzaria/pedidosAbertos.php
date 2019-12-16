<!DOCTYPE html>
<html>
<head>
	<title>Pedidos Abertos</title>
	<?php
	include('conexao.php');
	$codUsuario = $_REQUEST['codUsuario'];
	?> 

</head>
<body>
	<h1>Menu do Cozinheiro</h1>
	<h2>Escolha pedidos para atender.</h2>
	<h3><a href="logout.php?">Sair</a></h3>
	<hr>

<?php
$cliente = '';
$dadosPedidos = mysqli_query($conexao, " 
SELECT usuario.nome_usuario, pedido.cod_pedido, pedido.datahoraRegistro_pedido,aux_usuario_pedido.cod_usuario
FROM usuario, pedido, aux_usuario_pedido
WHERE
aux_usuario_pedido.cod_usuario = usuario.cod_usuario AND
usuario.tipo_usuario = 1 AND
aux_usuario_pedido.cod_pedido = pedido.cod_pedido ORDER BY pedido.datahoraRegistro_pedido ");

while ($umPedido = $dadosPedidos->fetch_assoc()) {
	$nomeCliente = $umPedido['nome_usuario'];
	$codCliente = $umPedido['cod_usuario'];
	$codPedido = $umPedido['cod_pedido'];

	if ($cliente != $umPedido['nome_usuario']) {
		echo "<b>Cliente:</b> $nomeCliente- ";
		echo "<a href='mostraPedido.php?codCliente=$codCliente&codUsuario=$codUsuario'>Atender.</a><br> ";
	}
	$cliente = $umPedido['nome_usuario'];
}?>

</body>
</html>