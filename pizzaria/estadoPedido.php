<!DOCTYPE html>
<html>
<head>
	<title>Estado do Pedido</title>
	<?php
	include('conexao.php');
	$codPedido = $_REQUEST['codPedido']; ?>

</head>
<body>
	<h1>Menu do Cozinheiro<?php echo ' - Pedido ID: 0'.$codPedido."." ?></h1>
	<h2>Prepare!</h2>
	<h3><a href="logout.php?">Sair</a></h3>
	<hr>
<?php
	








echo "<br><br><a href='pedidosAbertos.php'>Voltar</a>" ?>


</body>
</html>