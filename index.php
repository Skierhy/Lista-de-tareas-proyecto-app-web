<?php
include 'inc/funciones/sesiones.php';
include 'inc/funciones/funciones.php';


//Obtener el ID de la URL
$id_proyecto = "";
if (isset($_GET['id_proyecto'])) {
	$id_proyecto = $_GET['id_proyecto'];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Lista de tareas</title>
	<link rel="stylesheet" href="css/fontawesome-all.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="<?php echo obtenerPaginaActual(); ?> bg_gris">

	<div class="container-fluid">
			<div class="row text-light mb-5 bg_amarillo">
				<div class="col-12 pt-5 col-lg-10">
					<h1 class="text-center text-dark">Lista de tareas</h1>
				</div>
				<div class="col-12 pt-5 col-lg-2 d-flex justify-content-center">
					<a href="login.php?cerrar_sesion=true" class="btn btn-danger w-75"> <h4>Cerrar Sesión</h4></a>
				</div>
		</div>

		<div class="row">
			<div class="col-12 p-5 col-lg-2 rounded shadow p-5 bg_naranja">
				<div class="crear-proyecto">
					<a href="#" class="btn btn-dark w-100 text-light mb-3"><h2>Nuevo Proyecto </h2><i class="fas fa-plus"></i> </a>
				</div>
				<div class="fondo_lista lista_tareas">
					<h2 class="text-center text-warning">Proyectos: </h2>
					<ul id="proyectos">
						<?php
						$proyectos = obtenerProyectos();
						if ($proyectos) {
							foreach ($proyectos as $proyecto) {
								?>
								<li>
									<a href="index.php?id_proyecto=<?php echo $proyecto['id']; ?>"
										id="proyecto:<?php echo $proyecto['id']; ?>">
										<?php echo $proyecto['nombre']; ?>
									</a>
								</li>
								<?php
							} //Fin foreach
						}//Fin if ?>
					</ul>
				</div>
			</div>

			<div class="col-12   col-lg-10">
				<div class="container w-100 mt-5 rounded shadow p-5 bg_azul">
				<?php
				$proyecto = obtenerNombreProyecto($id_proyecto);
				if ($proyecto) {
					?>
					<h1 class="text-center text-dark">Nombre del proyecto:
						<?php foreach ($proyecto as $nombre) {
							?>
							<span><?php echo $nombre['nombre']; ?></span>
							<?php
						}//Fin for each ?>
					</h1>
					
						<form action="#">
							<div class="row">
								<div class="col-2"></div>
								<div class="mb-3 col-8">
									<label for="tarea" class="form-label h1 text-dark">Nombre de la tarea: </label>
									<input type="text" placeholder="Nombre Tarea" class="form-control nombre-tarea">
								</div>
								<div class="col-2"></div>
							</div>
							<div class="row">
								<div class="col-2"></div>
								<div class="enviar col-8">
									<input type="hidden" id="id_proyecto" value="<?php echo $id_proyecto; ?>"
									value="id_proyecto">
									<input type="submit" class="btn btn-dark bg_gris2 nueva-tarea w-100" value="Agregar">
								</div>
								<div class="col-2"></div>
							</div>
						</form>
					</div>

					<?php
				} else {
					//Fin del if '$proyecto'
					//Si no hay proyectos seleccionados
					echo "<h1 class='text-center text-danger'>Selecciona un proyecto a la izquierda</h1>";
				}
				?>
				<div class="container w-100 mt-5 rounded shadow p-5 bg_blanco">
					<div class="row">
						<div class="col">
							<h2 class="text-center text-dark">Listado de tareas:</h2>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<div class="lista_por_hacer listado-pendientes bg_gris">
								<ul>
									<?php
									//Obtiene las tareas del proyecto actual
									$tareas = obtenerTareasProyecto($id_proyecto);
									if ($tareas) {
										//Verificamos si existe tareas primeramente antes de agregar de forma dinamica
										if ($tareas->num_rows > 0) {
											//Si hay tareas
											foreach ($tareas as $tarea): ?>
											<li id="tarea:<?php echo $tarea['id']; ?>" class="tarea">
												<p>
													<?php echo $tarea['nombre']; ?>
												</p>
												<div class="espacio">
													<i class="far fa-check-circle <?php echo ($tarea['estado'] === '1') ? 'completo' : ''; ?>"></i>
													<i class="fas fa-trash"></i>
												</div>
											</li>
											<?php endforeach;
										} else {
											//No hay tareas
											echo "<p class='lista-vacia'>No hay tareas en este proyecto</p>";
										}
									} //Fin del if 'isset'
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/sweetalert2.all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
	</script>
	<?php
	$actual = obtenerPaginaActual();
	if ($actual === 'crear-cuenta' || $actual === 'login') {
		echo '<script src="js/formulario.js"></script>';
	} else {
		echo '<script src="js/scripts.js"></script>';
	}
	?>
</body>

</html>