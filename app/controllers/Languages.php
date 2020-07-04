<?php
  class Languages extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->languageModel = $this->model('Language');
      // $this->userModel = $this->model('User');
    }

    public function add() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $value = array('success' => true);

        
        //print_r($_POST);
        if (empty($_POST['language'])) {
          $value = array('success' => false, 'msg1' => 'Please put a language', 'data' => $_POST);
        }

        if ($value['success'])
        {
          $language_add_response = $this->languageModel->addGenre($_POST['language']);
          // Validated
          if ($language_add_response) {
            $value['msg1'] = "language added";
            $value['language_id'] = $language_add_response['language_id'];
          } else {
            $value['success'] = false;
            $value['msg1'] = 'the language already exist';
          }
        } 

        header('Content-Type: application/json');
        $output = json_encode($value);
        echo $output;

        // throw new Exception('Invalid Request', 2000);
      }
    }
  }
