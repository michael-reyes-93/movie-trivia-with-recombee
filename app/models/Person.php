<?php
  class Person {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getPersons() {
      $this->db->query('SELECT * FROM persons');

      $results = $this->db->resultSet();

      return $results;
    }

    public function addPerson($data) {
      $this->db->query('INSERT INTO persons (name, born, biography, photo, is_actor, is_producer, is_director) VALUES (:name, :born, :biography, :photo, :actor, :producer, :director);');

      // Bind Values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':born', $data['born']);
      $this->db->bind(':biography', $data['biography']);
      $this->db->bind(':photo', $data['photo']);
      $this->db->bind(':actor', in_array(1, $data['role']) ? 1 : 0);
      $this->db->bind(':producer', in_array(2, $data['role']) ? 1 : 0);
      $this->db->bind(':director', in_array(3, $data['role']) ? 1 : 0);

      // Execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getPersonById($id) {
      $this->db->query('SELECT * FROM persons WHERE person_id = :id');

      $this->db->bind(':id', $id);
    
      $row = $this->db->single();

      return $row;
    }

    public function updatePerson($data) {
      $this->db->query('UPDATE persons SET name = :name, born = :born, biography = :biography, photo = :photo, is_actor = :actor, is_producer = :producer, is_director = :director WHERE person_id = :id');

      // Bind Values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':born', $data['born']);
      $this->db->bind(':biography', $data['biography']);
      $this->db->bind(':photo', $data['photo']);
      $this->db->bind(':actor', in_array(1, $data['role']) ? 1 : 0);
      $this->db->bind(':producer', in_array(2, $data['role']) ? 1 : 0);
      $this->db->bind(':director', in_array(3, $data['role']) ? 1 : 0);

      // Execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

  }