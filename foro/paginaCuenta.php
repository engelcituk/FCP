<?php
	session_start();
	if (!isSet($_SESSION['usuario'])) {
		header("Location:index.php");
		exit();
		echo 'You must be logged in to access this page, redirecting...';
	}
	include "conexion.inc";
	include "plugins.php";
	$hilos = '<table><tbody>';
	$mensajes = '<table><tbody>';
	$usuario = $_SESSION['usuario'];
	// $q = mysqli_query($con, "SELECT * FROM mensajes WHERE a='$usuario'");
	$q2 = mysqli_query($con, "SELECT * FROM hilos WHERE autor='$usuario'");
	// if (mysqli_num_rows($q) > 0) {
	// 	while ($row = mysqli_fetch_array($q)) {
	// 		$mensajes .= '<tr><td>'.$row["mensaje"].'</td><td>From: </td><td>'.$row["de"].'</td></tr>';
	// 	}
	// }
	if (mysqli_num_rows($q2) > 0) {
		while ($row = mysqli_fetch_array($q2)) {
			$hilos .= '<tr><td><a href="paginaDelHilo.php?tid='.$row["id"].'">'.$row["titulo"].'</td></tr>';
		}
	}
	// $mensajes .= '</tbody></table>';
	$hilos .= '</tbody></table>';
	if (isSet($_POST['cambiarContrasena']) && isSet($_POST['nuevaContrasena']) && isSet($_POST['nuevaContrasena2']) && isSet($_POST['contraActual']) && $_POST['contraActual'] != '' && $_POST['nuevaContrasena'] != '' && $_POST['nuevaContrasena2'] != '') {
		$new = $_POST['nuevaContrasena'];
		$new2 = $_POST['nuevaContrasena2'];
		if ($new == $new2) {
			$new = md5($new);
			$cur = $_POST['contraActual'];
			$cur = md5($cur);
			$usuario = $_SESSION['usuario'];
			$q = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario='$usuario'");
			if (mysqli_num_rows($q) > 0) {
				$info = mysqli_fetch_array($q);
				$info['contrasena'].' : '.$cur;
				if ($info['contrasena'] == $cur) {
					$qq = mysqli_query($con, "UPDATE usuarios SET contrasena='$new' WHERE usuario='$usuario'") or die(mysql_error());
					if ($qq) {
						echo '<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Contraseña actualizada :) !. </div>';
					}else
						echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>creacion de nueva contraseña ha fallado :/. </div>';
				}else
					echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>la contraseña actual ingresada no fue correcta :/. </div>';
			}else
				echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Su usuario no fue encontrada en la base de datos :/. </div>';
		}else
			echo '<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>las dos contraseñas no coinciden. Por favor asegurate que coincidand y que el campo de la actual contrasena sea correcta luego intenta de nuevo:/. </div>';
		
	}
?>
<html>
	<head></head>
	<body>
		<div class='container'>
			<div class="row">
				<div class="col-md-6">
					<div class="jumbotron">
						<div class="alert alert-info"><?php echo $usuario; ?></div>
						<p class="well"><?php echo $hilos; ?></p>
					</div>
				</div>
			<!-- <h1>My mensajes:</h1> 
			<?php //echo $mensajes; ?>-->
				<div class="col-md-6">
					<div class="login-form">
							<legend>Change contrasena:</legend>
								<form action='paginaCuenta.php' method='POST'>
									<div class="form-group">
										<input class="form-control" type='password' name='contraActual' placeholder="Current contrasena:" required/>
										<label class="login-field-icon candado" ></label>
									</div>
									<div class="form-group">
										<input class="form-control" type='password' name='nuevaContrasena' placeholder="New contrasena:" required/>
										<label class="login-field-icon candado2" ></label>
									</div>
									<div class="form-group">
										<input class="form-control" type='password' name='nuevaContrasena2' placeholder="New contrasena (confirm):" required/>
										<label class="login-field-icon candado2" ></label>
									</div>
									<button class="btn btn-info nuevo" type='submit'  name='cambiarContrasena'/> Change contrasena</button>
								</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>