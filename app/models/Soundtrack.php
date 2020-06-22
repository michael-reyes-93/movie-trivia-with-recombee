<?php
  class Soundtrack {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function addSinger($data) {
      $this->db->query('INSERT INTO soundtracks (name, singer_name, duration) VALUES (:name, :singer, :duration);');

      // Bind Values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':singer', $data['name_singer_group']);
      $this->db->bind(':duration', $data['duration']);

      // Execute
      if ($this->db->execute()) {
        $soundtrack_id = $this->db->lastInsertedId();
        $results = [];

        foreach ($data['movies'] as $movie) {
          $this->db->query('INSERT INTO movies_soundtracks (movie_id, soundtrack_id) VALUES (:movie_id, :soundtrack_id)');

          // Bind Values
          $this->db->bind(':movie_id', $movie);
          $this->db->bind(':soundtrack_id', $soundtrack_id);

          $this->db->execute() ? array_push($results, true) : array_push($results, false);
        }        

        return in_array(false, $results) ? false : true;
      } else {
        return false;
      }
    }

    public function addGroup($data) {
      $this->db->query('INSERT INTO soundtracks (name, group_name, duration) VALUES (:name, :group, :duration);');

      // Bind Values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':group', $data['name_singer_group']);
      $this->db->bind(':duration', $data['duration']);

      // Execute
      if ($this->db->execute()) {
        $soundtrack_id = $this->db->lastInsertedId();
        $results = [];

        foreach ($data['movies'] as $movie) {
          $this->db->query('INSERT INTO movies_soundtracks (movie_id, soundtrack_id) VALUES (:movie_id, :soundtrack_id)');

          // Bind Values
          $this->db->bind(':movie_id', $movie);
          $this->db->bind(':soundtrack_id', $soundtrack_id);

          $this->db->execute() ? array_push($results, true) : array_push($results, false);
        }        

        return in_array(false, $results) ? false : true;
      } else {
        return false;
      }
    }

    public function getSoundtracks() {
      $this->db->query('SELECT soundtrack_id, name FROM soundtracks');
      $soundtracks = $this->db->resultSet();

      return $soundtracks;
    }
    
  }