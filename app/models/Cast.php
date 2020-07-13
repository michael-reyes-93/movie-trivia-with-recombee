<?php
  class Cast {
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

    public function addActorToMovie($actor_id, $movie_id) {   
      $this->db->query('INSERT INTO cast (actor_id, movie_id) VALUES (:actor_id, :movie_id)');
              
      // Bind Values
      $this->db->bind(':actor_id', $actor_id);
      $this->db->bind(':movie_id', $movie_id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateActorInMovie($table_id, $new_actor_id) {   
      $this->db->query('UPDATE cast SET actor_id = :new_actor_id WHERE cast_id = :table_id');
              
      // Bind Values
      $this->db->bind(':new_actor_id', $new_actor_id);
      $this->db->bind(':table_id', $table_id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }

    }

    public function deleteActorInMovie($table_id, $movie_id) {   
      $this->db->query('DELETE FROM cast WHERE cast_id = :table_id');

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