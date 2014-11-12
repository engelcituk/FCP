
<?php
	session_start();
	if (!isSet($_SESSION['usuario'])) {
		header("Location:index.php");
		exit();
	}
	include "plugins.php";
	include "conexion.inc";
	$usuario;
	if (isSet($_SESSION['usuario']))
		$usuario = $_SESSION['usuario'];
	if (isSet($_POST['respuestaEnviada']) && isSet($_POST['contenido']) && $_POST['contenido'] != '' && isSet($_GET['tid']) && $_GET['tid'] != '') {
		$contenido = $_POST['contenido'];
		$IDhilo = $_GET['tid'];
		$usuario = $_SESSION['usuario'];
		$q = mysqli_query($con, "INSERT INTO respuestas VALUES ('', '$IDhilo', '$contenido', '$usuario')");
		$qu = mysqli_query($con, "SELECT * FROM suscripciones WHERE IDhilo='$IDhilo'");
		if (mysqli_num_rows($qu) > 0) {
			$mensaje = 'Una nueva respuesta ha sido sometido a un hilo que se haya suscrito a '.$usuario.' had this to say:<br/>'.$contenido;
			while ($fila = mysqli_fetch_array($qu)) {
				mail($fila['email'], 'Nueva Respuesta', $mensaje);
			}
		}
		if ($q) {
			echo '<p class=" alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Respuesta enviada </strong><p>';
		}else
			echo '<p class=" alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Fallo en la insercion de la respuesta.</strong><p> ';
	}
	$respuestas = '';
	$id;

	$related = '<table>
					<tbody>
						<tr>';
							if (isSet($_GET['tid']) && $_GET['tid'] != '') {
								$id = $_GET['tid'];
								$consulta = mysqli_query($con, "SELECT * FROM hilos WHERE id='$id'");
								if (mysqli_num_rows($consulta) > 0) {
									$info = mysqli_fetch_array($consulta);
									//etiquetas for related hilos;
									$tagLine = $info['etiquetas'];
									$tagLineNoSpaces = str_replace(" ", "", $tagLine);
									$etiquetas = explode(",", $tagLineNoSpaces);
									$foundRelatedArticles = 0;
									$relatedArticleIDs = array();
									$relatedArticleTitles = array();
									$tagQ = mysqli_query($con, "SELECT * FROM hilos");
									$tInfo = mysqli_fetch_array($tagQ);
									for ($t=0;$t<mysqli_num_rows($tagQ);$t++) {
										if ($foundRelatedArticles <= 2) {
											$ttQ = mysqli_query($con, "SELECT * FROM hilos WHERE id='$t'");
											$ttInfo = mysqli_fetch_array($ttQ);
											$tTagLine = $ttInfo['etiquetas'];
											$tTagLineNoSpaces = str_replace(" ", "", $tTagLine);
											$tetiquetas = explode(",", $tTagLineNoSpaces);
											$hasAdded = false;
											for ($i=0;$i<count($etiquetas);$i++) {
												if (!$hasAdded) {
													for($tt = 0;$tt < count($tetiquetas);$tt++) {
														if ($etiquetas[$i] == $tetiquetas[$tt] && $ttInfo['id'] != $id) {
															$foundRelatedArticles++;
															array_push($relatedArticleIDs, $ttInfo['id']);
															array_push($relatedArticleTitles, $ttInfo['title']);
															$hasAdded = true;
														}
													}
												}
											}
										}
									}
									for($fi=0;$fi<$foundRelatedArticles;$fi++) {
										$related .= '<td><a href="paginaDelHilo.php?tid='.$relatedArticleIDs[$fi].'">'.$relatedArticleTitles[$fi].'</a></td>';
									}
									$related .= '
					</tr>
				</tbody>
			</table>';

			//fin etiquetas
			// aqui es donde inicia el hilo de respuestas
			$qu = mysqli_query($con, "SELECT * FROM respuestas WHERE IDhilo='$id'");
			if (mysqli_num_rows($qu) >= 0) {
				$respuestas = '
				
				<div class="col-md-12">
					<div class="panel panel-info">
						<div class="panel-heading ">
							<h3 class="panel-title respuesta2">Respuestas </h3>
						</div>
						<div class="panel-body contenidoLista">
							';
								while ($fila = mysqli_fetch_array($qu)) {
									$respuestas .= '
									<div class="well conversacion contenidoLista">
								' .$fila["autor"].': ' .$fila["contenido"].'
									</div>';
								}
						$respuestas .= '
						</div>
					</div>
				</div>';
			}
			// fin del hilo de respuestas :)

			$titulo = $info['titulo'];
			$contenido = $info['contenido'];
			$autor = $info['autor'];
		}else{
			echo 'fake tid.';
			$noMostrar = true;
		}
	}else{
		echo 'fail tid.';
			$noMostrar = true;
	}
	if (!isSet($noMostrar)) {
	echo "
<html>
	<head>
	<meta charset='utf-8'>
		<title>Pagina del tema</title>
	</head>
		<body>
			<div class='container fondoForo'>

				<!--inicio de seccion de seccion de cerrar sesión -->

				<div class='row navbar navbar-inverse'>
					<div class='col-xs-6 col-sm-6 col-md-2 col-lg-2 navUsuario'>
						<ul>
							<li class='dropdown'>
							<a href='foro.php' class='dropdown-toggle usuario2 bienvenidoUsuario'data-toggle='dropdown'><span> </span>$usuario</a>' 
								<ul class='dropdown-menu'>
									<li><a href='miembros.php'>Ver Miembros Registrados</a></li>
									<li><a href='paginaCuenta.php'>Ver mi pagina de cuenta</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class=' col-xs-6 col-sm-6 col-md-offset-8 col-md-2 col-md-offset-8 col-lg-1 navUsuario'>
						<a href='cerrarsesion.php' class='btn btn-danger salir'> Cerrar Sesion</a>
					</div>
				</div>
				<!--fin de seccion de seccion de cerrar sesión -->

				<!--Aqui inicia la seccion de puntuacio del tema de conversacion -->
				<div class='row'>
					<div class='col-md-6'>
						<div class='panel panel-success'>
							<div class='panel-heading'>
								<h3 class='panel-title'><strong>Agregarle puntuación al tema<strong></h3>
							</div>
							<div class='panel-body contenidoLista'>
								<a class='estrella' href='valoracionHilo.php?tid=$id&puntuacion=1'>1</a>
								<a class='estrella' href='valoracionHilo.php?tid=$id&puntuacion=2'>2</a>
								<a class='estrella' href='valoracionHilo.php?tid=$id&puntuacion=3'>3</a>
								<a class='estrella' href='valoracionHilo.php?tid=$id&puntuacion=4'>4</a>
								<a class='estrella' href='valoracionHilo.php?tid=$id&puntuacion=5'>5</a>
							</div>
						";
							$qq = mysqli_query($con, "SELECT * FROM hilos WHERE id='$id'");
							if (mysqli_num_rows($qq) > 0) {
								$info = mysqli_fetch_array($qq);
								$todo = $info['puntuacion'];
								$total = $info['puntuacionTotal'];
								if ($todo == 0 || $todo == null || $total == 0 || $total == null) {
									echo '
									<div class="panel-footer">
										Todavia no hay una puntuacion para este hilo
									</div>';
								}else {
									$promedio = $todo / $total;
									echo '
									<div class="panel-footer contenidoLista">
										El promedio del tema =

									'; echo round($promedio,2);echo ' <span class="estrella"></span>
									</div>';
								}
							}
							echo ' 
						</div> <!--fin de panel success -->
					</div> <!--fin de col-md-6 -->
						<!--Aqui finaliza la seccion de puntuacio del tema de conversacion -->';

					echo"
						<!--Aqui inicia la seccion del tema de conversacion entre col-md-6-->
					<div class='col-md-6'>
						<div class='panel panel-success'>
							<div class='panel-heading'>
								<h3 class='panel-title'>$titulo</h3>
							</div>
							<div class='panel-body contenidoLista'>
								<p>$contenido</p>
							</div>
							<div class='panel-footer contenidoLista'>
								Por $autor
							</div>
						</div>
					</div> <!--Aqui finaliza la seccion del tema de conversacion entre col-md-6-->";
		echo $related;
		echo  $respuestas ;
		echo "

		<!-- seccion para dejar respuesta al usuario -->

				<form  action="; echo 'paginaDelHilo.php?tid='.$_GET['tid']; echo " method='POST'>
					<div class='col-md-6'>
						<div class='login-form'>
								<legend>Responder a $usuario</legend>
							<div class='form-group'>
								<textarea class='form-control' rows='3' name='contenido' placeholder='contenido' required></textarea>
								<label class='login-field-icon escribir'></label>
								<br>
								<button class='btn btn-primary respuesta' type='submit' name='respuestaEnviada'/> Publicar Respuesta</button>
							</div>
						</div>
					</div>
				</form>

		<!-- fin de seccion para dejar respuesta al usuario --> ";

		if (isSet($_SESSION['usuario'])) {
			echo '
			<!-- inicio de seccion para dejar respuesta al usuario -->

				<form action="subPagina.php?tid='.$_GET['tid'].'" method="POST">
					<div class="col-md-6">
						<div class="login-form">
							<div class="form-group">
							<legend>Suscribirse al tema</legend>
								<input class="form-control" type="email" name="email" placeholder="Email: usuario@mail.com" required/>
								<br/>
								<button class ="btn btn-primary suscripcion" type="submit" name="suscribe"/> Suscribirse</button>
							</div>
						</div>
				</div>
			</form>
						';
				}

			echo "
			</div>
		</div>
	</body>
</html>
	";
	}
?>
