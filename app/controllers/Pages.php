<?php
  class Pages extends Controller{
    public function __construct() {
      $this->movieModel = $this->model('Movie');
      $this->imageModel = $this->model('Image');
    }

    public function index() {
      $movies = $this->movieModel->getMovies();
      $top5Movies = $this->movieModel->getTop5();

      $data = [
        'title' => 'TraversyMVC',
        'movies' => $movies,
        'top_5' => $top5Movies
      ];

      $this->view('pages/index', $data);
    }

    public function about() {
      $uploaded_images = $this->imageModel->getUploadedImages();

      $data = [
        'title' => 'About Us',
        'top_5' => $uploaded_images
      ];
      
      $this->view('pages/about', $data);
    }
  }
