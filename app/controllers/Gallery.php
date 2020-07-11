<?php
  class Gallery extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->genreModel = $this->model('Genre');
      $this->imageModel = $this->model('Image');
      // $this->userModel = $this->model('User');
    }

    public function index() {
      $uploaded_images = $this->imageModel->getUploadedImages();

      $data = [
        
        'title' => 'About Us',
        'top_5' => $uploaded_images

      ];

      // echo '<pre>';
      // print_r($data);
      // echo '</pre>';

      $this->view('gallery/index', $data);
    }
  }
