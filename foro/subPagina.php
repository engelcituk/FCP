<?php
	session_start();
	include "conexion.inc";
	if (isSet($_POST['suscribe']) && isSet($_GET['tid']) && isSet($_POST['email'])) {
		$email = $_POST['email'];
		$id = $_GET['tid'];
		$hasAt = false;
		$hasDot = false;
		for ($i=0;$i<strlen($email);$i++){
			if ($email[$i] == '@')
				$hasAt = true;
			if ($email[$i]== '.')
				$hasDot = true;
		}
		if ($hasAt && $hasDot) {
			$q = mysqli_query($con, "SELECT * FROM suscripciones WHERE email='$email' AND IDhilo='$id'");
			if (mysqli_num_rows($q) <= 0) {
				$qu = mysqli_query($con, "INSERT INTO suscripciones VALUES ('', '$id', '$email')");
				if ($qu) { echo 'Suscrito exitosamente.';
				} else echo 'fallo en la suscripcion dado el id de la tema con el mail dado';
			} else echo 'El mail dado ya esta suscrito a la conversacion!';
		} 

		$qu = mysqli_query($con, "SELECT * FROM suscripciones WHERE IDhilo='$id'");
			if (mysqli_num_rows($qu) > 0) {
	    $mensaje = 'Una nueva respuesta a sido enviada a la conversacion a la que estas suscrito';
	     while ($fila = mysqli_fetch_array($qu)) {
		mail($fila['email'], 'New Reply', $mensaje);
	 }
  }
 }
?>