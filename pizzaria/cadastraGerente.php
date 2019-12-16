<!DOCTYPE html>
<html>
<head>
	<title>Cadastra Gerente</title>
	<h1>Cadastrar Gerente</h1>
	<hr>

<?php 
$codUsuario=$_REQUEST['codUsuario'];
include('conexao.php');
if (isset($_REQUEST['nomeUsuario'])) {
	$nomeUsuario = $_REQUEST['nomeUsuario'];
	$senhaUsuario = $_REQUEST['senhaUsuario'];
	$senhaCript = md5($senhaUsuario);
	$cpfUsuario = $_REQUEST['cpfUsuario'];
	$tipoUsuario = $_REQUEST['tipoUsuario'];

	$dadosUsuario = mysqli_query($conexao, " select * from usuario ");
	$existe = false;

	while ($umUsuario = $dadosUsuario->fetch_assoc()) {
		if ($umUsuario['nome_usuario'] == $nomeUsuario) {
			$existe = true;
			echo "Usuário já cadastrado.<hr>";
		}
	}

	if (!$existe) {
		mysqli_query($conexao, " insert into usuario(nome_usuario,senha_usuario,cpf_usuario,tipo_usuario) values('$nomeUsuario','$senhaCript','$cpfUsuario','$tipoUsuario') ");
		echo "<p><b>Cadastrado com sucesso!</b></p><hr>";
	}
}

?>

</head>
<body>

<form action="cadastraGerente.php">
	Nome:<br> <input type="text" name="nomeUsuario"><br>
	Senha:<br> <input type="password" name="senhaUsuario"><br>
	CPF:<br> <input type="text" name="cpfUsuario"><br>
	<input type="hidden" name="tipoUsuario" value="4"> <?php
	echo "<input type='hidden' name='codUsuario' value='$codUsuario'> " ?>
	<input type="submit">
</form><br><br><?php
echo "<a href='menuAdmin.php?codUsuario=$codUsuario'>Voltar</a>" ?>
</body>
</html>