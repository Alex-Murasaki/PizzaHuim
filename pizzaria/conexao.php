<?php  

define('HOST', 'localhost');
define('USER', 'root');
define('SENHA', '');
define('BD', 'pizzaria');

$conexao = new mysqli(HOST, USER, SENHA, BD) or die('Erro ao se conectar com o banco.');

?>