<?php
  class Genre {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getGenres() {
      $this->db->query('SELECT genre_id, name FROM genres');
      $categories = $this->db->resultSet();

      return $categories;
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
  }