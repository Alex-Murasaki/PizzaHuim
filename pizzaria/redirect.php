<?php
include('verificaLogin.php');
include('conexao.php');
$user = $_SESSION['nomeUsuario'];
$query = " select cod_usuario, tipo_usuario from usuario where nome_usuario='{$user}'";

$resul = mysqli_query($conexao, $query);
$resul = $resul->fetch_assoc();

$codUsuario = $resul['cod_usuario'];
switch ($resul['tipo_usuario']) {
	case 0: // Admin
		echo " <meta http-equiv='refresh' content='1; URL=menuAdmin.php?codUsuario={$codUsuario}'/> ";
		break;
	case 1: // Cliente
		echo " <meta http-equiv='refresh' content='1; URL=menuCliente.php?codUsuario={$codUsuario}'/> ";
		break;
	case 2: // Entregador
		echo " <meta http-equiv='refresh' content='1; URL=menuEntregador.php?codUsuario={$codUsuario}'/> ";
		break;
	case 3: // Cozinheiro
		echo " <meta http-equiv='refresh' content='1; URL=pedidosAbertos.php?codUsuario={$codUsuario}'/> ";
		break;
	case 4: // Gerente
		echo " <meta http-equiv='refresh' content='1; URL=menuGerente.php?codUsuario={$codUsuario}'/> ";
		break;
}

?>
<!--
<h2><?php //echo $_SESSION['nomeUsuario'] ?> logado!</h2>
<h2><a href="logout.php?">Sair</a></h2>
-->



