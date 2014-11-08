<?php
	session_start();
	include "conexion.inc";
	if (isSet($_POST['enviar']) && isSet($_POST['usuario']) && isSet($_POST['contrasena']) && $_POST['usuario'] != '' && $_POST['contrasena'] != '') {
		$contrasena = $_POST['contrasena'];
		$contrasenaMD5 = md5($contrasena);
		$usuario = $_POST['usuario'];
		$q = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario='$usuario'");
		if (mysqli_num_rows($q) > 0) {
			echo 'Este nombre de usuario ya está tomado.';
		}else{
			$qq = mysqli_query($con, "INSERT INTO usuarios VALUES ('', '$usuario', '$contrasenaMD5')");
			if ($qq) {
				echo 'Registrado Exitosamente!';
			}else
				echo 'Registro Fallado.';
		}
	}
?>