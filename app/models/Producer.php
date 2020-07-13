<?php
  class Producer {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    // public function getGenres() {
    //   $this->db->query('SELECT genre_id, name FROM genres');
    //   $genres = $this->db->resultSet();

    //   return $genres;
    // }

    // public function addGenre($genre) {
    //   $this->db->query('SELECT * FROM genres WHERE name LIKE "%' . $genre . '%"');
    
    //   $row = $this->db->single();

    //   if (empty($row)) {

    //     $this->db->query('INSERT INTO genres (name) VALUES (:genre_name)');
              
    //     // Bind Values
    //     $this->db->bind(':genre_name', $genre);

    //     if ($this->db->execute()) {
    //       return array('success' => true, 'genre_id' => $this->db->lastInsertedId());
    //     } else {
    //       return false;
    //     }
    //   } else {
    //     return false;
    //   }
    // }

    public function addProducerToMovie($producer_id, $movie_id) {   
      $this->db->query('INSERT INTO producers (producer_id, movie_id) VALUES (:producer_id, :movie_id)');
              
      // Bind Values
      $this->db->bind(':producer_id', $producer_id);
      $this->db->bind(':movie_id', $movie_id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateProducerInMovie($table_id, $new_producer_id) {   
      $this->db->query('UPDATE producers SET producer_id = :new_producer_id WHERE id = :table_id');
              
      // Bind Values
      $this->db->bind(':new_producer_id', $new_producer_id);
      $this->db->bind(':table_id', $table_id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }

    }

    public function deleteProducerInMovie($table_id) {   
      $this->db->query('DELETE FROM producers WHERE id = :table_id');

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