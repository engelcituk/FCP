
<html>
	<head>
	<?php include "plugins.php"; ?>
	</head>
	<body>
	
		<!--  -->
<div class="container">
<?php
session_start();
if(isset($_SESSION['usuario']))
	{
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
		$nq = mysqli_query($con, "SELECT * FROM (SELECT * FROM hilos ORDER BY id DESC LIMIT 5) t ORDER BY id ASC");
		if (mysqli_num_rows($nq) > 0) {
			while ($row = mysqli_fetch_array($nq)) {
				$novedad .= '<tr><td><a href="paginaDelHilo.php?tid='.$row["id"].'">'.$row["titulo"].'</td> <td>'.$row["contenido"].'</td></tr>';
			}
		}
	} else
			echo'<script>window.location="index.php" </script>';

?>
<nav class="row navbar navbar-default">
	<div class="col-md-4">
		<?php echo "<strong>Bienvenido :".$_SESSION['usuario']." </strong>"; ?>
	</div>
	<div class="col-md-4">
		<form class="form-inline" action="buscarHilos.php" method="POST" role="form">
			<div class="form-group ">
				<input class="form-control" type='text' name='busquedaConsulta' placeholder="#Etiquetas" required/>
				<!-- <label class="login-field-icon candado" ></label> -->
			</div>
			<div class="form-group ">
				<input class="btn btn-primary" type='submit' value='Buscar Hilo' name='busquedaEnviado'/>
			</div>
		</form>

		<!-- <form action='buscarHilos.php' method='POST'>
			<table border='0'>
				<tbody>
					<tr>
						<td><input type='text' name='busquedaConsulta' /></td>
					</tr>
					<tr>
						<td><input type='submit' value='Search' name='busquedaEnviado' /></td>
					</tr>
				</tbody>
			</table>
		</form> -->
	</div>
	<div class="col-md-4">
		<a class="btn btn-danger" href="cerrarsesion.php">Cerrar Sesion</a>
	</div>
</nav>

	<section class="row">
		<div class="col-md-3">
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
		<table class="table table-striped table-bordered">
		<thead>
			
		</thead>
			<thead>
			<tr>
				<th><strong>HILOS</strong></th>
				<th><strong>DESCRIPCION</strong></th>
			</tr>
			</thead>
			<tbody>
				<?php echo $novedad; ?>
			</tbody>
		</table>
		</div>
		<div class="col-md-3">
				<!-- <form action="buscarHilos.php" method="POST" role="form">
					<div class="login-form">
						<div class="form-group ">
							<input class="form-control" type='text' name='etiquetas' placeholder="#Etiquetas" required/>
							<label class="login-field-icon candado" ></label>
						</div>
						<input class="btn btn-primary" type='submit' value='Buscar Hilo' name='crearHilo'/>
					</div>
				</form> -->
		</div>
		<div class="col-md-6">
				<form action="foro.php" method="POST" role="form">
				<div class="login-form">
				<legend>Crear hilo de conversacion</legend>
					<div class="form-group ">
							<input class="form-control" type='text' name='titulo' placeholder="Titulo" required/>
							<label class="login-field-icon escribir" ></label>
					</div>
				<div class="form-group">
							<textarea class="form-control" rows="3" name="descripcion" required></textarea>
							<label class="login-field-icon escribir" ></label>
				</div>
				<div class="form-group ">
							<input class="form-control" type='text' name='etiquetas' placeholder="Etiquetas" required/>
							<label class="login-field-icon candado" ></label>
				</div>
					<input class="btn btn-primary" type='submit' value='Crear Hilo' name='crearHilo'/>
				</div>
				</form>
		</div>
	</section>
</div>
	</body>
</html>