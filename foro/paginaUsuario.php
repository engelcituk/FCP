<?php
	session_start();
	if (!isSet($_SESSION['usuario'])) {
		header("Location:index.php");
		exit();
	}
	include "conexion.inc";
	include "plugins.php";
	$hilos = '<table><tbody>';
	if (isSet($_GET['usuario']) && $_GET['usuario'] != '') {
		$usuario = $_GET['usuario'];
		$q = mysqli_query($con, "SELECT * FROM hilos WHERE autor='$usuario'");
		if (mysqli_num_rows($q) > 0) {
			while ($fila = mysqli_fetch_array($q)) {
				$hilos .= '<tr><td><a href="paginaDelHilo.php?tid='.$fila["id"].'">'.$fila["titulo"].'</td></tr>';
			}
			$hilos .= '</tbody></table>';
		}else
			$noMostrar = true;
	}
	// if (!isSet($noMostrar) && isSet($_POST['mensajeEnviado']) && isSet($_POST['mensaje']) && $_POST['mensaje'] != '') {
	// 	$mensaje = $_POST['mensaje'];
	// 	$de = $_SESSION['usuario'];
	// 	$a = $_GET['usuario'];
	// 	$q = mysqli_query($con, "INSERT INTO mensajes VALUES ('', '$de', '$mensaje', '$a')");
	// 	if ($q) {
	// 		echo 'Message sent.';
	// 	}else
	// 		echo 'Failed to send message, contact the site administrator.';
	// }
	
	if (!isSet($noMostrar)) {
	echo "
	<html>
		<head>
			<title>Pagina del usuario</title>
		</head>
		<body>
				<div class='container'>
				<div class='row navbar navbar-inverse'>
					<div class='col-xs-6 col-sm-6 col-md-2 col-lg-2 navUsuario'>
						<p class='bienvenidoUsuario usuario2'> $usuario</p>
					</div>
					<div class=' col-xs-6 col-sm-6 col-md-offset-8 col-md-2 col-md-offset-8 col-lg-1 navUsuario'>
						<a href='cerrarsesion.php' class='btn btn-danger salir'> Cerrar Sesion</a>
					</div>
				</div>
					<div class='row'>
							<!-- inicio de seccion de temas creados por el usuario-->
						<div class='col-md-12'>
							<div class='panel panel-success'>
								<div class='panel-heading'>
									Temas creados
								</div>
								<div class='panel-body'>
									$hilos
								</div>
								<div class='panel-footer'>
									Por $usuario
								</div>
							</div>
						</div>
							<!-- fin de seccion de temas creados por el usuario-->
					</div>

					<div class='row'>
							<!-- inicio de formulario de contacto para mensaje
						<div class='col-md-6'>
							<form action='paginaUsuario.php?usuario=$usuario' method='POST'>
								<div class='login-form'>
									<div class='form-group'>
										<legend>Enviar mensaje a $usuario</legend>
											<textarea class='form-control' rows='3' name='mensaje' placeholder='Mensaje' required/></textarea>
											
									</div>
											<button class='btn btn-info conversacion' type='submit' name='mensajeEnviado'/> Enviar Mensaje</button>
								</div>
							</form>
						</div>
					</div>
							fin de formulario de contacto para mensaje-->
				</div>
			</body>
		</html>";
	}else
		echo 'Este usuario aun no tiene temas creados!';
?>

<!-- <div class="form-group">
								<textarea class="form-control" rows="3" name="descripcion" placeholder="contenido" required></textarea>
								<label class="login-field-icon contenido" ></label>
					</div> -->