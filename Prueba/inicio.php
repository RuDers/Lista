<?php
session_start();

if (isset($_SESSION['usu'])) {
	echo "Bienvenido";
} else {
	echo "aa";
	//header('location:index.html');
}
?>