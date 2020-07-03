<?php
  class Movie {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function addMovie($data) {
      // $this->test();
      $this->db->query('INSERT INTO movies (title, story, poster, release_date, budget, return_of_investment, director_id, music_director, raiting, original_language, country, streaming_on) VALUES (:title, :story, :poster, :release_date, :budget, :return_of_investment, :director_id, :music_director, :rating, :original_language, :country, :streaming_on)');

      // Bind Values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':story', $data['story']);
      $this->db->bind(':poster', $data['poster']);
      $this->db->bind(':release_date', '1994-08-05');
      $this->db->bind(':budget', $data['budget']);
      $this->db->bind(':return_of_investment', $data['return_of_investment']);
      $this->db->bind(':director_id', $data['director']);
      $this->db->bind(':music_director', $data['music_director']);
      $this->db->bind(':rating', $data['rating']);
      $this->db->bind(':original_language', $data['original_language']);
      $this->db->bind(':country', $data['country']);
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

        return in_array(false, $results) ? false : true;
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
      $this->db->query('SELECT movie_id, title FROM movies');
      $movies = $this->db->resultSet();

      return $movies;
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
      $this->db->query('SELECT t.top_id, t.movie_id, m.title, m.poster FROM top_5_movies AS t INNER JOIN movies AS m ON t.movie_id = m.movie_id;');
      $top_5 = $this->db->resultSet();
  
      return $top_5;
    }
  }

