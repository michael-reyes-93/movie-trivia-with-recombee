<?php
  class Movie {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function addMovie($data) {
      // $this->test();
      $this->db->query('INSERT INTO movies (title, story, poster, catalog_photo, release_date, budget, return_of_investment, director_id, music_director, raiting, original_language_id, origin_country_id, streaming_on) VALUES (:title, :story, :poster, :catalog_photo, :release_date, :budget, :return_of_investment, :director_id, :music_director, :rating, :original_language, :origin_country, :streaming_on)');

      // Bind Values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':story', $data['story']);
      $this->db->bind(':poster', $data['poster']);
      $this->db->bind(':catalog_photo', $data['catalog_photo']);
      $this->db->bind(':release_date', '1994-08-05');
      $this->db->bind(':budget', $data['budget']);
      $this->db->bind(':return_of_investment', $data['return_of_investment']);
      $this->db->bind(':director_id', $data['director']);
      $this->db->bind(':music_director', $data['music_director']);
      $this->db->bind(':rating', $data['rating']);
      $this->db->bind(':original_language', $data['original_language']);
      $this->db->bind(':origin_country', $data['origin_country']);
      $this->db->bind(':streaming_on', $data['streaming_on']);

      // Execute
      //return $this->db->test();
      if ($this->db->execute()) {
        $movie_id = $this->db->lastInsertedId();
        $results = [];

        foreach ($data['cast'] as $actor) {
          $this->db->query('INSERT INTO cast (movie_id, actor_id) VALUES (:movie_id, :actor_id)');

          // Bind Values
          $this->db->bind(':movie_id', $movie_id);
          $this->db->bind(':actor_id', $actor);

          $this->db->execute() ? array_push($results, true) : array_push($results, false);
        }        

        foreach ($data['producers'] as $producer) {
          $this->db->query('INSERT INTO producers (movie_id, producer_id) VALUES (:movie_id, :producer_id)');

          // Bind Values
          $this->db->bind(':movie_id', $movie_id);
          $this->db->bind(':producer_id', $producer);

          $this->db->execute() ? array_push($results, true) : array_push($results, false);
        }   

        foreach ($data['soundtracks'] as $soundtrack) {
          $this->db->query('INSERT INTO movies_soundtracks (movie_id, soundtrack_id) VALUES (:movie_id, :soundtrack_id)');

          // Bind Values
          $this->db->bind(':movie_id', $movie_id);
          $this->db->bind(':soundtrack_id', $soundtrack);

          $this->db->execute() ? array_push($results, true) : array_push($results, false);
        }

        return array(in_array(false, $results) ? false : true, $movie_id);
      } else {
        return false;
      }
    }

    public function updateMovie($data) {
      // $this->test();
      $this->db->query('UPDATE movies SET title = :title, story = :story, poster = :poster, catalog_photo = :catalog_photo, release_date = :release_date, budget = :budget, return_of_investment = :return_of_investment, director_id = :director_id, music_director = :music_director, raiting = :raiting, original_language_id = :original_language_id, origin_country_id = :origin_country_id, streaming_on = :streaming_on WHERE movie_id = :movie_id;');

      // Bind Values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':story', $data['story']);
      $this->db->bind(':poster', $data['poster']);
      $this->db->bind(':catalog_photo', $data['catalog_photo']);
      $this->db->bind(':release_date', '1994-08-05');
      $this->db->bind(':budget', $data['budget']);
      $this->db->bind(':return_of_investment', $data['return_of_investment']);
      $this->db->bind(':director_id', $data['director']);
      $this->db->bind(':music_director', $data['music_director']);
      $this->db->bind(':raiting', $data['rating']);
      $this->db->bind(':original_language_id', $data['original_language']);
      $this->db->bind(':origin_country_id', $data['origin_country']);
      $this->db->bind(':streaming_on', $data['streaming_on']);
      $this->db->bind(':movie_id', $data['movie_id']);
     
      // Execute
      //return $this->db->test();
      if ($this->db->execute()) {
        return array(true);
      } else {
        return false;
      }
         
    }

    public function getMoviesTitleWithId() {
      $this->db->query('SELECT movie_id, title FROM movies');
      $results = $this->db->resultSet();

      return $results;
    }

    public function getDirectors() {
      $this->db->query('SELECT person_id, persons.name FROM persons WHERE is_director = 1');
      $directors = $this->db->resultSet();

      return $directors;
    }

    public function getActors() {
      $this->db->query('SELECT person_id, persons.name FROM persons WHERE is_actor = 1');
      $actors = $this->db->resultSet();

      return $actors;
    }

    public function getProducers() {
      $this->db->query('SELECT person_id, persons.name FROM persons WHERE is_producer = 1');
      $producers = $this->db->resultSet();

      return $producers;
    }

    public function getMovies() {
      $this->db->query('SELECT m.movie_id, m.title, m.poster, l.language, c.country FROM movies AS m LEFT JOIN languages AS l ON m.original_language_id = l.language_id LEFT JOIN countries AS c ON m.origin_country_id = c.id;');
      
      $movies = $this->db->resultSet();

      return $movies;
    }

    public function getMovieById($movie_id) {
      $this->db->query('SELECT * FROM movies WHERE movie_id = :movie_id;');

      $this->db->bind(':movie_id', $movie_id);

      $row = $this->db->single();

      return $row;
    }

    public function addToTop5($movie_id) {
      // $this->test();
      $this->db->query('INSERT INTO top_5_movies (movie_id) VALUES (:movie_id)');

      // Bind Values
      $this->db->bind(':movie_id', $movie_id);
      
      // Execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getTop5() {
      $this->db->query('SELECT t.top_id, t.movie_id, m.title, m.poster, m.cover FROM top_5_movies AS t INNER JOIN movies AS m ON t.movie_id = m.movie_id;');
      $top_5 = $this->db->resultSet();
  
      return $top_5;
    }

    public function getCastByMovieId($movie_id) {
      $this->db->query('SELECT c.cast_id, c.actor_id FROM movies AS m INNER JOIN cast AS c ON m.movie_id = c.movie_id WHERE m.movie_id = :movie_id;');

      $this->db->bind(':movie_id', $movie_id);

      $cast = $this->db->resultSet();

      return $cast;
    }

    public function getProducersByMovieId($movie_id) {
      $this->db->query('SELECT p.id, p.producer_id FROM movies AS m INNER JOIN producers AS p ON m.movie_id = p.movie_id WHERE m.movie_id = :movie_id;');

      $this->db->bind(':movie_id', $movie_id);

      $producers = $this->db->resultSet();

      return $producers;
    }

    public function getSoundtracksByMovieId($movie_id) {
      $this->db->query('SELECT ms.id, ms.soundtrack_id FROM movies AS m INNER JOIN movies_soundtracks AS ms ON m.movie_id = ms.movie_id WHERE m.movie_id = :movie_id;');
      
      $this->db->bind(':movie_id', $movie_id);

      $soundtracks = $this->db->resultSet();

      return $soundtracks;
    }

    public function getGenresByMovieId($movie_id) {
      $this->db->query('SELECT mg.id, mg.genre_id FROM movies AS m INNER JOIN movies_genres AS mg ON m.movie_id = mg.movie_id WHERE m.movie_id = :movie_id;');
              
      // Bind Values
      $this->db->bind(':movie_id', $movie_id);

      $genres = $this->db->resultSet();

      return $genres;
    }

    public function getDubbedLanguagesByMovieId($movie_id) {
      $this->db->query('SELECT dm.id, dm.language_id FROM movies AS m INNER JOIN dubbed_movies AS dm ON m.movie_id = dm.movie_id WHERE m.movie_id = :movie_id;');
      
      $this->db->bind(':movie_id', $movie_id);

      $dubbed_languages = $this->db->resultSet();

      return $dubbed_languages;
    }

    public function getSubtitlesLanguagesByMovieId($movie_id) {
      $this->db->query('SELECT sm.id, sm.language_id FROM movies AS m INNER JOIN subtitles_movies AS sm ON m.movie_id = sm.movie_id WHERE m.movie_id = :movie_id;');
      
      $this->db->bind(':movie_id', $movie_id);

      $dubbed_languages = $this->db->resultSet();

      return $dubbed_languages;
    }

    public function getAwardsByMovieId($movie_id) {
      $this->db->query('SELECT awm.id, awm.movie_id, awm.award_id, awm.participant_id, a.name, a.category, p.status FROM award_participant_movie AS awm INNER JOIN awards AS a ON awm.award_id = a.award_id
      LEFT JOIN participants AS p ON awm.participant_id = p.participant_id WHERE awm.movie_id = :movie_id');

      $this->db->bind(':movie_id', $movie_id);

      $awards = $this->db->resultSet();

      return $awards;
    }

    public function getNumOfMovies() {
      $this->db->query('SELECT COUNT(movie_id) AS num_rows FROM movies');

      $num_rows = $this->db->single();

      return $num_rows;
    }

    public function getMoviesPerPage($limit) {
      $this->db->query('SELECT m.movie_id, m.title, m.poster, l.language, c.country FROM movies AS m LEFT JOIN languages AS l ON m.original_language_id = l.language_id LEFT JOIN countries AS c ON m.origin_country_id = c.id ' . $limit);

      $moviesPerPage = $this->db->resultSet();

      return $moviesPerPage;
    }

    public function getMoviesCatalog() {
      $this->db->query('SELECT movie_id, catalog_photo FROM movies LIMIT 13');

      $moviesCatalog = $this->db->resultSet();

      return $moviesCatalog;
    }
  }

