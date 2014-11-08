<?php
	session_start();
	include "plugins.php";
	include "conexion.inc";
	if (isSet($_POST['enviar']) && isSet($_POST['usuario']) && isSet($_POST['email']) && isSet($_POST['contrasena']) && $_POST['usuario'] != ''&& $_POST['email'] != '' && $_POST['contrasena'] != '') {
		$contrasena = $_POST['contrasena'];
		$contrasenaMD5 = md5($contrasena);
		$usuario = $_POST['usuario'];
		$email = $_POST['email'];
		$q = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario='$usuario'");
		if (mysqli_num_rows($q) > 0) {
			echo 'Este nombre de usuario ya está tomado.';
		}else{
			$qq = mysqli_query($con, "INSERT INTO usuarios VALUES ('', '$usuario','$email', '$contrasenaMD5')");
			if ($qq) {
				echo '<div class="row alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Registrado exitosamente, ahora pued iniciar sesion. <meta http-equiv="refresh" content="2; url=index.php"></div>';
			}else
				echo '<div class="row alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Su registro tuvo un fallo :/. <meta http-equiv="refresh" content="2; url=index.php"></div>';
		}
	}
?>