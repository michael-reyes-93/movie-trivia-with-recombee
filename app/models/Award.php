<?php
  class Award {
    private $db;

    public function __construct() {
      $this->db = new database();
    }

    public function getAwards($event_id) {
      $this->db->query('SELECT * FROM awards WHERE event_id = :id');

      $this->db->bind(':id', $event_id);
    
      $events = $this->db->resultSet();

      return $events;
    }

    public function getAwardById($award_id) {
      $this->db->query("SELECT * FROM awards WHERE award_id = :id");

      $this->db->bind(':id', $award_id);

      $award = $this->db->single();

      return $award;
    }

    public function addAwards($event_id, $awards) {
      $results = [];

      foreach ($awards as $award) {
        $this->db->query('INSERT INTO awards (name, category, event_id) VALUES (:award_name, :award_category, :event_id)');

        // Bind Values
        $this->db->bind(':award_name', $award['name']);
        $this->db->bind(':award_category', $award['category']);
        $this->db->bind(':event_id', $event_id);

        $this->db->execute() ? array_push($results, true) : array_push($results, false);
      }        

      return in_array(false, $results) ? false : true;
    }

    public function updateAwards($event_id, $awards) {
      $results = [];
      
      foreach ($awards as $award) {
        if($award['id'] == 'x') {
          $this->db->query('INSERT INTO awards (name, category, event_id) VALUES (:award_name, :award_category, :event_id)');

          // Bind Values
          $this->db->bind(':award_name', $award['name']);
          $this->db->bind(':award_category', $award['category']);
          $this->db->bind(':event_id', $event_id);

          $this->db->execute() ? array_push($results, true) : array_push($results, false);
        } else {
          $this->db->query('UPDATE awards SET name = :award_name, category = :award_category WHERE award_id = :award_id');

          // Bind Values
          $this->db->bind(':award_name', $award['name']);
          $this->db->bind(':award_category', $award['category']);
          $this->db->bind(':award_id', $award['id']);

          $this->db->execute() ? array_push($results, true) : array_push($results, false);
        }
      }        

      return in_array(false, $results) ? false : true;
    }
  }