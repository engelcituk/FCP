<?php
	session_start();
	if (!isSet($_SESSION['usuario'])) {
		header("Location:login.php");
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
			if (mysqli_num_rows($qu) > 0) {
				$respuestas = '
			<div class="col-md-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Respuetas</h3>
					</div>
					<div class="panel-body">
						';
							while ($fila = mysqli_fetch_array($qu)) {
								$respuestas .= '
								<div class="well">
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
	</head>
		<body>
			<div class='container'>
				<!--Aqui inicia la seccion de puntuacio del tema de conversacion -->
				<div class='row'>
					<div class='col-md-6'>
						<div class='panel panel-success'>
							<div class='panel-heading'>
								<h3 class='panel-title'><strong>Agregarle puntuacion al tema<strong></h3>
							</div>
							<div class='panel-body'>
								<a class='glyphicon glyphicon-star' href='valoracionHilo.php?tid=$id&puntuacion=1'>1</a>
								<a class='glyphicon glyphicon-star' href='valoracionHilo.php?tid=$id&puntuacion=2'>2</a>
								<a class='glyphicon glyphicon-star' href='valoracionHilo.php?tid=$id&puntuacion=3'>3</a>
								<a class='glyphicon glyphicon-star' href='valoracionHilo.php?tid=$id&puntuacion=4'>4</a>
								<a class='glyphicon glyphicon-star' href='valoracionHilo.php?tid=$id&puntuacion=5'>5</a>
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
									<div class="panel-footer">
										Promedio del tema
									</div> 
									'; echo round($promedio, 3);echo ' <span class="glyphicon glyphicon-star"></span>';
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
							<div class='panel-body'>
								<p>$contenido</p>
							</div>
							<div class='panel-footer'>
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
								<textarea class='form-control' type='text' name='contenido' rows='2' placeholder='mensaje:' required/>
								</textarea>
								<label class='login-field-icon escribir'></label>
								<br>
								<input class='btn btn-primary' type='submit' value='Post Reply' name='respuestaEnviada' />
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
							<legend>Suscribirse al tema:</legend>
								<input class="form-control" type="text" name="email" placeholder="Email: usuario@mail.com"/><br/>
								<input class ="btn btn-primary" type="submit" name="suscribe" value="Subscribe" />
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
