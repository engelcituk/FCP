
<meta charset="utf-8">
<?php
	session_start();
	if (!isSet($_SESSION['usuario'])) {
		header("Location:index.php");
		exit();
	}
	include "conexion.inc";
	include "plugins.php";
	if (isSet($_POST['suscribe']) && isSet($_GET['tid']) && isSet($_POST['email']) && $_POST['email'] != '') {
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
				if ($qu) { echo '<p class=" alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Suscrito exitosamente</strong><p>'; echo '<meta http-equiv="refresh" content="1; url=paginaDelHilo.php?tid='.$_GET["tid"].'">';
				} else echo '<p class=" alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>fallo en la suscripcion dado el id de la tema con el mail dado</strong><p>'; echo '<meta http-equiv="refresh" content="1; url=paginaDelHilo.php?tid='.$_GET["tid"].'">';
			} else echo '<p class=" alert alert-warning alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>El mail dado ya esta suscrito a la conversacion!</strong><p>'; echo '<meta http-equiv="refresh" content="1; url=paginaDelHilo.php?tid='.$_GET["tid"].'">';
		} 

		$qu = mysqli_query($con, "SELECT * FROM suscripciones WHERE IDhilo='$id'");
			if (mysqli_num_rows($qu) > 0) {
	    $mensaje = 'Una nueva respuesta a sido enviada a la conversacion a la que estas suscrito';
	     while ($fila = mysqli_fetch_array($qu)) {
		mail($fila['email'], 'Nueva Respuesta', $mensaje);
	 }
  }
 }
?>

