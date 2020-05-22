<?php
  class Person {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function addPerson($data) {
      $this->db->query('INSERT INTO persons (name, born, biography, photo) VALUES (:name, :born, :biography, :photo);');

      // Bind Values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':born', $data['born']);
      $this->db->bind(':biography', $data['biography']);
      $this->db->bind(':photo', $data['photo']);

      // Execute
      if ($this->db->execute()) {
        $this->db->query('INSERT INTO actors (person_id) VALUES (:person_id);');

        // Bind Values
        $this->db->bind(':person_id', $this->db->lastInsertedId());
        
        // Second Execute
        if ($this->db->execute()) {
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

    
  }