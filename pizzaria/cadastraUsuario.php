<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <!-- Sem isso os acentos buggam -->
	<!-- <link rel='stylesheet' href='css/style.css'>  Importa o arquivo CSS -->
	<title>Cdastro de Usuários</title>
	<h1>Cadastre um Cliente</h1>
	<hr>

<?php 
/*
 * Faz p cadastro do usuário, caso ele não exista
 * no banco. Encripta a senha antes de gravá-la e
 * redireciona automaticamente após o cadastro,
 * para atela de login.
 */
include('conexao.php');
if (isset($_REQUEST['nomeUsuario'])) {
	$nomeUsuario = $_REQUEST['nomeUsuario'];
	$senhaUsuario = $_REQUEST['senhaUsuario'];
	$senhaCript = md5($senhaUsuario); // Encripta senha
	$cpfUsuario = $_REQUEST['cpfUsuario'];
	$tipoUsuario = $_REQUEST['tipoUsuario'];

	$dadosUsuario = mysqli_query($conexao, " select * from usuario ");
	$existe = false; // Chave para checar se já existe um usuario com esse nome

	while ($umUsuario = $dadosUsuario->fetch_assoc()) {
		if ($umUsuario['nome_usuario'] == $nomeUsuario) { // Verifica se há qualquer usuario em toda a tabela com o mesmo nome que está sendo cadastrado
			$existe = true; // Muda a váriavel, confirmando que existe um usuário
			echo "Já existe alguem com esse nome. Tente acrescentar '007gamer' ao final, ou tente: 'XxNOMExX'.<hr>"; // Mensagem tope com dica tope
		}
	}

	if (!$existe) { // Se NÂO existir um usuário com esse nome, ele irá criar um
		mysqli_query($conexao, " insert into usuario(nome_usuario,senha_usuario,cpf_usuario,tipo_usuario) values('$nomeUsuario','$senhaCript','$cpfUsuario','$tipoUsuario') ");
		echo "<p><b>Cadastrado com sucesso!</b></p><hr>";
		echo "<meta http-equiv='refresh' content='1; URL="."index.php"."'/>"; // Redireciona pag para o login
	}
} ?>
</head>
<body>
	<form action="cadastraUsuario"> <!-- Usa formatação CSS pra ficar bonitinho -->
			Nome de usuário:<br> <input type="text" name="nomeUsuario"><br>
			Senha:<br><input type="password" name="senhaUsuario"><br>
			CPF:<br><input type="text" name="cpfUsuario"><br>
			<input type="hidden" name="tipoUsuario" value="1">
			<input type="submit">
	</form><br>
<a href="index.php">Voltar</a> 
</body>
</html>