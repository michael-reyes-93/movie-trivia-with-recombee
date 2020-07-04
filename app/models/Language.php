<?php
  class Language {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getLanguages() {
      $this->db->query('SELECT language_id, language FROM languages');
      $languages = $this->db->resultSet();

      return $languages;
    }

    public function addGenre($language) {
      $this->db->query('SELECT * FROM languages WHERE language LIKE "%' . $language . '%"');
    
      $row = $this->db->single();

      if (empty($row)) {

        $this->db->query('INSERT INTO languages (language) VALUES (:language_name)');
              
        // Bind Values
        $this->db->bind(':language_name', $language);

        if ($this->db->execute()) {
          return array('success' => true, 'language_id' => $this->db->lastInsertedId());
        } else {
          return false;
        }
      } else {
        return false;
      }
    }
  }