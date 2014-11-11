
<html>
	<head>
	<?php include "plugins.php"; ?>
	</head>
	<body>
	
		<!--  -->
<div class="container fondoForo">
<?php
session_start();
if (!isSet($_SESSION['usuario'])) {
		header("Location:index.php");
		exit();
	}
		include "conexion.inc";
		if (isSet($_POST['crearHilo'])) {
			if (isSet($_POST['titulo']) && $_POST['titulo'] != '' && isSet($_POST['descripcion']) && $_POST['descripcion'] != '' && isSet($_SESSION['usuario']) && $_SESSION['usuario'] != '' && isSet($_POST['etiquetas']) && $_POST['etiquetas'] != '') {
				$titulo = $_POST['titulo'];
				$descripcion = $_POST['descripcion'];
				$etiquetas = $_POST['etiquetas'];
				$etiquetas = strtolower($etiquetas);
				$usuario = $_SESSION['usuario'];
				$q = mysqli_query($con, "INSERT INTO hilos VALUES ('', '$titulo', '$descripcion', '$usuario', '0', '0', '$etiquetas')") or die(mysql_error());
				if ($q) {
					echo '<div class="row alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>you thread has been created. </div>';
				}else
					echo '<div class="row alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>creacion del hilo ha fallado :/. </div>';
			}
		}
		$novedad = '';
		$nq = mysqli_query($con, "SELECT * FROM (SELECT * FROM hilos ORDER BY id DESC LIMIT 10) t ORDER BY id ASC");
		if (mysqli_num_rows($nq) > 0) {
			while ($row = mysqli_fetch_array($nq)) {
				$novedad .= '<tr><td><a href="paginaDelHilo.php?tid='.$row["id"].'">'.$row["titulo"].'</td> <td>'.$row["contenido"].'</td></tr>';
			}
		}
	// } else
	// 		echo'<script>window.location="index.php" </script>';

?>
<nav class="row navbar navbar-inverse">
	<div class="col-xs-12 col-md-6 navUsuario ">
		<?php echo " <p class='usuario2 bienvenidoUsuario'><strong> Bienvenid@: ".$_SESSION['usuario']." </strong></p>"; ?>
	</div>
	<div class="col-xs-12 col-md-6 navUsuario">
		<form class="form-inline" action="buscarHilos.php" method="POST" role="form">
			<div class="form-group ">
				<input class="form-control " type='text' name='busquedaConsulta' placeholder="#Etiquetas" required/>
			</div>
			<div class="form-group">
				<button class="btn btn-primary buscar" type='submit' name='busquedaEnviado'> Buscar Tema</button>
				<a class="btn btn-danger salir" href="cerrarsesion.php"> Cerrar Sesion</a>
			</div>
		</form>
	</div>
	
</nav>

	<section class="row">
		<div class="col-md-6">
			<table>
			<tbody>
				<?php
					$qu = mysqli_query($con, "SELECT * FROM hilos");
					if (mysqli_num_rows($qu) > 0) {
						while ($row = mysqli_fetch_array($qu)) {
							$contenido = $row['contenido'];
							if (strlen($contenido) > 100) {
								$a = $contenido;
								$contenido = '';
								for($i=0;$i<100;$i++) {
									$contenido .= $a[$i];
								}
							}
							// echo '<tr><td><a href="paginaDelHilo.php?id='.$row["id"].'">'.$row["titulo"].'</td><td>'.$contenido.'...</td></tr>';
						}
					}else{
						echo '<tr><td><div class="alert alert-warning alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>creacion del hilo ha fallado :/. </div></tr></td>';
					}
				?>
			</tbody>
		</table>
		<br/>
		<table class="table table-condensed table-bordered fondoTabla">
		<thead>
			
		</thead>
			<thead>
				<tr class="tituloTabla">
					<th><strong>Temas</strong></th>
					<th><strong>Descripcion</strong></th>
				</tr>
			</thead>
			<tbody>
				<?php echo $novedad; ?>
			</tbody>
		</table>
		</div>
			
		<div class="col-md-6">
				<form action="foro.php" method="POST" role="form">
					<div class="login-form">
					<legend>Crear tema de conversacion</legend>
						<div class="form-group ">
								<input class="form-control" type='text' name='titulo' placeholder="Titulo" required/>
								<label class="login-field-icon escribir" ></label>
						</div>
					<div class="form-group">
								<textarea class="form-control" rows="3" name="descripcion" placeholder="contenido" required></textarea>
								<label class="login-field-icon contenido" ></label>
					</div>
					<div class="form-group ">
								<input class="form-control" type='text' name='etiquetas' placeholder="Etiquetas" required/>
								<label class="login-field-icon etiqueta" ></label>
					</div>
						<button class="btn btn-primary nuevo" type='submit' name='crearHilo'/>Crear Tema</button>
					</div>
				</form>
		</div>
	</section>
</div>
	</body>
</html>