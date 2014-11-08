<?php
include "plugins.php";
	session_start();
	include "conexion.inc";
	$retornos = '<table><tbody>';
	$buscarUsuarios = '<table><tbody>';
	if (isSet($_POST['busquedaEnviado']) && isSet($_POST['busquedaConsulta']) && $_POST['busquedaConsulta'] != '') {
		$s = $_POST['busquedaConsulta'];
		$s = strtolower($s);
		$ss = explode(' ', $s);
		$q = mysqli_query($con, "SELECT * FROM hilos");
		if (mysqli_num_rows($q) > 0) {
			while ($fila = mysqli_fetch_array($q)) {
				$tieneEtiqueta = false;
				if ($fila['etiquetas'] != '') {
					$etiquetas = strtolower($fila['etiquetas']);
					for ($i=0;$i<count($ss);$i++) {
						if (strpos($etiquetas, $ss[$i]) !== false) {
							$tieneEtiqueta = true;
						}
					}
				}
				if ($tieneEtiqueta) {
					$retornos .= '<tr><td><a href="paginaDelHilo.php?tid='.$fila["id"].'">'.$fila["titulo"].'</a></td></tr>';
				}
			}
		}
		$sQ = $_POST['busquedaConsulta'];
		$uQ = mysqli_query($con, "SELECT * FROM usuarios WHERE usuario='$sQ'");
		if (mysqli_num_rows($uQ) > 0) {
			while ($fila = mysqli_fetch_array($uQ)) {
				$usuario = $fila['usuario'];
				$buscarUsuarios .= '<tr><td><a href="paginaUsuario.php?usuario='.$usuario.'">'.$usuario.'</a></td></tr>';
			}
		}
	}
	$buscarUsuarios .= '</tbody></table>';
	$retornos .= '</tbody></table>';
?>
<html>
	<head></head>
	<body>
		<h1>Hilos:</h1>
		<?php echo $retornos; ?>
		<br/>
		<!-- <h1>Usuarios:</h1>
		// <?php echo $buscarUsuarios; ?> -->
	</body>
</html>