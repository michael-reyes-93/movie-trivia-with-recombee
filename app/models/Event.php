<?php
  class Event {
    private $db;

    public function __construct() {
      $this->db = new database();
    }
    
    public function getEvents() {
      $this->db->query('SELECT event_id, name, year FROM events');
      $events = $this->db->resultSet();

      return $events;
    }

    
    public function getEventById($id) {
      $this->db->query('SELECT * FROM events WHERE event_id = :id');

      $this->db->bind(':id', $id);
    
      $row = $this->db->single();

      return $row;
    }


    public function addEvent($data) {
      $this->db->query('INSERT INTO events (name, year) VALUES (:name, :year)');

      // Bind Values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':year', $data['year']);

      // Execute 
      if ($this->db->execute()) {
        $event_id = $this->db->lastInsertedId();
        $results = [];

        echo "id del evento: " . $event_id;
        foreach ($data['awards'] as $award) {
          $this->db->query('INSERT INTO awards (name, category, event_id) VALUES (:award_name, :award_category, :event_id)');

          // Bind Values
          $this->db->bind(':award_name', $award['name']);
          $this->db->bind(':award_category', $award['category']);
          $this->db->bind(':event_id', $event_id);

          $this->db->execute() ? array_push($results, true) : array_push($results, false);
        }        

        return in_array(false, $results) ? false : true;
      } else {
        return false;
      }
    }
  }