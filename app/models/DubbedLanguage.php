<?php
  class DubbedLanguage {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    // public function getDubbedLanguages() {
    //   $this->db->query('SELECT genre_id, name FROM genres');
    //   $categories = $this->db->resultSet();

    //   return $categories;
    // }

    public function addDubbedLanguageForMovie($language_id, $movie_id) {

      $this->db->query('INSERT INTO dubbed_movies (language_id, movie_id) VALUES (:language_id, :movie_id)');
              
      // Bind Values
      $this->db->bind(':language_id', $language_id);
      $this->db->bind(':movie_id', $movie_id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateDubbedLanguageForMovie($table_id, $old_language_id, $new_language_id, $movie_id) {   
      $this->db->query('UPDATE dubbed_movies SET language_id = :new_language_id WHERE id = :table_id');
              
      // Bind Values
      $this->db->bind(':new_language_id', $new_language_id);
      $this->db->bind(':table_id', $table_id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }

    }

    public function deleteDubbedLanguageForMovie($table_id, $movie_id) {   
      $this->db->query('DELETE FROM dubbed_movies WHERE id = :table_id');

      // Bind Values
      $this->db->bind(':table_id', $table_id);

      // Execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }

    }
  }