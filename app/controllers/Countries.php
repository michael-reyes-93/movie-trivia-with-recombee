<?php
  class Countries extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->countryModel = $this->model('Country');
      // $this->userModel = $this->model('User');
    }

    public function test() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $value = array('success' => true);

        
        //print_r($_POST);
        if (empty($_POST['country'])) {
          $value = array('success' => false, 'msg1' => 'Please put a country', 'data' => $_POST);
        }

        if ($value['success'])
        {
          // Validated
          if ($this->countryModel->addCountry($_POST['country'])) {
            $value['msg1'] = "country added";
          } else {
            $value['success'] = "false";
          }
        } 

        header('Content-Type: application/json');
        $output = json_encode($value);
        echo $output;

        // throw new Exception('Invalid Request', 2000);
      }
    }
  }
