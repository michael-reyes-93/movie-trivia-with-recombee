<?php
  class Categories extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->categoryModel = $this->model('Category');
      // $this->userModel = $this->model('User');
    }

    public function test() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $value = array('success' => true);

        
        //print_r($_POST);
        if (empty($_POST['category'])) {
          $value = array('success' => false, 'msg1' => 'Please put a category', 'data' => $_POST);
        }

        if ($value['success'])
        {
          // Validated
          if ($this->categoryModel->addCategory($_POST['category'])) {
            $value['msg1'] = "category added";
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
