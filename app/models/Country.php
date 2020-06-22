<?php
  class Country {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getCountries() {
      $this->db->query('SELECT id, country FROM countries');
      $countries = $this->db->resultSet();

      return $countries;
    }

    public function addCountry($country) {
      $this->db->query('SELECT * FROM countries WHERE country LIKE "%' . $country . '%"');
    
      $row = $this->db->single();

      if (empty($row)) {

        $this->db->query('INSERT INTO countries (country) VALUES (:country)');
              
        // Bind Values
        $this->db->bind(':country', $country);

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