<!DOCTYPE html>
<html>
<head>
	<title>Bebidas</title>
	<h1>Escolha suas bebidas!
	<?php
	include('conexao.php');
	$codUsuario = $_REQUEST['codUsuario'];
	$codPedido = $_REQUEST['codPedido'];
	echo " ID: 0".$codUsuario.". Pedido: ".$codPedido; ?></h1>
	<hr>



<?php



if (isset($_REQUEST['quantBebida'])) {
	$qtdBebida = $_REQUEST['quantBebida'];
	$bebidasPedido = $_REQUEST['bebidasPedido'];

	$elementos = count($qtdBebida);
	$cont = 0;
	for ($i=0; $i < $elementos; $i++) { 
		if ($qtdBebida[$i] != '') {
			$cont += 1;
		}
	}

	echo "CONT: ".$cont;

	print_r($qtdBebida);
	print_r($bebidasPedido);

	// echo $cont;
	$val = 0;
	// Insere as bebidas na aux_pedido_bebida
	$i= 0;
	foreach ($bebidasPedido as $bbd) {

		for ($j=0; $j < $qtdBebida[$i]; $j++) { 

			mysqli_query($conexao, " insert into aux_pedido_bebida (cod_pedido, cod_bebida) values('$codPedido','$bbd') ");
			$dadoBebida = mysqli_query($conexao, " select valor_bebida from bebida where cod_bebida='$bbd' ");
			$umaBebida = $dadoBebida->fetch_assoc();
			$val += $umaBebida['valor_bebida'];

		}
		$i += 1;
	}


	// foreach ($bebidasPedido as $bebida) {
	// 	if ($bebida != '') {
	// 		for ($i=0; $i < ($cont-1); $i++) { 
	// 			$x = $qtdBebida[($i)];
	// 			echo "<br>x ".$x;
	// 			for ($j=0; $j < $x; $j++) {
	// 				echo "<br>i ".$i;
	// 				mysqli_query($conexao, " insert into aux_pedido_bebida (cod_pedido, cod_bebida) values('$codPedido','$bebidasPedido[$j]') ");
	// 				$dadoBebida = mysqli_query($conexao, " select valor_bebida from bebida where cod_bebida='$bebida' ");
	// 				$umaBebida = $dadoBebida->fetch_assoc();
	// 				$val += $umaBebida['valor_bebida'];
	// 			}
	// 		}
	// 	}
	// }
	// echo $val;




}










?>

</head>
<body>

<form>
	<b>Bebidas disponiveis:</b><br>
	*escolha até 3 opções<br>
	<br>

	<b>Bebida:</b>
	<select name='bebidasPedido[]'>
		<?php
		echo "<option value='' >------</option>";
		$dadosBebidas = mysqli_query($conexao, " select * from bebida ");
		while ($umaBebida = $dadosBebidas->fetch_assoc()) { 
			echo "<option value='".$umaBebida['cod_bebida']."' >".$umaBebida['nome_bebida']."</option>";
		} ?>
	</select>
	<b>Quantidade: <input type='text' name='quantBebida[]'><br>
	<br>

	<b>Bebida:</b>
	<select name='bebidasPedido[]'>
		<?php
		echo "<option value='' >------</option>";
		$dadosBebidas = mysqli_query($conexao, " select * from bebida ");
		while ($umaBebida = $dadosBebidas->fetch_assoc()) { 
			echo "<option value='".$umaBebida['cod_bebida']."' >".$umaBebida['nome_bebida']."</option>";
		} ?>
	</select>
	<b>Quantidade:</b> <input type='text' name='quantBebida[]'><br>
	<br>

	<b>Bebida:</b>
	<select name='bebidasPedido[]'>
		<?php
		echo "<option value='' >------</option>";
		$dadosBebidas = mysqli_query($conexao, " select * from bebida ");
		while ($umaBebida = $dadosBebidas->fetch_assoc()) { 
			echo "<option value='".$umaBebida['cod_bebida']."' >".$umaBebida['nome_bebida']."</option>";
		} ?>
	</select>
	<b>Quantidade:</b> <input type='text' name='quantBebida[]'><br>

	<input type="hidden" name="codPedido"<?php echo " value='$codPedido'";  ?> >
	<input type="hidden" name="codUsuario"<?php echo " value='$codUsuario'";  ?> >
	<br>

	<input type="submit">
</form>



</body>
</html>