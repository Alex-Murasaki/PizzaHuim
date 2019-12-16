<?php
session_start();
if(!$_SESSION['nomeUsuario']){
	header('Location: index.php');
	exit();
}







