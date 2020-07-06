<?php
  class Image {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function addImage($image_name) {
      $this->db->query('SELECT * FROM images WHERE name LIKE "%' . $image_name . '%"');
    
      $row = $this->db->single();

      if (empty($row)) {
        $this->db->query('INSERT INTO images (name) VALUES (:image_name)');

        // Bind Values
        $this->db->bind(':image_name', $image_name);

        // Execute
        if ($this->db->execute()) {
          return array(true, $this->db->lastInsertedId());
        } else {
          return false;
        }
      }
    }

    public function getUploadedImages() {
      $this->db->query('SELECT name FROM images');

      $images = $this->db->resultSet();

      return $images;
    }

  }