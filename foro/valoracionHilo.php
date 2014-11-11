<?php
	session_start();
	include "conexion.inc" ;
	include "plugins.php" ;
	if (isSet($_GET['tid']) && isSet($_GET['puntuacion'])) {
		$id = $_GET['tid'];
		$puntuacion = $_GET['puntuacion'];
		if ($puntuacion > 5)
			$puntuacion = 5;
		if ($puntuacion < 1)
			$puntuacion = 1;
		$qu = mysqli_query($con, "SELECT * FROM hilos WHERE id='$id'") or die(mysql_error());
		if (mysqli_num_rows($qu) > 0) {
			$info = mysqli_fetch_array($qu) or die(mysql_error());
			$nuevaCalificacion = $info['puntuacionTotal']+1;
			$nuevoTotal = $info['puntuacion']+$puntuacion;
			$q = mysqli_query($con, "UPDATE hilos SET puntuacion ='$nuevoTotal', puntuacionTotal='$nuevaCalificacion' WHERE id='$id'") or die(mysql_error());
			if ($q) {
				echo '<p class=" alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Calificacion actualizada</strong><p>'; echo '<meta http-equiv="refresh" content="1; url=paginaDelHilo.php?tid='.$_GET["tid"].'">';
			}else
				echo '<p class=" alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>la actualizacion de la calificaicon a fallado</strong><p>';echo '<meta http-equiv="refresh" content="1; url=paginaDelHilo.php?tid='.$_GET["tid"].'">';
		}
	}else
		echo '<p class=" alert alert-warning alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>la informacion no se establecio correctamente</strong><p>';echo '<meta http-equiv="refresh" content="1; url=paginaDelHilo.php?tid='.$_GET["tid"].'">';
?>

<a href=""></a>