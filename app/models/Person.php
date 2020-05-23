<?php
  class Person {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getPersons() {
      $this->db->query('SELECT name, born, biography, photo, 
      persons.person_id as personId,
        actors.actor_id as actorId,
        producers.producer_id AS producerId,
        directors.director_id AS directorId
        FROM persons
        LEFT JOIN actors
        ON persons.person_id = actors.person_id
        LEFT JOIN producers
        ON persons.person_id = producers.person_id
        LEFT JOIN directors
        ON persons.person_id = directors.person_id
      ');

      $results = $this->db->resultSet();

      return $results;
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

        if (in_array(3, $data['role'])) {
          $this->db->query('INSERT INTO directors (person_id) VALUES (:person_id);');

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