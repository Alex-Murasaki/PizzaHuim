<!DOCTYPE html>
<html>
<head>
	<title>Menu Gerente</title>

<?php
include('conexao.php');
$codUsuario=$_REQUEST['codUsuario'];
?>

	<h1>Menu do Gerente<?php echo ' - ID: 0'.$codUsuario."." ?></h1>
	<h2><a href="logout.php">Sair</a></h2>
	<hr>
<!-- Não esquece disso quando fizer um formulario
	<input type="hidden" name="codUsuario" value="$codUsuario">
-->
</head>
<body>

<!--

hoje BLZ

meses
semanas
dias

por entregador

pedidos abertos BLZ
pedidos entregues BLZ
pedidos atrasados BLZ

UPDATE pedido SET datahoraEntrega_pedido='2019-12-10 14:17:30' WHERE cod_pedido='24'

-->

<b>Relatórios:</b><br>
<br>
<?php

echo "<b>-------Estado atual-------</b><br><br>";
$entregasAbertas = mysqli_query($conexao, "SELECT cod_pedido, status_pedido ,cast(datahoraRegistro_pedido AS time), cast(datahoraEntrega_pedido AS time) FROM pedido ORDER BY status_pedido ");

echo "<b>Abertos:</b><br><br>";
// Laço dos abertos
while ($entrega = $entregasAbertas->fetch_assoc()) {
	echo "<b>Pedido de ID:</b> ".$entrega['cod_pedido'].". <b>Status:</b> ";
	switch ($entrega['status_pedido']) {
				case 0:
					echo "Aguardando preparo...<br>";
					break;
				case 1:
					echo "Em preparo...<br>";
					break;
				case 2:
					echo "Aguardando entrega...<br>";
					break;
				case 3:
					echo "Em processo de entrega...<br>";
					break;
				case 4:
					echo "Entregue!<br>";
					break;
			}
}
echo "<br>";

$entregasAtrasadas = mysqli_query($conexao, "SELECT cod_pedido, status_pedido ,cast(datahoraRegistro_pedido AS time), cast(datahoraEntrega_pedido AS time) FROM pedido WHERE status_pedido=4 ");
echo "<b>Atrasados:</b><br><br>";
// Laço dos atrasados
while ($entrega = $entregasAtrasadas->fetch_assoc()) {

	$horarioRegistro = new DateTime($entrega['cast(datahoraRegistro_pedido AS time)']);
	$horarioEntrega = new DateTime($entrega['cast(datahoraEntrega_pedido AS time)']);

	$hour = $horarioRegistro->format('H');
	$min = $horarioRegistro->format('i')+40;
	$sec = $horarioRegistro->format('s');
	$horarioEsperado = new DateTime();
	$horarioEsperado->setTime($hour, $min, $sec);

	if($horarioEsperado>$horarioEntrega){
		echo "<b>Pedido de ID:</b> ".$entrega['cod_pedido'].".<br>";
	}
}
echo "----------------------------------<br><br>";

echo "<b>-------Ver entregas por entregador-------</b><br>";
$usuarioPedidos = mysqli_query($conexao, " SELECT * FROM aux_usuario_pedido ");
while ($umUsuario = $usuarioPedidos->fetch_assoc()) {
	
	$entregadores = mysqli_query($conexao, " SELECT * FROM usuario WHERE cod_usuario='".$umUsuario['cod_usuario']."' AND tipo_usuario=2 ");
	while ($umEntregador = $entregadores->fetch_assoc()) {
		$pedidos = mysqli_query($conexao, " SELECT * FROM pedido WHERE cod_pedido='".$umUsuario['cod_pedido']."' ");
		while($umPedido = $pedidos->fetch_assoc()){
			echo "Entregador: ".$umEntregador['nome_usuario']."<br>";
			echo "Pedido: ".$umPedido['cod_pedido']."<br>";
		}

	}

}

?>
<b>Cadastros:</b><br>
<br>
<?php echo "<a href='cadastraFuncionario.php?codUsuario=$codUsuario'>*Cadastrar funcionarios!</a><br>";
echo "<br>";
echo "<a href='cadastraProduto.php?codUsuario=$codUsuario'>*Cadastrar sabores de pizza!</a><br>";
echo "<br>";
echo "<a href='cadastraExtra.php?codUsuario=$codUsuario'>*Cadastrar os Extras!</a>";?>

</body>
</html>