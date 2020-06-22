<?php
  class Category {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getCategories() {
      $this->db->query('SELECT genre_id, name FROM genres');
      $categories = $this->db->resultSet();

      return $categories;
    }

    public function addCategory($category) {
      $this->db->query('SELECT * FROM genres WHERE name LIKE "%' . $category . '%"');
    
      $row = $this->db->single();

      if (empty($row)) {

        $this->db->query('INSERT INTO genres (name) VALUES (:category)');
              
        // Bind Values
        $this->db->bind(':category', $category);

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