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
        return array(true, $this->db->lastInsertedId());
      } else {
        return false;
      }
    }

    public function updateEvent($data) {
      $this->db->query('UPDATE events SET name = :name, year = :year WHERE event_id = :id');

      // Bind Values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':year', $data['year']);

      // Execute 
      if ($this->db->execute()) {
        return array(true, $this->db->lastInsertedId());
      } else {
        return false;
      }
    }

    public function getNumOfMovies() {
      $this->db->query('SELECT COUNT(event_id) AS num_rows FROM events');

      $num_rows = $this->db->single();

      return $num_rows;
    }

    public function getEventsPerPage($limit) {
      $this->db->query('SELECT e.event_id, e.name, e.year FROM events AS e ' . $limit);

      $eventsPerPage = $this->db->resultSet();

      return $eventsPerPage;
    }
  }