<?php
session_start();

if (isset($_POST['username']) and isset($_POST['password'])) {

	$mysqli = new mysqli("localhost", "root", "zubiri", "prueba");
	if ($mysqli->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	echo $mysqli->host_info . "\n";


	$usu=$_POST['username'];
	$pass=$_POST['password'];

	$encrypted_pass=md5($pass);

	$pass=$encrypted_pass;

	$sql="select * from usuarios where username='$usu' and password='$pass'";

	$res=mysqli_query($mysqli, $sql);

	$nfilas=mysqli_num_rows($res);

	if ($nfilas > 0) {
		$fila=mysqli_fetch_array($res);
		$_SESSION['usu']=$usu;
		//echo "<br> Bienvenido";
		header('location:inicio.php');
	} else {
		echo "<br> No estas registrado <br>";
	}

	echo "<a href='registrar.php'> Registrarse </a>";
	echo "<br> <a href='index.html'> Iniciar Sesion </a>";
} else {
	echo "No has pasado por la pagina principal";
	header('location:index.html');
}
?>