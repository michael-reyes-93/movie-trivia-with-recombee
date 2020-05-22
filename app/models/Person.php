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
        $results = [];
        $person_id = $this->db->lastInsertedId();
        
        if (in_array(1, $data['role'])) {
          $this->db->query('INSERT INTO actors (person_id) VALUES (:person_id);');

          // Bind Values
          $this->db->bind(':person_id', $person_id);

          $this->db->execute() ? array_push($results, true) : array_push($results, false);
        }

        if (in_array(2, $data['role'])) {
          $this->db->query('INSERT INTO producers (person_id) VALUES (:person_id);');

          // Bind Values
          $this->db->bind(':person_id', $person_id);

          $this->db->execute() ? array_push($results, true) : array_push($results, false);
        }
        
        return in_array(false, $results) ? false : true;
        
      } else {
        return false;
      }
    }

    
  }