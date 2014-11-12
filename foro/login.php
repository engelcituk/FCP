<meta charset="utf-8">
<?php
include "plugins.php";
	session_start();
	if (isSet($_SESSION['username'])) {
		header("Location:foro.php");
		exit();
		echo "Usted ya está en el sistema, volver a dirigir a hilos lista de páginas / index ...";
	}
	include "conexion.inc";
	if (isSet($_POST['login']) && isSet($_POST['usuario']) && isSet($_POST['contrasena']) && $_POST['usuario'] != '' && $_POST['contrasena'] != '') {
		$contrasena = $_POST['contrasena'];
		$contrasenaMD5 = md5($contrasena);
		$usuario = $_POST['usuario'];
		$q = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario='$usuario'");
		if (mysqli_num_rows($q) > 0) {
			$info = mysqli_fetch_array($q);
			$storedPassword = $info['contrasena'];
			if ($storedPassword == $contrasenaMD5) {
				$_SESSION['usuario'] = $usuario;
				header("Location:foro.php");
				exit();
				echo '<div class="row alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>CONECTADO !. </div>'; 
			}else
				echo '<div class="row alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>la contraseña es incorrecta, por favor intentalo de nuevo :/.<meta http-equiv="refresh" content="2; url=index.php"></div>.';
		}else
			
			echo '<div class="row alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>El nombre de usuario no fue encontrado, por favor intentalo de nuevo :/. <meta http-equiv="refresh" content="2; url=index.php"></div>
					';

	}
?>
