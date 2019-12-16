<?php
session_start();
include('conexao.php');

if (isset($_REQUEST['nomeUsuario']) && isset($_REQUEST['senhaUsuario'])) {
	$nomeUsuario = mysqli_real_escape_string($conexao, $_REQUEST['nomeUsuario']);
	$senhaUsuario = mysqli_real_escape_string($conexao, $_REQUEST['senhaUsuario']);

	$query = " select cod_usuario, nome_usuario from usuario where nome_usuario='{$nomeUsuario}' and senha_usuario=md5('{$senhaUsuario}') ";

	$resul = mysqli_query($conexao, $query);
	$row = mysqli_num_rows($resul);

	if ($row == 1) {
		$_SESSION['nomeUsuario'] = $nomeUsuario;
		header('Location: redirect.php');
		exit();
	} else {
		$_SESSION['invalido'] = true;
		header('Location: index.php');
		exit();
	}


} else{

	header('Location: index.php');
	exit();
}




?>