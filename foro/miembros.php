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

				<?php if (isSet($lista)){ echo $lista; } ?>
			</div>
		</div>
	</body>
</html>