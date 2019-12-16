<!DOCTYPE html>
<html>
<head>
	<title>Menu Cozinheiro</title>
	<?php
	include('conexao.php');
	$codUsuario = $_REQUEST['codUsuario'];?>
	<h1>Menu Funcionario<?php echo " - ID-Entregador: ".$codUsuario ?></h1>
	<h2><a href="logout.php">Sair</a></h2>
	<hr>

<?php
if (isset($_REQUEST['entregas'])) {
	$entregas = $_REQUEST['entregas'];

	foreach ($entregas as $aEntrega) {
	
		mysqli_query($conexao, " UPDATE pedido SET status_pedido=3 WHERE cod_pedido=$aEntrega ");

		$dadosUsuarioPedido = mysqli_query($conexao, " SELECT * FROM aux_usuario_pedido WHERE cod_usuario=$codUsuario AND cod_pedido=$aEntrega ");
		$row = mysqli_num_rows($dadosUsuarioPedido);

		if ($row == 0) {
			mysqli_query($conexao, " INSERT INTO aux_usuario_pedido(cod_usuario, cod_pedido) VALUES('$codUsuario','$aEntrega') ");
		}	
	}
	// echo " <meta http-equiv='refresh' content='0; URL=entregasPedido.php?codUsuario=$codUsuario'/> ";
}?>

</head>
<body>

<form>
<?php
$cont = 0;

$pedidoEntrega = mysqli_query($conexao, " SELECT * FROM pedido WHERE status_pedido=2 ");
$rowEntrega = mysqli_num_rows($pedidoEntrega);
	
if($rowEntrega > 0){
	echo " Selecione pedidos para entregar.<br><br>";
	while($pedido = $pedidoEntrega->fetch_assoc()){
		if ($cont > 3) {
			echo "<br>";
		}
		echo "   <input type='checkbox' name='entregas[]' value='".$pedido['cod_pedido']."'>ID-Pedido: ".$pedido['cod_pedido']."<br>";
		echo "<input type='hidden' name='codUsuario' value='$codUsuario'>";
	}
	echo "<br><br><input type='submit' value='Sair para entrega!'>";
	echo "</form>";
} else {
	$pedidosACaminho = mysqli_query($conexao, " SELECT * FROM pedido WHERE status_pedido=3 ");
	$rowACaminho = mysqli_num_rows($pedidosACaminho);
	if ($rowACaminho > 0) {
			echo " <a href='entregasPedido.php?codUsuario=$codUsuario'>Pedidos em entrega</a> ";
		} else {
			echo "Sem pedidos para atender hoje, amigão.";
		}
}
?><br>
<br>

</body>
</html>