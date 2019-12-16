<!DOCTYPE html>
<html>
<head>
	<title>Avalie o pedido!</title>
	<?php
	include('conexao.php');
	$codUsuario = $_REQUEST['codUsuario'];
	$codPedido = $_REQUEST['codPedido'];
	?>
	<h1>Poderia avaliar nosso pedido? ^-^<?php echo " - ID-Entregador: ".$codUsuario ?></h1>
	<h2><a href="logout.php">Sair</a></h2>
	<hr>

<?php
if (isset($_REQUEST['notaPedido'])) {
	$notaPedido = $_REQUEST['notaPedido'];
// UPDATE pedido SET datahoraEntrega_pedido='2019-12-10 14:17:30' WHERE cod_pedido='24'
	
	$dataHora = new DateTime();

	$day = date('d');
	$month = date('m');
	$year = date('Y');
	$hour = date('H');
	$min = date('i');
	$sec = date('s');

	$dataHora->setDate($year, $month, $day);
	$dataHora->setTime($hour, $min, $sec);
	
	mysqli_query($conexao, " UPDATE pedido SET status_pedido=4, avaliacao_pedido=$notaPedido, datahoraEntrega_pedido='".$dataHora->format('Y-m-d H:i:s')."' WHERE cod_pedido=$codPedido ");
	echo " <meta http-equiv='refresh' content='0; URL=entregasPedido.php?codUsuario=$codUsuario'/> ";
}

?>

</head>
<body>

<form>
	<b>Dê-nos uma nota:</b><br>
	<br>
	<input type="radio" name="notaPedido" value="1">★<br>
	<input type="radio" name="notaPedido" value="2">★★<br>
	<input type="radio" name="notaPedido" value="3">★★★<br>
	<input type="radio" name="notaPedido" value="4">★★★★<br>
	<input type="radio" name="notaPedido" value="5">★★★★★<br>
	<br>
	<input type="radio" name="notaPedido" value="0">Prefiro não responder.<br>
	<br><?php
	echo "<input type='hidden' name='codPedido' value='$codPedido' >";
	echo "<input type='hidden' name='codUsuario' value='$codUsuario' >"; ?>
	<input type="submit" value="Avaliar!">
</form>
<?php
echo "<br><br><a href='entregasPedido.php?codUsuario=$codUsuario'>Voltar</a>";
?>
</body>
</html>