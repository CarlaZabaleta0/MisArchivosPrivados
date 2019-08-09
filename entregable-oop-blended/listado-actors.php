<!DOCTYPE html>
<?php
	require_once 'autoload.php';

	$actors = DB::getAllActors();


	$pageTitle = 'Listado de actores';
	require_once 'partials/head.php';
	require_once 'partials/navbar.php';
?>

		<div class="container">
			<div class="row">
				<div class="col-12">
					<table class="table table-striped">
						<thead class="thead-dark">
			    			<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Peliculas favorita</th>
			    			</tr>
			  			</thead>
			  			<tbody>
							<?php foreach ($actors as $actor): ?>
								<tr>
									<th scope="row"><?php echo $actor->getFirst_name(); ?></th>
									<td><?php echo ($actor->getFavoriteMovieId()); ?></td>
								</tr>
							<?php endforeach; ?>
			  			</tbody>
					</table>
				</div>
			</div>
		</div>

	</body>
</html>
