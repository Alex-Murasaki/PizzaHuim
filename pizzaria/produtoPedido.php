<!DOCTYPE html>
<html>
<head>
	<title>Monte sua pizza!</title>
	<h1>Monte sua pizza para adiconar ao pedido!
	<?php
	include('conexao.php');
	$codCliente = $_REQUEST['codCliente'];
	echo " ID: 0".$codCliente."."?></h1>
	<hr>

<?php
// Tem o sabor de pizza1?
if (isset($_REQUEST['pizza1'])) {
	$pizza1 = $_REQUEST['pizza1'];
	$extraPizza = $_REQUEST['extraPizza'];
	$gorjetaPedido = $_REQUEST['gorjetaPedido'];

	// CADASTRANDO AS PIZZAS

	// Pega tudo que for pizza na tabela produto
	$dadosPizza = mysqli_query($conexao, " select * from produto where tipo_produto='1' ");

	// Laço pra pegar os valores da pizza1 e 2	
	while ($umaPizza = $dadosPizza->fetch_assoc()) {
		if (isset($_REQUEST['pizza2'])) {  // Sabor 2 foi cadastrado?
			$pizza2 = $_REQUEST['pizza2']; // pega o sabor 2
			if ($umaPizza['cod_produto'] == $pizza1) { // Esse codigo é igual ao meu sabor 1?
				$val1 = $umaPizza['valor_produto'];    // Guarda o valor dele
			}
			if ($umaPizza['cod_produto'] == $pizza2) { // Esse codigo é igual ao meu sabor 2?
				$val2 = $umaPizza['valor_produto'];    // Guarda o valor dele
			}
		} else { // Se tiver só um sabor cadastrado
			if($umaPizza['cod_produto'] == $pizza1){ // Esse código é igual ao meu sabor 1?
				$val1 = $umaPizza['valor_produto'];  // Guarda o valor dele
				$val2 = 0;                           // Valor do segundo sabor igual a zero
			}
		}
	}			

	// Vê qual é maior: 
	// Valor do Sabor 1 X Valor do Sabor 2
	if ($val1 > $val2) {
		$valTotal = $val1;
	} else {
		$valTotal = $val2;
	}
    
    // Cria o novo pedido
	mysqli_query($conexao, " INSERT INTO pedido(status_pedido, valor_pedido,extra_pedido) VALUES ('0','$valTotal','$extraPizza') ");
	
	// Pega o ultimo codigo (no caso, do pedido)
	$codPedido = $conexao->insert_id;

	// Insere os sabores que estiverem setados
		if (isset($_REQUEST['pizza1'])){
			mysqli_query($conexao, " INSERT INTO aux_pedido_produto(cod_pedido, cod_produto) VALUES('$codPedido','$pizza1') ");
		}
		if (isset($_REQUEST['pizza2'])) {
			mysqli_query($conexao, " INSERT INTO aux_pedido_produto(cod_pedido, cod_produto) VALUES('$codPedido','$pizza2') ");
		} 

	// Insere na auxiliar, cada usuario terá vários pedidos, ao invés de um pedido ter várias pizzas. Basta que tenham o mesmo tempo de entrega, e serão entregues ao mesmo tempo.
	mysqli_query($conexao, " INSERT INTO aux_usuario_pedido(cod_usuario, cod_pedido) VALUES('$codCliente','$codPedido') ");

	// CADASTRANDO AS BEBIDAS

	$qtdBebida = $_REQUEST['qtdBebida'];
	$bebidasPedido = $_REQUEST['bebidaPedido'];
	$elementos = count($qtdBebida);
	$cont = 0;
	for ($i=0; $i < $elementos; $i++) { 
		if ($qtdBebida[$i] != '') {
			$cont += 1;
		}
	}

	$val = 0;

	$contBebidas =  count($bebidasPedido);
	// Insere as bebidas na aux_pedido_bebida
	$i= 0;
	$valBebida = 0;
	if ($contBebidas = 1) {
		mysqli_query($conexao, " insert into aux_pedido_produto (cod_pedido, cod_produto) values('$codPedido','".$bebidasPedido[0]."') ");
		$dadoBebida = mysqli_query($conexao, " select valor_produto from produto where cod_produto='".$bebidasPedido[0]."' ");
		$umaBebida = $dadoBebida->fetch_assoc();
		$valBebida += $umaBebida['valor_produto'];	
	} else {
		foreach ($bebidasPedido as $bbd) {
			for ($j=0; $j < $qtdBebida[$i]; $j++) { 
				mysqli_query($conexao, " insert into aux_pedido_produto (cod_pedido, cod_produto) values('$codPedido','$bbd') ");
				$dadoBebida = mysqli_query($conexao, " select valor_produto from produto where cod_produto='$bbd' ");
				$umaBebida = $dadoBebida->fetch_assoc();
				$valBebida += $umaBebida['valor_produto'];
			}
			$i += 1;
		}
	}
	$valTotal += $valBebida;
	if ($gorjetaPedido == 1) {
		$valGorjeta = $valTotal*0.10;
		mysqli_query($conexao, " UPDATE pedido SET valor_pedido=$valTotal, valGorjeta_pedido=$valGorjeta WHERE cod_pedido=$codPedido ");
	} else {
		mysqli_query($conexao, " UPDATE pedido SET valor_pedido=$valTotal WHERE cod_pedido=$codPedido ");
	}

	echo "Cadastro realizado meu parceiro!";

}?>

