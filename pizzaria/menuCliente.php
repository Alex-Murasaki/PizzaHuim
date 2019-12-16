<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<!-- <link rel='stylesheet' href='css/style.css'> -->
	<title>Menu Cliente</title>
<?php
if (isset($_REQUEST['codUsuario'])) {
	$codCliente = $_REQUEST['codUsuario'];
} else {
	$codCliente = $_REQUEST['codCliente'];
}


?>

<h1>Cliente: <?php echo ' - ID: 0'.$codCliente."." ?></h1>
<h2><a href="logout.php?">Sair</a></h2>
<hr>

<!-- Se houver algum pedido aberto em status zero(0), fechá-lo -->
<?php

?>

</head>
<body>

	<?php echo " <a href='mostraPedido.php?codCliente=$codCliente'>Realizar pedido</a> " ?>

<!-- Não esquece disso quando fizer um formulario
	<input type="hidden" name="codUsuario" value="$codUsuario">
-->

</body>
</html>