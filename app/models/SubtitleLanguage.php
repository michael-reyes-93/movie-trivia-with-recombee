<?php
  class SubtitleLanguage {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    // public function getDubbedLanguages() {
    //   $this->db->query('SELECT genre_id, name FROM genres');
    //   $categories = $this->db->resultSet();

    //   return $categories;
    // }

    public function addSubtitleLanguageForMovie($language_id, $movie_id) {

      $this->db->query('INSERT INTO subtitles_movies (language_id, movie_id) VALUES (:language_id, :movie_id)');
              
      // Bind Values
      $this->db->bind(':language_id', $language_id);
      $this->db->bind(':movie_id', $movie_id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
  }