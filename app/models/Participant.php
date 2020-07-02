<?php
  class Participant {
    private $db;

    public function __construct() {
      $this->db = new database();
    }
    
    // public function getEvents() {
    //   $this->db->query('SELECT event_id, name, year FROM events');
    //   $events = $this->db->resultSet();

    //   return $events;
    // }
    
    // public function getEventById($id) {
    //   $this->db->query('SELECT * FROM events WHERE event_id = :id');

    //   $this->db->bind(':id', $id);
    
    //   $row = $this->db->single();

    //   return $row;
    // }

    public function addParticipantToAward($status, $participant_picked, $award_id,  $category) {
      $this->db->query('INSERT INTO participants (status) VALUES (:status)');

      // Bind Values
      $this->db->bind(':status', $status);

      // Execute 
      if ($this->db->execute()) {
        // return array(true, $this->db->lastInsertedId());
        $participant_id = $this->db->lastInsertedId();

        switch ($category) {
          case 'm':
            $this->db->query('INSERT INTO award_participant_movie (award_id, participant_id, movie_id) VALUES (:award_id, :participant_id, :participant_picked)');
            break;
          default:
            $this->db->query('INSERT INTO award_participant_person (award_id, participant_id, person_id) VALUES (:award_id, :participant_id, :participant_picked)');
            break;
        }

        // Bind Values
        $this->db->bind(':award_id', $award_id);
        $this->db->bind(':participant_id', $participant_id);
        $this->db->bind(':participant_picked', $participant_picked);
        if ($this->db->execute()) {
          return true;
        } else {
          return false;
        }

      } else {
        return false;
      }
    }

    public function editParticipantInAward($status, $participant_picked, $participant_id,  $category) {
      $this->db->query('UPDATE participants SET status = :status WHERE participant_id = :id');

      // Bind Values
      $this->db->bind(':status', $status);
      $this->db->bind(':id', $participant_id);

      // Execute 
      if ($this->db->execute()) {
        // return array(true, $this->db->lastInsertedId());

        switch ($category) {
          case 'm':
            $this->db->query('UPDATE award_participant_movie SET movie_id = :participant_picked WHERE participant_id = :id');
            break;
          default:
            $this->db->query('UPDATE award_participant_person SET person_id = :participant_picked WHERE participant_id = :id');
            break;
        }

        // Bind Values
        $this->db->bind(':participant_picked', $participant_picked);
        $this->db->bind(':id', $participant_id);
        if ($this->db->execute()) {
          return true;
        } else {
          return false;
        }

      } else {
        return false;
      }
    }

    public function deleteParticipantInAward($participant_id, $category, $award_id) {
      $this->db->query('DELETE FROM participants WHERE participant_id = :id');

      // Bind Values
      $this->db->bind(':id', $participant_id);

      // Execute 
      if ($this->db->execute()) {
        // return array(true, $this->db->lastInsertedId());

        switch ($category) {
          case 'm':
            $this->db->query('DELETE FROM award_participant_movie WHERE participant_id = :id AND award_id = :award_id');
            break;
          default:
            $this->db->query('DELETE FROM award_participant_person WHERE participant_id = :id AND award_id = :award_id');
            break;
        }

        // Bind Values
        $this->db->bind(':id', $participant_id);
        $this->db->bind(':award_id', $award_id);
        if ($this->db->execute()) {
          return true;
        } else {
          return false;
        }

      } else {
        return false;
      }
    }

    // public function updateEvent($data) {
    //   $this->db->query('UPDATE events SET name = :name, year = :year WHERE event_id = :id');

    //   // Bind Values
    //   $this->db->bind(':id', $data['id']);
    //   $this->db->bind(':name', $data['name']);
    //   $this->db->bind(':year', $data['year']);

    //   // Execute 
    //   if ($this->db->execute()) {
    //     return array(true, $this->db->lastInsertedId());
    //   } else {
    //     return false;
    //   }
    // }
  }