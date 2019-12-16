<!DOCTYPE html>
<html>
<head>
	<title>Realizar pedido</title>
	<h1>Faça seu pedido.

<?php
include('conexao.php');
$codCliente = $_REQUEST['codCliente'];
echo " ID: 0".$codCliente; ?></h1>
<hr>

</head>
<body>


<?php echo " <a href='mostraPedido.php?codCliente=$codCliente'>Adicionar pizzas ao pedido</a> " ?><br>
<br>
<?php echo " <a href='menuCliente.php?codCliente=$codCliente'>Voltar</a> " ?>


</body>
</html>