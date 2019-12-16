<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Funcionarios</title>
	<h1>Cadastrar Funcionarios</h1>

<?php 
include('conexao.php');
$codUsuario=$_REQUEST['codUsuario'];
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

<form>
	Nome:<br><input type="text" name="nomeUsuario"><br>
	CPF:<br><input type="text" name="cpfUsuario"><br>
	Senha:<br><input type="password" name="senhaUsuario"><br>
	Cargo:<br><input type="radio" name="tipoUsuario" value="2">Entregador<input type="radio" name="tipoUsuario" value="3">Cozinheiro<br>
	<?php echo "<input type='hidden' name='codUsuario' value='$codUsuario'> " ?>
	<input type="submit">
</form><br><?php
echo "<a href='menuGerente.php?codUsuario=$codUsuario'>Voltar</a>" ?>
</body>
</html>