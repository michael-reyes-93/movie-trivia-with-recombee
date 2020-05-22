<?php
  class Users extends Controller{
    public function __construct() {

    }

    public function login() {
      $data =[    
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',        
      ];

      $this->view('users/login', $data);
    }

    public function register() {
      // Init data
      $data =[
        'name' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => '',
        'name_err' => '',
        'email_err' => '',
        'password_err' => '',
        'confirm_password_err' => ''
      ];

      // Load view
      $this->view('users/register', $data);
    }

  }