<?php
	require_once 'autoload.php';

	$actors = DB::getAllActors();

	if ($_POST) {
		$actorToSave = new Actor($_POST['first_name']);

		$saved = DB::saveActor($actorToSave);
	}

	$pageTitle3 = 'Crear actor';
	require_once 'partials/head3.php';
	require_once 'partials/navbar.php';
?>

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-10">
					<h2>Crear actor</h2>
					<form method="post">
						<div class="row">
							<div class="col-6">
								<div class="form-group">
									<label>Nombre:</label>
									<input type="text" class="form-control" placeholder="Ej: Angelina Jolie" name="first_name">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label>Pelicula en las q actua:</label>
									<input type="text" class="form-control" placeholder="Ej: Tierra de titatnes" name="actor_movie">
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label>Premios:</label>
									<input type="text" class="form-control" placeholder="Ej: 5" name="awards">
								</div>
							</div>

							<div class="col-12 text-center">
								<button type="submit" class="btn btn-primary">GUARDAR</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php if (isset($saved)): ?>
				<div
					class="alert <?php echo $saved ? 'alert-success' : 'alert-danger'?>"
				>
					<?php echo $saved ? '¡Actor guardado con éxito!' : '¡No se pudo guardar el actor!' ?>
				</div>
			<?php endif; ?>
		</div>
	</body>
</html>
