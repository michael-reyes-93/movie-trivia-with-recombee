<?php
  class Soundtrack {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function addSinger($data) {
      $this->db->query('INSERT INTO soundtracks (name, singer, duration, movie_id) VALUES (:name, :singer, :duration, :movie);');

      // Bind Values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':singer', $data['name_singer_group']);
      $this->db->bind(':duration', $data['duration']);
      $this->db->bind(':movie_id', $data['movie']);

      // Execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function addGroup($data) {
      $this->db->query('INSERT INTO soundtracks (name, group_name, duration, movie_id) VALUES (:name, :group, :duration, :movie);');

      // Bind Values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':group', $data['name_singer_group']);
      $this->db->bind(':duration', $data['duration']);
      $this->db->bind(':movie', $data['movie']);

      // Execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
    
  }