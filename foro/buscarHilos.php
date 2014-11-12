<?php
include "plugins.php";
	session_start();
	if (!isSet($_SESSION['usuario'])) {
		header("Location:index.php");
		exit();
	}
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
						} //  fin de if
					} //  fin de for
				}//  fin de if ($fila['etiquetas'] != '')
				if ($tieneEtiqueta) {
					$retornos .= '<tr><td><a href="paginaDelHilo.php?tid='.$fila["id"].'">'.$fila["titulo"].'</a></td></tr>';
				}
			}// fin de while
		}//fin de if (mysqli_num_rows($q) > 0)
	}
	$buscarUsuarios .= '</tbody></table>';
	$retornos .= '</tbody></table>';

?>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Advertencia: </strong> Si no existe resultado en su búsqueda, puede crear el tema.
				</div>
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Tema encontrado, relacionado con esa etiqueta</h3>
					</div>
					<div class="panel-body">
						<?php echo $retornos; ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>