</head>
<body>
<!-- A -->

<!-- Montagem das pizzas! Onde será adiconado tudo que ela conter. -->
<form>
	<!-- Adiconar o primeiro sabor da pizza -->
	<b>Selecione o primeiro sabor:</b><br>
	*obrigatório<br>
	<br>
	<?php
		$dadosPizza = mysqli_query($conexao, " select * from produto where tipo_produto='1' ");
		while ($umaPizza = $dadosPizza->fetch_assoc()) {
			echo "<input type='radio' name='pizza1' value='".$umaPizza["cod_produto"]."'/>".$umaPizza["nome_produto"];
			echo "<br><b>Descrição:</b> ".$umaPizza['descricao_produto']."<br><br>";
		}
	?>
	<hr>

	<!-- Adicionar o segundo sabor da pizza -->
	<b>Selecione o segundo sabor:</b><br>
	<br>
	<?php
		$dadosPizza = mysqli_query($conexao, " select * from produto where tipo_produto='1' ");
		while ($umaPizza = $dadosPizza->fetch_assoc()) {
			echo "<input type='radio' name='pizza2' value='".$umaPizza["cod_produto"]."'/>".$umaPizza["nome_produto"];
			echo "<br><b>Descrição:</b> ".$umaPizza['descricao_produto']."<br><br>";
		}
	?>
	<hr>

	<b>Deseja algum extra? Escolha!</b><br>
	<br><?php
		$dadosExtra = mysqli_query($conexao, " select * from extra ");
		while ($umExtra = $dadosExtra->fetch_assoc()) {
			echo "<input type='radio' name='extraPizza' value='".$umExtra["cod_extra"]."'/>".$umExtra["nome_extra"];
		}
	?><br>
	<br>
	<hr>
	<b>Quer beber alguma coisa?</b><br>
	Selecione a bebida e a quantidade, por favor.<br>
	<br><?php
		$dadosBebida = mysqli_query($conexao, " SELECT * FROM produto WHERE tipo_produto='2'  ");
		while ($umaBebida = $dadosBebida->fetch_assoc()) {
			echo "<input type='checkbox' name='bebidaPedido[]' value='".$umaBebida['cod_produto']."' />".$umaBebida['nome_produto']." - ";
			echo "<input type='text' size='2' name='qtdBebida[]'> }<br><br>";
		}
	?>
	<b>Vai dar gorjeta pro entregador?</b><br>
	<input type="radio" name="gorjetaPedido" value="1">Sim<input type="radio" name="gorjetaPedido" values="0">Não<br>
	<br>

	<?php
	echo "<input type='hidden' name='codCliente' value='$codCliente'> ";
	?>
	<input type="submit">
</form>

<!-- Volta pra pag anterior -->
<br>
<?php echo " <a href='mostraPedido.php?codCliente=$codCliente'>Voltar</a> " ?>

</body>
</html>