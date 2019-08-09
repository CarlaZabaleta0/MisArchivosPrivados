<?php

	abstract class DB
	{
		public static function getAllMovies()
		{
			global $connection;

      //agregan felixiblidda
			//left join: se aceptan resultados nulos, ejem/se acepata q peli no tenga genero
      // right: generos q no tengas pelis asosiadas
			$stmt = $connection->prepare("
				SELECT m.id AS 'movie_id', m.title, m.rating, m.awards, m.release_date, m.length, g.name AS 'genre', g.id AS 'genre_id'
				FROM movies as m
				LEFT JOIN genres as g
				ON g.id = genre_id
				ORDER BY m.title;
			");

			$stmt->execute();

			$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$moviesObject = [];

			foreach ($movies as $movie) {
				$finalMovie = new Movie($movie['title'], $movie['rating'], $movie['awards'], $movie['release_date']);

				$finalMovie->setLength($movie['length']);
				$finalMovie->setGenreID($movie['genre_id']);
				$finalMovie->setGenreName($movie['genre']);
				$finalMovie->setMovieID($movie['movie_id']);
//mas parametros
				$moviesObject[] = $finalMovie;
			}

			return $moviesObject;
		}

		public static function getAllGenres()
		{
			global $connection;

			$stmt = $connection->prepare("
			SELECT id, name, ranking, active FROM genres");

			$stmt->execute();

			$genres = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$genresObject = [];

			foreach ($genres as $genre) {
				$finalGenre = new Genre($genre['name'], $genre['ranking'], $genre['active']);

				$finalGenre->setID($genre['id']);

				$genresObject[] = $finalGenre;
			}

			return $genresObject;
		}

		public static function getAllActors(){
			global $connection;

			//agregan felixiblidda
			//left join: se aceptan resultados nulos, ejem/se acepata q peli no tenga genero
			// right: generos q no tengas pelis asosiadas
			$stmt = $connection->prepare("
			SELECT actors.id,actors.first_name,actors.favorite_movie_id
			FROM actors
			LEFT JOIN movies
			ON movies.id = actors.favorite_movie_id
			ORDER BY actors.first_name;
			");

			$stmt->execute();

			$actors = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$actorsObject = [];

			foreach ($actors as $actor) {
				$finalActor = new Actor($actor['first_name'], $actor['favorite_movie_id']);

        $finalActor->setId($actor['id']);
				$finalActor->setFavoriteMovieId($actor['favorite_movie_id']);

				$actorsObject[] = $finalActor;
			}
			return $actorsObject;
		}

		public static function saveMovie(Movie $movie)
		{
			global $connection;

			try {
				$stmt = $connection->prepare("
					INSERT INTO movies (title, rating, awards, release_date, length, genre_id)
					VALUES(:title, :rating, :awards, :release_date, :length, :genre_id)
				");

				$stmt->bindValue(':title', $movie->getTitle());
				$stmt->bindValue(':rating', $movie->getRating());
				$stmt->bindValue(':awards', $movie->getAwards());
				$stmt->bindValue(':release_date', $movie->getReleaseDate());
				$stmt->bindValue(':length', $movie->getLength());
				$stmt->bindValue(':genre_id', $movie->getGenreID());


				return true;
			} catch (PDOException $exception) {
				return false;
			}
		}

		public static function saveGenre(Genre $genre)
		{
			global $connection;

			$genres = self::getAllGenres();

			$finalGenres = [];

			foreach ($genres as $oneGenre) {
				$finalGenres[] = $oneGenre->getName();
			}

			if (!in_array($genre->getName(), $finalGenres)) {
				$stmt = $connection->prepare("
					INSERT INTO genres (name, ranking, active)
					VALUES(:name, :ranking, :active)
				");

				$stmt->bindValue(':name', $genre->getName());
				$stmt->bindValue(':ranking', $genre->getRanking());
				$stmt->bindValue(':active', $genre->getActive());

				return true;
			} else {
				return false;
			}
		}

		public static function saveActor(Actor $actor){
			global $connection;

			try {
				$stmt = $connection->prepare("
					INSERT INTO actors (first_name,favorite_movie_id)
					VALUES(:first_name,:favorite_movie_id)
				");

				$stmt->bindValue(':first_name', $actor->getFirst_name());
				$stmt->bindValue(':favorite_movie_id', $actor->getFavoriteMovieId());

				return true;
			} catch (PDOException $exception) {
				return false;
			}
		}
	}
