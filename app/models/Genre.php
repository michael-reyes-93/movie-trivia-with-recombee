<?php
  class Genre {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getGenres() {
      $this->db->query('SELECT genre_id, name FROM genres');
      $genres = $this->db->resultSet();

      return $genres;
    }

    public function addGenre($genre) {
      $this->db->query('SELECT * FROM genres WHERE name LIKE "%' . $genre . '%"');
    
      $row = $this->db->single();

      if (empty($row)) {

        $this->db->query('INSERT INTO genres (name) VALUES (:genre_name)');
              
        // Bind Values
        $this->db->bind(':genre_name', $genre);

        if ($this->db->execute()) {
          return array('success' => true, 'genre_id' => $this->db->lastInsertedId());
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    public function addGenreForMovie($genre_id, $movie_id) {   
      $this->db->query('INSERT INTO movies_genres (genre_id, movie_id) VALUES (:genre_id, :movie_id)');
              
      // Bind Values
      $this->db->bind(':genre_id', $genre_id);
      $this->db->bind(':movie_id', $movie_id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateGenreForMovie($table_id, $old_genre_id, $new_genre_id, $movie_id) {   
      $this->db->query('UPDATE movies_genres SET genre_id = :new_genre_id WHERE id = :table_id');
              
      // Bind Values
      $this->db->bind(':new_genre_id', $new_genre_id);
      $this->db->bind(':table_id', $table_id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }

    }

    public function deleteGenreForMovie($table_id, $movie_id) {   
      $this->db->query('DELETE FROM movies_genres WHERE id = :table_id');

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