<?php

	class Actor
	{
    private $id;
    private $first_name;
		private $favorite_movie_id;
		private $movie_id;
		private $movie_title;

		public function __construct($first_name){
			$this->first_name = $first_name;
		}

    public function getId()
    {
      return $this->id;
    }

    public function setId($id)
    {
      $this->id = $id;
    }

		public function setFirst_name($first_name)
		{
			$this->first_name = $first_name;
		}

		public function getFirst_name()
		{
			return $this->first_name;
		}

		public function setFavoriteMovieId($favorite_movie_id){
			$this->favorite_movie_id = $favorite_movie_id;
		}

    public function getFavoriteMovieId(){
			return $this->favorite_movie_id;
		}
}
