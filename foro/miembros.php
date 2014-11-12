<?php
	session_start();
	if (!isSet($_SESSION['usuario'])) {
		header("Location:index.php");
		exit();
	}
	include "conexion.inc";
	include "plugins.php";
	$q = mysqli_query($con, "SELECT * FROM usuarios ");
	if (mysqli_num_rows($q) > 0) {
		$lista = '<div class="panel panel-success"><div class="panel-heading  registrados"> Usuarios Registrados</div>';
		while ($fila = mysqli_fetch_array($q)) {
			$lista .= ' <div class="panel-body well contenidoLista"><span class="usuario"></span> <a href="paginaUsuario.php?usuario='.$fila["usuario"].'">'.$fila["usuario"].'</a></div>';
		}
		$lista .= '</div>';
	}
?>
<html>
	<head>
	<meta charset="utf-8">
		<title>Miembros</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="navbar navbar-inverse">
					<div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 navUsuario">
						<ul>
							<li class="dropdown">
							<a href="#" class="dropdown-toggle usuario2 bienvenidoUsuario"data-toggle="dropdown"><span> </span>Miembros</a>" 
								<ul class="dropdown-menu">
									<li><a href="foro.php">Ir a foro</a></li>
									<li><a href="paginaCuenta.php">Ver mi pagina de cuenta</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class=" col-xs-6 col-sm-6 col-md-offset-8 col-md-2 col-md-offset-8 col-lg-1 navUsuario">
						<a href="cerrarsesion.php" class="btn btn-danger salir"> Cerrar Sesion</a>
					</div>
				</div>

				<?php if (isSet($lista)){ echo $lista; } ?>
			</div>
		</div>
	</body>
</html>