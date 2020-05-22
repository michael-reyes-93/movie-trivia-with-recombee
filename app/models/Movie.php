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
        return true;
      } else {
        return false;
      }
    }

    public function getMoviesTitleWithId() {
      $this->db->query('SELECT movie_id, title FROM movies');
      $results = $this->db->resultSet();

      return $results;
    }

  }