<?php
  class Genres extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->genreModel = $this->model('Genre');
      // $this->userModel = $this->model('User');
    }

    public function test() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $value = array('success' => true);

        
        //print_r($_POST);
        if (empty($_POST['genre'])) {
          $value = array('success' => false, 'msg1' => 'Please put a genre', 'data' => $_POST);
        }

        if ($value['success'])
        {
          $genre_add_response = $this->genreModel->addGenre($_POST['genre']);
          // Validated
          if ($genre_add_response['success']) {
            $value['msg1'] = "genre added";
            $value['genre_id'] = $genre_add_response['genre_id'];
          } else {
            $value['success'] = false;
            $value['msg1'] = 'the genre name already exist';
          }
        } 

        header('Content-Type: application/json');
        $output = json_encode($value);
        echo $output;

        // throw new Exception('Invalid Request', 2000);
      }
    }
  }
